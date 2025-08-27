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
use App\Models\CategoryDetails;
use App\Models\ProductCategory;


class CategoryDetailsController extends Controller
{

    public function index()
    {
        $categoryDetails = CategoryDetails::with('category')
                            ->whereNull('deleted_by')
                            ->orderBy('id', 'asc')
                            ->get();

        return view('backend.products.category-details.index', compact('categoryDetails'));
    }

    public function create(Request $request)
    {
        $categories = ProductCategory::whereNull('deleted_by')
                        ->orderBy('category_name', 'asc')
                        ->get();

        return view('backend.products.category-details.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate the request
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:product_category,id',
                // Ensure no existing record for this category
                Rule::unique('category_details')->whereNull('deleted_by'),
            ],
            'thumbnail'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
        ], [
            'category_id.required' => 'Please select a category.',
            'category_id.exists'   => 'The selected category is invalid.',
            'category_id.unique'   => 'Details for this category already exist.',
            'thumbnail.required'   => 'Please upload a Banner image.',
            'thumbnail.image'      => 'The Banner must be an image.',
            'thumbnail.mimes'      => 'Only JPG, JPEG, PNG, or WEBP formats are allowed.',
            'thumbnail.max'        => 'The Banner size must not exceed 2MB.',
            'description.required' => 'Please enter a description.',
            'description.string'   => 'The description must be a valid text.',
        ]);

        // ✅ Step 2: Handle image upload
        $imageName = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        // ✅ Step 3: Save data in DB
        CategoryDetails::create([
            'category_id'     => $validated['category_id'],
            'thumbnail_image' => $imageName,
            'description'     => $validated['description'],
            'inserted_by'     => Auth::id(),
            'inserted_at'     => Carbon::now(),
        ]);

        // ✅ Step 4: Redirect with success message
        return redirect()->route('manage-category-details.index')
                        ->with('message', 'Category Details added successfully!');
    }

    public function edit($id)
    {
        $category = CategoryDetails::findOrFail($id);
        $categories = ProductCategory::whereNull('deleted_by')
                        ->orderBy('category_name', 'asc')
                        ->get();
        return view('backend.products.category-details.edit', compact('category','categories'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the existing category detail
        $categoryDetail = CategoryDetails::findOrFail($id);

        // ✅ Step 1: Validate the request
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:product_category,id',
                // Prevent duplicate category details for other records
                Rule::unique('category_details')->ignore($id)->whereNull('deleted_by'),
            ],
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
        ], [
            'category_id.required' => 'Please select a category.',
            'category_id.exists'   => 'The selected category is invalid.',
            'category_id.unique'   => 'Details for this category already exist.',
            'thumbnail.image'      => 'The Banner must be an image.',
            'thumbnail.mimes'      => 'Only JPG, JPEG, PNG, or WEBP formats are allowed.',
            'thumbnail.max'        => 'The Banner size must not exceed 2MB.',
            'description.required' => 'Please enter a description.',
            'description.string'   => 'The description must be a valid text.',
        ]);

        // ✅ Step 2: Handle image upload
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);

            // Optionally delete the old image
            if ($categoryDetail->thumbnail_image && file_exists(public_path('uploads/products/' . $categoryDetail->thumbnail_image))) {
                unlink(public_path('uploads/products/' . $categoryDetail->thumbnail_image));
            }

            $categoryDetail->thumbnail_image = $imageName;
        }

        // ✅ Step 3: Update DB record
        $categoryDetail->category_id = $validated['category_id'];
        $categoryDetail->description = $validated['description'];
        $categoryDetail->modified_by  = Auth::id();
        $categoryDetail->modified_at  = Carbon::now();
        $categoryDetail->save();

        // ✅ Step 4: Redirect with success message
        return redirect()->route('manage-category-details.index')
                        ->with('message', 'Category Details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CategoryDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-category-details.index')->with('message', 'Product Category deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}