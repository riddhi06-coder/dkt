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
use App\Models\AboutUs;


class AboutController extends Controller
{

    public function index()
    {
        $aboutUs = AboutUs::wherenull('deleted_by')->get(); 
        return view('backend.about.index', compact('aboutUs'));
    }

    public function create(Request $request)
    { 
        return view('backend.about.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'banner_heading'      => 'required|string|max:255',
            'banner'              => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_image.*'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description1'        => 'required|string',
            'description2'        => 'required|string',
            'description3'        => 'required|string',
            'section_image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_image1'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon.*'              => 'required|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'heading.*'           => 'required|string|max:255',
            'description_division.*' => 'required|string'
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'banner.required'         => 'Please upload a Banner Image.',
            'banner.image'            => 'Banner must be an image.',
            'banner.mimes'            => 'Banner must be jpg, jpeg, png, or webp.',
            'banner.max'              => 'Banner size must not exceed 2MB.',

            'gallery_image.*.required' => 'Please upload at least one Gallery Image.',
            'gallery_image.*.image'    => 'Gallery Image must be an image.',
            'gallery_image.*.mimes'    => 'Gallery Image must be jpg, jpeg, png, or webp.',
            'gallery_image.*.max'      => 'Gallery Image size must not exceed 2MB.',

            'section_image.required'  => 'Section 2 image is required.',
            'section_image1.required' => 'Section 3 image is required.',

            'icon.*.required'               => 'Please upload an icon for Division Details.',
            'heading.*.required'            => 'Heading is required for Division Details.',
            'description_division.*.required' => 'Description is required for Division Details.',
        ]);

        // ✅ Banner upload
        $bannerName = null;
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $bannerName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerName);
        }

        // ✅ Gallery images upload
        $galleryNames = [];
        if ($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $galleryImage) {
                $galleryName = time() . rand(10, 999) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('uploads/about'), $galleryName);
                $galleryNames[] = $galleryName;
            }
        }

        // ✅ Section images
        $sectionImageName = null;
        if ($request->hasFile('section_image')) {
            $img = $request->file('section_image');
            $sectionImageName = time() . rand(10, 999) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/about'), $sectionImageName);
        }

        $sectionImage1Name = null;
        if ($request->hasFile('section_image1')) {
            $img1 = $request->file('section_image1');
            $sectionImage1Name = time() . rand(10, 999) . '.' . $img1->getClientOriginalExtension();
            $img1->move(public_path('uploads/about'), $sectionImage1Name);
        }

        // ✅ Division details (icons + heading + description_division arrays)
        $divisionDetails = [];
        if ($request->has('icon')) {
            foreach ($request->icon as $index => $iconFile) {
                $detail = [
                    'heading'     => $request->heading[$index] ?? '',
                    'description' => $request->description_division[$index] ?? '',
                    'icon'        => null,
                ];

                if ($iconFile instanceof \Illuminate\Http\UploadedFile) {
                    $iconName = time() . rand(10, 999) . '.' . $iconFile->getClientOriginalExtension();
                    $iconFile->move(public_path('uploads/about'), $iconName);
                    $detail['icon'] = $iconName;
                }

                $divisionDetails[] = $detail;
            }
        }

        // ✅ Save to DB
        $about = new AboutUs();
        $about->banner_heading       = $request->banner_heading;
        $about->banner               = $bannerName ?? null;
        $about->gallery_images       = json_encode($galleryNames);
        $about->section1_description = $request->description1;
        $about->section2_description = $request->description2;
        $about->section3_description = $request->description3;
        $about->section_image        = $sectionImageName ?? null;
        $about->section_image1       = $sectionImage1Name ?? null;
        $about->division_details     = json_encode($divisionDetails);
        $about->inserted_by          = Auth::id();
        $about->inserted_at          = Carbon::now();
        $about->save();

        return redirect()->route('manage-about-us.index')->with('message', 'About Us data saved successfully!');
    }

    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);
        $galleryImages = $about->gallery_images ? json_decode($about->gallery_images, true) : [];
        $divisionDetails = $about->division_details ? json_decode($about->division_details, true) : [];

        return view('backend.about.edit', compact('about', 'galleryImages', 'divisionDetails'));
    }

    public function update(Request $request, $id)
    {
        $about = AboutUs::findOrFail($id);

        // ✅ Validation
        $validated = $request->validate([
            'banner_heading'      => 'required|string|max:255',
            'banner'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_image.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description1'        => 'required|string',
            'description2'        => 'required|string',
            'description3'        => 'required|string',
            'section_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_image1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon.*'              => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'heading.*'           => 'required|string|max:255',
            'description_division.*' => 'required|string'
        ]);

        // ✅ Banner upload
        if ($request->hasFile('banner')) {
            if ($about->banner && file_exists(public_path('uploads/about/'.$about->banner))) {
                unlink(public_path('uploads/about/'.$about->banner));
            }
            $image = $request->file('banner');
            $bannerName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerName);
            $about->banner = $bannerName;
        }

        $galleryNames = $request->input('gallery_image_existing', []);

        // Handle new uploads
        if ($request->hasFile('gallery_image_new')) {
            foreach ($request->file('gallery_image_new') as $galleryImage) {
                $galleryName = time() . rand(10, 999) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('uploads/about'), $galleryName);
                $galleryNames[] = $galleryName;
            }
        }

        $about->gallery_images = json_encode($galleryNames);

        // ✅ Section images
        if ($request->hasFile('section_image')) {
            if ($about->section_image && file_exists(public_path('uploads/about/'.$about->section_image))) {
                unlink(public_path('uploads/about/'.$about->section_image));
            }
            $img = $request->file('section_image');
            $sectionImageName = time() . rand(10, 999) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/about'), $sectionImageName);
            $about->section_image = $sectionImageName;
        }

        if ($request->hasFile('section_image1')) {
            if ($about->section_image1 && file_exists(public_path('uploads/about/'.$about->section_image1))) {
                unlink(public_path('uploads/about/'.$about->section_image1));
            }
            $img1 = $request->file('section_image1');
            $sectionImage1Name = time() . rand(10, 999) . '.' . $img1->getClientOriginalExtension();
            $img1->move(public_path('uploads/about'), $sectionImage1Name);
            $about->section_image1 = $sectionImage1Name;
        }

        // ✅ Division details
        $divisionDetails = [];
        if ($request->has('heading')) {
            foreach ($request->heading as $index => $heading) {
                $detail = [
                    'heading'     => $heading,
                    'description' => $request->description_division[$index] ?? '',
                    'icon'        => null,
                ];

                if (!empty($request->icon[$index]) && $request->icon[$index] instanceof \Illuminate\Http\UploadedFile) {
                    // Delete old icon if exists
                    $oldDivisionDetails = json_decode($about->division_details, true) ?? [];
                    if (!empty($oldDivisionDetails[$index]['icon']) && file_exists(public_path('uploads/about/'.$oldDivisionDetails[$index]['icon']))) {
                        unlink(public_path('uploads/about/'.$oldDivisionDetails[$index]['icon']));
                    }

                    $iconName = time() . rand(10, 999) . '.' . $request->icon[$index]->getClientOriginalExtension();
                    $request->icon[$index]->move(public_path('uploads/about'), $iconName);
                    $detail['icon'] = $iconName;
                } else {
                    // Keep old icon if no new file uploaded
                    $oldDivisionDetails = json_decode($about->division_details, true) ?? [];
                    $detail['icon'] = $oldDivisionDetails[$index]['icon'] ?? null;
                }

                $divisionDetails[] = $detail;
            }
        }

        // ✅ Update other fields
        $about->banner_heading       = $request->banner_heading;
        $about->section1_description = $request->description1;
        $about->section2_description = $request->description2;
        $about->section3_description = $request->description3;
        $about->division_details     = json_encode($divisionDetails);
        $about->modified_by          = Auth::id();
        $about->modified_at          = Carbon::now();
        $about->save();

        return redirect()->route('manage-about-us.index')->with('message', 'About Us updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AboutUs::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-about-us.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}