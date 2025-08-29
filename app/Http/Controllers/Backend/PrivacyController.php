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
use App\Models\PrivacyPolicy;


class PrivacyController extends Controller
{

    public function index()
    {
        $privacyPolicies = PrivacyPolicy::wherenull('deleted_by')->get();
        return view('backend.privacy.index', compact('privacyPolicies'));
    }


    public function create(Request $request)
    { 
        return view('backend.privacy.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB max
            'description'   => 'required|string',
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'banner.required'         => 'Please upload a Banner Image.',
            'banner.image'            => 'The file must be an image.',
            'banner.mimes'            => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'banner.max'              => 'The Banner Image must not be larger than 2MB.',
            'description.required'   => 'Privacy Policy description is required.',
        ]);

        try {
            $bannerName = null;

            // ✅ Save Image to public/uploads/about
            if ($request->hasFile('banner')) {
                $image = $request->file('banner');
                $bannerName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/home'), $bannerName);
            }

            // ✅ Store Data in Database
            $privacyPolicy = new PrivacyPolicy();
            $privacyPolicy->banner_heading = $request->banner_heading;
            $privacyPolicy->banner         = $bannerName; 
            $privacyPolicy->description    = $request->description;
            $privacyPolicy->inserted_by          = Auth::id();
            $privacyPolicy->inserted_at          = Carbon::now();
            $privacyPolicy->save();

            return redirect()->route('manage-privacy-policy.index')
                            ->with('message', 'Privacy Policy created successfully.');

        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! '.$e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $PrivacyPolicy = PrivacyPolicy::findOrFail($id);
        return view('backend.privacy.edit', compact('PrivacyPolicy'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Validation
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'description'    => 'required|string',
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'banner.image'            => 'The file must be an image.',
            'banner.mimes'            => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'banner.max'              => 'The Banner Image must not be larger than 2MB.',
            'description.required'    => 'Privacy Policy description is required.',
        ]);

        try {
            $privacyPolicy = PrivacyPolicy::findOrFail($id);

            // ✅ Update values
            $privacyPolicy->banner_heading = $request->banner_heading;
            $privacyPolicy->description    = $request->description;
            $privacyPolicy->modified_by    = Auth::id();
            $privacyPolicy->modified_at    = Carbon::now();

            // ✅ Handle Image Upload
            if ($request->hasFile('banner')) {
                // Delete old banner if exists
                if ($privacyPolicy->banner && file_exists(public_path('uploads/home/' . $privacyPolicy->banner))) {
                    unlink(public_path('uploads/home/' . $privacyPolicy->banner));
                }

                $image = $request->file('banner');
                $bannerName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/home'), $bannerName);

                $privacyPolicy->banner = $bannerName;
            }

            $privacyPolicy->save();

            return redirect()->route('manage-privacy-policy.index')
                            ->with('message', 'Privacy Policy updated successfully.');

        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! '.$e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = PrivacyPolicy::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-privacy-policy.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}