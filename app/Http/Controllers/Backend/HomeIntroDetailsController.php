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
use App\Models\HomeIntro;


class HomeIntroDetailsController extends Controller
{

    public function index()
    {
        $introDetails = HomeIntro::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        return view('backend.home.intro.index', compact('introDetails'));
    }

    public function create(Request $request)
    {
        return view('backend.home.intro.create');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate request
        $validated = $request->validate([
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB
            'results_image'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB
            'description'    => 'required|string',
            'gallery_image.*'=> 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // each gallery image
        ], [
            'image.required'          => 'Please upload an Image.',
            'image.image'             => 'Uploaded file must be an image.',
            'image.mimes'             => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Image.',
            'image.max'               => 'Image size must not exceed 2MB.',

            'results_image.required'  => 'Please upload a Results Image.',
            'results_image.image'     => 'Uploaded Results file must be an image.',
            'results_image.mimes'     => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Results Image.',
            'results_image.max'       => 'Results Image size must not exceed 2MB.',

            'description.required'    => 'Please enter a description.',
            'description.string'      => 'Description must be a valid string.',

            'gallery_image.*.required' => 'Please upload all Gallery Images.',
            'gallery_image.*.image'    => 'Gallery file must be an image.',
            'gallery_image.*.mimes'    => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Gallery Images.',
            'gallery_image.*.max'      => 'Gallery Image size must not exceed 2MB.',
        ]);

        // ✅ Step 2: Handle Image upload
        $imageFile = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFile = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $imageFile);
        }

        // ✅ Step 3: Handle Results Image upload
        $resultsFile = null;
        if ($request->hasFile('results_image')) {
            $results = $request->file('results_image');
            $resultsFile = time() . rand(10, 999) . '.' . $results->getClientOriginalExtension();
            $results->move(public_path('uploads/home'), $resultsFile);
        }

        // ✅ Step 4: Handle Gallery Images upload & store as JSON
        $galleryImages = [];
        if ($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $index => $gallery) {
                $galleryName = time() . rand(10, 999) . '.' . $gallery->getClientOriginalExtension();
                $gallery->move(public_path('uploads/home'), $galleryName);
                $galleryImages[] = $galleryName;
            }
        }

        // ✅ Step 5: Save to DB
        HomeIntro::create([
            'image'         => $imageFile,
            'results_image' => $resultsFile,
            'description'   => $validated['description'],
            'gallery_images'=> json_encode($galleryImages),
            'inserted_by'   => \Auth::id(),
            'inserted_at'   => Carbon::now(),
        ]);

        // ✅ Step 6: Redirect with success message
        return redirect()->route('manage-intro-details.index')
                        ->with('message', 'Intro details added successfully!');
    }

    public function edit($id)
    {
        $intro = HomeIntro::findOrFail($id);

        // Decode gallery images JSON
        $galleryImages = $intro->gallery_images ? json_decode($intro->gallery_images, true) : [];

        return view('backend.home.intro.edit', compact('intro', 'galleryImages'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Step 1: Find the record
        $intro = HomeIntro::findOrFail($id);

        // ✅ Step 2: Validate request
        $validated = $request->validate([
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'results_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description'    => 'required|string',
            'gallery_image.*'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'image.image'             => 'Uploaded file must be an image.',
            'image.mimes'             => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Image.',
            'image.max'               => 'Image size must not exceed 2MB.',

            'results_image.image'     => 'Uploaded Results file must be an image.',
            'results_image.mimes'     => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Results Image.',
            'results_image.max'       => 'Results Image size must not exceed 2MB.',

            'description.required'    => 'Please enter a description.',
            'description.string'      => 'Description must be a valid string.',

            'gallery_image.*.image'   => 'Gallery file must be an image.',
            'gallery_image.*.mimes'   => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Gallery Images.',
            'gallery_image.*.max'     => 'Gallery Image size must not exceed 2MB.',
        ]);

        // ✅ Step 3: Handle Image upload (replace if new one uploaded)
        if ($request->hasFile('image')) {
            // Delete old file if exists
            if ($intro->image && file_exists(public_path('uploads/home/' . $intro->image))) {
                unlink(public_path('uploads/home/' . $intro->image));
            }

            $image = $request->file('image');
            $imageFile = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $imageFile);
            $intro->image = $imageFile;
        }

        // ✅ Step 4: Handle Results Image upload (replace if new one uploaded)
        if ($request->hasFile('results_image')) {
            if ($intro->results_image && file_exists(public_path('uploads/home/' . $intro->results_image))) {
                unlink(public_path('uploads/home/' . $intro->results_image));
            }

            $results = $request->file('results_image');
            $resultsFile = time() . rand(10, 999) . '.' . $results->getClientOriginalExtension();
            $results->move(public_path('uploads/home'), $resultsFile);
            $intro->results_image = $resultsFile;
        }

        // ✅ Step 5: Handle Gallery Images update
        $existingGallery = json_decode($intro->gallery_images, true) ?? [];
        $submittedGallery = $request->input('existing_gallery', []); // remaining from form

        // Delete files that were removed
        $deletedImages = array_diff($existingGallery, $submittedGallery);
        foreach ($deletedImages as $delImg) {
            $filePath = public_path('uploads/home/' . $delImg);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Start with submitted (remaining) gallery images
        $finalGallery = $submittedGallery;

        // Add new uploaded images
        if ($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $gallery) {
                $galleryName = time() . rand(10, 999) . '.' . $gallery->getClientOriginalExtension();
                $gallery->move(public_path('uploads/home'), $galleryName);
                $finalGallery[] = $galleryName;
            }
        }

        // Save final gallery list
        $intro->gallery_images = json_encode($finalGallery);


        // ✅ Step 6: Update other fields
        $intro->description = $validated['description'];
        $intro->modified_by = \Auth::id();
        $intro->modified_at = Carbon::now();

        // ✅ Step 7: Save
        $intro->save();

        // ✅ Step 8: Redirect with success message
        return redirect()->route('manage-intro-details.index')
                        ->with('message', 'Intro details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeIntro::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-intro-details.index')->with('message', 'Product deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}