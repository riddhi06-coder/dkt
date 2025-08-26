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
use App\Models\ProductCategory;


class ProductsCategoryController extends Controller
{

    public function index()
    {
        return view('backend.products.product-category.index');
    }

    public function create(Request $request)
    { 
        return view('backend.products.product-category.create');
    }

    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'category_name' => 'required|string|max:255|unique:product_category,category_name',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'category_name.required' => 'Please enter a product category name.',
            'category_name.unique' => 'This category name already exists.',
            'thumbnail.required' => 'Please upload a thumbnail image.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'Only JPG, JPEG, PNG, or WEBP formats are allowed.11',
            'thumbnail.max' => 'The thumbnail size must be less than 2MB.',
        ]);

        $imageName = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        $slug = Str::slug($request->category_name, '-');

        ProductCategory::create([
            'category_name' => $request->category_name,
            'slug' => $slug,
            'thumbnail_image' => $imageName, 
            'inserted_by' => Auth::id(),
            'inserted_at' => Carbon::now(),
        ]);

        return redirect()->route('manage-products-category.index')
                         ->with('message', 'Product Category added successfully!');
    }


}