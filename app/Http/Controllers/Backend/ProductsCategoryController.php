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
        $categories = ProductCategory::wherenull('deleted_by')->get(); 
        return view('backend.products.product-category.index', compact('categories'));
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

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('backend.products.product-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $category = ProductCategory::findOrFail($id);

        // ✅ Validation
        $request->validate([
            'category_name' => 'required|string|max:255|unique:product_category,category_name,' . $category->id,
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'category_name.required' => 'Please enter a product category name.',
            'category_name.unique' => 'This category name already exists.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'Only JPG, JPEG, PNG, or WEBP formats are allowed.',
            'thumbnail.max' => 'The thumbnail size must be less than 2MB.',
        ]);

        // ✅ Handle Thumbnail Upload
        if ($request->hasFile('thumbnail')) {
            // Delete old image if exists
            if ($category->thumbnail_image && file_exists(public_path('uploads/products/' . $category->thumbnail_image))) {
                unlink(public_path('uploads/products/' . $category->thumbnail_image));
            }

            $image = $request->file('thumbnail');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $category->thumbnail_image = $imageName;
        }

        // ✅ Update other fields
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name, '-');
        $category->modified_by = Auth::id();
        $category->modified_at = Carbon::now();
        $category->save();

        return redirect()->route('manage-products-category.index')
                        ->with('message', 'Product Category updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductCategory::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-products-category.index')->with('message', 'Product Category deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}