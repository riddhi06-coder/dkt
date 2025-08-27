<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ProductDetails;
use App\Models\Products;
use App\Models\ProductCategory;


class ProductDetailsController extends Controller
{

    public function index()
    {
        return view('backend.products.products-details.index');
    }

    public function create(Request $request)
    {
        $categories = ProductCategory::whereNull('deleted_by')
                        ->orderBy('category_name', 'asc')
                        ->get();

        return view('backend.products.products-details.create', compact('categories'));
    }


    public function getProducts($categoryId)
    {
        $products = Products::where('category_id', $categoryId)
                            ->whereNull('deleted_by')
                            ->select('id', 'product_name')
                            ->orderBy('product_name', 'asc')
                            ->get();

        return response()->json($products);
    }

    
    public function store(Request $request)
    {
        // ✅ Step 1: Validate the request
        $validated = $request->validate([
            'category_id'       => [
                'required',
                'exists:product_category,id',
                Rule::unique('product_details')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id)
                                ->where('product_id', $request->product_id) 
                                ->whereNull('deleted_by');
                }),
            ],
            'product_id'        => 'required|exists:products,id',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'buy_now'           => 'nullable|url',
            'description'       => 'required|string',
            'use_of_tablet'     => 'required|string',
            'direction_to_use'  => 'required|string',
            'tablet_name.*'     => 'required|string',
            'dose.*'            => 'required|string',
        ], [
            'category_id.required'    => 'Please select a category.',
            'category_id.exists'      => 'The selected category is invalid.',
            'category_id.unique'      => 'Details for this product in this category already exist.',
            'product_id.required'     => 'Please select a product.',
            'product_id.exists'       => 'The selected product is invalid.',
            'thumbnail.image'         => 'The Banner must be an image.',
            'thumbnail.mimes'         => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Banner.',
            'thumbnail.max'           => 'The Banner size must not exceed 2MB.',
            'product_image.required'  => 'Please upload a Product image.',
            'product_image.image'     => 'The Product image must be an image.',
            'product_image.mimes'     => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Product image.',
            'product_image.max'       => 'The Product image size must not exceed 2MB.',
            'buy_now.url'             => 'Please enter a valid Buy Now URL.',
            'description.required'    => 'Please enter a description.',
            'use_of_tablet.required'  => 'Please enter Use of Tablet.',
            'direction_to_use.required' => 'Please enter Direction To use.',
            'tablet_name.*.required'  => 'Please enter Tablet Name.',
            'dose.*.required'         => 'Please enter Dose.',
        ]);

        // ✅ Step 2: Handle Banner Image upload
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $bannerImage);
        }

        // ✅ Step 3: Handle Product Image upload
        $productImage = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $productImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $productImage);
        }

        // ✅ Step 4: Encode Tablet & Dose table data as JSON
        $composition = [];
        $tabletNames = $request->tablet_name;
        $doses = $request->dose;

        foreach ($tabletNames as $index => $tablet) {
            $composition[] = [
                'tablet_name' => $tablet,
                'dose'        => $doses[$index] ?? '',
            ];
        }

        // ✅ Step 5: Save data in DB
        ProductDetails::create([
            'category_id'       => $validated['category_id'],
            'product_id'        => $validated['product_id'], // Store selected product
            'thumbnail_image'   => $bannerImage,
            'product_image'     => $productImage,
            'buy_now'           => $validated['buy_now'] ?? null,
            'description'       => $validated['description'],
            'use_of_tablet'     => $validated['use_of_tablet'],
            'direction_to_use'  => $validated['direction_to_use'],
            'composition'       => json_encode($composition),
            'inserted_by'       => Auth::id(),
            'inserted_at'       => Carbon::now(),
        ]);

        // ✅ Step 6: Redirect with success message
        return redirect()->route('manage-product-details.index')
                        ->with('message', 'Product details added successfully!');
    }


}