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
use App\Models\VisionMission;


class HomeVisionController extends Controller
{

    public function index()
    {
        $visions = VisionMission::orderBy('id', 'asc')->wherenull('deleted_by')->get();
        return view('backend.home.vision.index', compact('visions'));
    }


    public function create(Request $request)
    {
        return view('backend.home.vision.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'section_title' => 'nullable|string|max:255',
            'heading'       => 'required|string|max:255',
            'title'         => 'required|string|max:255',
            'image'         => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048', 
        ], [
            'heading.required'   => 'Heading is required.',
            'title.required'     => 'Title is required.',
            'image.mimes'        => 'Only JPG, JPEG, PNG, WEBP SVG images are allowed.',
            'image.max'          => 'Image size must be less than 2MB.',
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
            $data = new VisionMission();
            $data->section_title = $request->section_title;
            $data->heading = $request->heading;
            $data->title = $request->title;
            $data->image = $imageFile;
            $data->inserted_by = Auth::id();
            $data->inserted_at  = Carbon::now();
            $data->save();

            return redirect()->route('manage-vision.index')
                ->with('message', 'Record created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $intro = VisionMission::findOrFail($id);
        return view('backend.home.vision.edit', compact('intro'));
    }


    public function update(Request $request, $id)
    {

        $intro = VisionMission::findOrFail($id);

        $request->validate([
            'section_title' => 'nullable|string|max:255',
            'heading'       => 'required|string|max:255',
            'title'         => 'required|string|max:255',
            'image'         => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048', 
        ], [
            'heading.required'   => 'Heading is required.',
            'title.required'     => 'Title is required.',
            'image.mimes'        => 'Only JPG, JPEG, PNG, WEBP SVG images are allowed.',
            'image.max'          => 'Image size must be less than 2MB.',
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
            $intro->modified_by   = Auth::id();
            $intro->modified_at   = Carbon::now();

            // ✅ Step 5: Save changes
            $intro->save();

            return redirect()->route('manage-vision.index')
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
            $industries = VisionMission::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-vision.index')->with('message', 'Data deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}