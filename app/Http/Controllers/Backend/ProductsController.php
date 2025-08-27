<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Products;
use App\Models\ProductCategory;


class ProductsController extends Controller
{

    public function index()
    {
        $categories = ProductCategory::with('products')->get();
        return view('backend.products.products.index', compact('categories'));
    }


    public function create(Request $request)
    { 
        $categories = ProductCategory::orderBy('category_name', 'asc')->wherenull('deleted_by')->get();
        return view('backend.products.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate request
        $validated = $request->validate([
            'category_id'   => 'required|exists:product_category,id',
            'product_name' => 'required|string|max:255',
            'thumbnail'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'category_id.required'   => 'Please select a category.',
            'category_id.exists'     => 'The selected category is invalid.',
            'product_name.required' => 'Please enter a product category name.',
            'thumbnail.required'     => 'Please upload a thumbnail image.',
            'thumbnail.image'        => 'The thumbnail must be an image.',
            'thumbnail.mimes'        => 'Only JPG, JPEG, PNG, or WEBP formats are allowed.',
            'thumbnail.max'          => 'The thumbnail size must not exceed 2MB.',
        ]);

        // ✅ Step 2: Handle image upload
        $imageName = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        $slug = Str::slug($request->product_name, '-');

        // ✅ Step 3: Save product category in DB
        $product = new Products();
        $product->category_id   = $validated['category_id'];
        $product->product_name = $validated['product_name'];
        $product->slug = $slug;
        $product->thumbnail_image = $imageName;
        $product->inserted_by = Auth::id();
        $product->inserted_at = Carbon::now();
        $product->save();

        // ✅ Step 4: Redirect with success message
        return redirect()->route('manage-products.index')->with('message', 'Product added successfully.');
    }


}