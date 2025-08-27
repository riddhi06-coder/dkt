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
use App\Models\HomeSocial;


class HomeSocialDetailsController extends Controller
{

    public function index()
    {
        $socials = HomeSocial::wherenull('deleted_by')->get(); 
        return view('backend.home.social.index', compact('socials'));
    }

    public function create(Request $request)
    {
        return view('backend.home.social.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation rules
        $request->validate([
            'section_title' => 'nullable|string|max:255',
            'heading'       => 'required|string|max:255',
            'title'         => 'required|string|max:255',
            'image'         => 'nullable|mimes:jpg,jpeg,png,webp|max:2048', // 2MB
            'banner_video'  => 'nullable|url|max:500', // URL instead of file
        ], [
            'heading.required'   => 'Heading is required.',
            'title.required'     => 'Title is required.',
            'image.mimes'        => 'Only JPG, JPEG, PNG, WEBP images are allowed.',
            'image.max'          => 'Image size must be less than 2MB.',
            'banner_video.url'   => 'Please enter a valid video URL.',
            'banner_video.max'   => 'Video URL must not exceed 500 characters.',
        ]);

        try {
            // ✅ Store image
            $imageFile = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageFile = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/home'), $imageFile);
            }

            // ✅ Save into DB
            $data = new HomeSocial();
            $data->section_title = $request->section_title;
            $data->heading = $request->heading;
            $data->title = $request->title;
            $data->image = $imageFile;
            $data->banner_video = $request->banner_video;
            $data->inserted_by = Auth::id();
            $data->inserted_at  = Carbon::now();
            $data->save();

            return redirect()->route('manage-social-home.index')
                ->with('message', 'Record created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $intro = HomeSocial::findOrFail($id);
        return view('backend.home.social.edit', compact('intro'));
    }

    public function update(Request $request, $id)
    {

        $intro = HomeSocial::findOrFail($id);

        $request->validate([
            'section_title' => 'nullable|string|max:255',
            'heading'       => 'required|string|max:255',
            'title'         => 'required|string|max:255',
            'image'         => 'nullable|mimes:jpg,jpeg,png,webp|max:2048', 
            'banner_video'  => 'nullable|url|max:500', 
        ], [
            'heading.required'   => 'Heading is required.',
            'title.required'     => 'Title is required.',
            'image.mimes'        => 'Only JPG, JPEG, PNG, WEBP images are allowed.',
            'image.max'          => 'Image size must be less than 2MB.',
            'banner_video.url'   => 'Please enter a valid video URL.',
            'banner_video.max'   => 'Video URL must not exceed 500 characters.',
        ]);

        try {

            if ($request->hasFile('image')) {

                if ($intro->image && file_exists(public_path('uploads/home/' . $intro->image))) {
                    unlink(public_path('uploads/home/' . $intro->image));
                }

                $image = $request->file('image');
                $imageFile = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/home'), $imageFile);
                $intro->image = $imageFile;
            }

            // ✅ Step 4: Update other fields
            $intro->section_title = $request->section_title;
            $intro->heading       = $request->heading;
            $intro->title         = $request->title;
            $intro->banner_video  = $request->banner_video; 
            $intro->modified_by   = Auth::id();
            $intro->modified_at   = Carbon::now();

            // ✅ Step 5: Save changes
            $intro->save();

            return redirect()->route('manage-social-home.index')
                ->with('message', 'Record updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeSocial::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-social-home.index')->with('message', 'Data deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}