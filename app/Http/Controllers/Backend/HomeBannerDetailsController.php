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
use App\Models\HomeBanner;

class HomeBannerDetailsController extends Controller
{

    public function index()
    {
        $banners = HomeBanner::whereNull('deleted_by')
                    ->orderBy('inserted_at', 'asc')
                    ->get();

        return view('backend.home.banner.index', compact('banners'));
    }

    public function create(Request $request)
    {
        return view('backend.home.banner.create');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate request
        $validated = $request->validate([
            'banner_heading'  => 'required|string|max:255',
            'banner_title'    => 'required|string|max:255',
            'thumbnail'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB
            'banner_video'   => 'required|mimes:mp4,webm,ogg|max:3072', // 3MB
            'description'     => 'required|string',
        ], [
            'banner_heading.required' => 'Please enter a Banner Heading.',
            'banner_heading.string'   => 'Banner Heading must be a valid string.',
            'banner_heading.max'      => 'Banner Heading cannot exceed 255 characters.',

            'banner_title.required'   => 'Please enter a Banner Title.',
            'banner_title.string'     => 'Banner Title must be a valid string.',
            'banner_title.max'        => 'Banner Title cannot exceed 255 characters.',

            'thumbnail.required'      => 'Please upload a Banner image.',
            'thumbnail.image'         => 'Banner must be an image.',
            'thumbnail.mimes'         => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Banner.',
            'thumbnail.max'           => 'Banner image size must not exceed 2MB.',

            'banner_video.required'  => 'Please upload a video.',
            'banner_video.mimes'     => 'Only MP4, WebM, or OGG formats are allowed for the video.',
            'banner_video.max'       => 'Video size must not exceed 3MB.',

            'description.required'    => 'Please enter a description.',
            'description.string'      => 'Description must be a valid string.',
        ]);

        // ✅ Step 2: Handle Banner Image upload
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $bannerImage);
        }

        // ✅ Step 3: Handle Video upload
        $videoFile = null;
        if ($request->hasFile('banner_video')) {
            $video = $request->file('banner_video');
            $videoFile = time() . rand(10, 999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/home'), $videoFile);
        }

        // ✅ Step 4: Save to DB
        HomeBanner::create([
            'banner_heading' => $validated['banner_heading'],
            'banner_title'   => $validated['banner_title'],
            'thumbnail'      => $bannerImage,
            'banner_video'  => $videoFile,
            'description'    => $validated['description'],
            'inserted_by'    => Auth::id(),
            'inserted_at'    => Carbon::now(),
        ]);

        // ✅ Step 5: Redirect with success message
        return redirect()->route('manage-home-banner-details.index')->with('message', 'Home Banner added successfully!');
    }

    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return view('backend.home.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the existing banner
        $banner = HomeBanner::findOrFail($id);

        // ✅ Step 1: Validate request
        $validated = $request->validate([
            'banner_heading'  => 'required|string|max:255',
            'banner_title'    => 'required|string|max:255',
            'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // optional
            'banner_video'    => 'nullable|mimes:mp4,webm,ogg|max:3072', // optional
            'description'     => 'required|string',
        ], [
            'banner_heading.required' => 'Please enter a Banner Heading.',
            'banner_heading.string'   => 'Banner Heading must be a valid string.',
            'banner_heading.max'      => 'Banner Heading cannot exceed 255 characters.',

            'banner_title.required'   => 'Please enter a Banner Title.',
            'banner_title.string'     => 'Banner Title must be a valid string.',
            'banner_title.max'        => 'Banner Title cannot exceed 255 characters.',

            'thumbnail.image'         => 'Banner must be an image.',
            'thumbnail.mimes'         => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Banner.',
            'thumbnail.max'           => 'Banner image size must not exceed 2MB.',

            'banner_video.mimes'      => 'Only MP4, WebM, or OGG formats are allowed for the video.',
            'banner_video.max'        => 'Video size must not exceed 3MB.',

            'description.required'    => 'Please enter a description.',
            'description.string'      => 'Description must be a valid string.',
        ]);

        // ✅ Step 2: Handle Banner Image upload
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $bannerImage);
            $banner->thumbnail = $bannerImage;
        }

        // ✅ Step 3: Handle Video upload
        if ($request->hasFile('banner_video')) {
            $video = $request->file('banner_video');
            $videoFile = time() . rand(10, 999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/home'), $videoFile);
            $banner->banner_video = $videoFile;
        }

        // ✅ Step 4: Update other fields
        $banner->banner_heading = $validated['banner_heading'];
        $banner->banner_title   = $validated['banner_title'];
        $banner->description    = $validated['description'];
        $banner->modified_by     = Auth::id();
        $banner->modified_at     = Carbon::now();

        $banner->save();

        // ✅ Step 5: Redirect with success message
        return redirect()->route('manage-home-banner-details.index')
                        ->with('message', 'Home Banner updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeBanner::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-home-banner-details.index')->with('message', 'Product Category deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}