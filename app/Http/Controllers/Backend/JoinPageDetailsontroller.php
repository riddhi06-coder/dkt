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
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use App\Models\User;
use App\Models\JoinPageDetail;


class JoinPageDetailsontroller extends Controller
{

    public function index()
    {
        $joinPages = JoinPageDetail::wherenull('deleted_by')->get(); 
        return view('backend.join.details.index', compact('joinPages'));
    }

    public function create(Request $request)
    {
        return view('backend.join.details.create');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate form inputs
        $validator = Validator::make($request->all(), [
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description_main' => 'required|string',

            'why_dkt_description' => 'required|string',

            'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'heading.*' => 'nullable|string|max:255',
            'description_division.*' => 'nullable|string',

            'section_heading' => 'required|string|max:255',
            'section_title' => 'required|string|max:255',

            'right_role_image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'right_role_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Step 2: Upload images in your format (time + rand + ext)
        $bannerImage = null;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $bannerImage);
        }

        $sectionImage = null;
        if ($request->hasFile('section_image')) {
            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $sectionImage);
        }

        $rightRoleImage = null;
        if ($request->hasFile('right_role_image')) {
            $image = $request->file('right_role_image');
            $rightRoleImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $rightRoleImage);
        }

        // ✅ Step 3: Handle Features Table JSON
        $features = [];
        if ($request->has('heading')) {
            foreach ($request->heading as $key => $value) {
                if (!empty($value)) {
                    $iconPath = null;
                    if ($request->hasFile("icon.$key")) {
                        $icon = $request->file("icon.$key");
                        $iconPath = time() . rand(10, 999) . '.' . $icon->getClientOriginalExtension();
                        $icon->move(public_path('uploads/home'), $iconPath);
                    }

                    $features[] = [
                        'icon' => $iconPath,
                        'heading' => $value,
                        'description' => $request->description_division[$key] ?? null,
                    ];
                }
            }
        }

        // ✅ Step 4: Store in database
        $joinPage = new JoinPageDetail();
        $joinPage->banner_heading = $request->banner_heading;
        $joinPage->banner_image = $bannerImage;
        $joinPage->section_image = $sectionImage;
        $joinPage->description_main = $request->description_main;
        $joinPage->why_dkt_description = $request->why_dkt_description;
        $joinPage->features = json_encode($features); 
        $joinPage->section_heading = $request->section_heading;
        $joinPage->section_title = $request->section_title;
        $joinPage->right_role_image = $rightRoleImage;
        $joinPage->right_role_description = $request->right_role_description;
        $joinPage->inserted_by = Auth::id();
        $joinPage->inserted_at = Carbon::now();
        $joinPage->save();

        // ✅ Step 5: Success message
        return redirect()->route('manage-join-page-details.index')
            ->with('message', 'Join Page details saved successfully!');
    }

    public function edit($id)
    {
        $intro = JoinPageDetail::findOrFail($id);
        return view('backend.join.details.edit', compact('intro'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Step 1: Find existing record
        $joinPage = JoinPageDetail::findOrFail($id);

        // ✅ Step 2: Validation
        $validator = Validator::make($request->all(), [
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description_main' => 'required|string',

            'why_dkt_description' => 'required|string',

            'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'heading.*' => 'nullable|string|max:255',
            'description_division.*' => 'nullable|string',

            'section_heading' => 'required|string|max:255',
            'section_title' => 'required|string|max:255',

            'right_role_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'right_role_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Step 3: Handle images
        $bannerImage = $joinPage->banner_image;
        if ($request->hasFile('banner_image')) {
            if ($bannerImage && file_exists(public_path('uploads/home/' . $bannerImage))) {
                unlink(public_path('uploads/home/' . $bannerImage));
            }
            $image = $request->file('banner_image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $bannerImage);
        }

        $sectionImage = $joinPage->section_image;
        if ($request->hasFile('section_image')) {
            if ($sectionImage && file_exists(public_path('uploads/home/' . $sectionImage))) {
                unlink(public_path('uploads/home/' . $sectionImage));
            }
            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $sectionImage);
        }

        $rightRoleImage = $joinPage->right_role_image;
        if ($request->hasFile('right_role_image')) {
            if ($rightRoleImage && file_exists(public_path('uploads/home/' . $rightRoleImage))) {
                unlink(public_path('uploads/home/' . $rightRoleImage));
            }
            $image = $request->file('right_role_image');
            $rightRoleImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $rightRoleImage);
        }

        // ✅ Step 4: Handle Features Table JSON
        $features = [];
        if ($request->has('heading')) {
            foreach ($request->heading as $key => $value) {
                if (!empty($value)) {
                    $iconPath = $request->old_icon[$key] ?? null; // keep old if not replaced
                    if ($request->hasFile("icon.$key")) {
                        if ($iconPath && file_exists(public_path('uploads/home/' . $iconPath))) {
                            unlink(public_path('uploads/home/' . $iconPath));
                        }
                        $icon = $request->file("icon.$key");
                        $iconPath = time() . rand(10, 999) . '.' . $icon->getClientOriginalExtension();
                        $icon->move(public_path('uploads/home'), $iconPath);
                    }

                    $features[] = [
                        'icon' => $iconPath,
                        'heading' => $value,
                        'description' => $request->description_division[$key] ?? null,
                    ];
                }
            }
        }

        // ✅ Step 5: Update record
        $joinPage->banner_heading = $request->banner_heading;
        $joinPage->banner_image = $bannerImage;
        $joinPage->section_image = $sectionImage;
        $joinPage->description_main = $request->description_main;
        $joinPage->why_dkt_description = $request->why_dkt_description;
        $joinPage->features = json_encode($features);
        $joinPage->section_heading = $request->section_heading;
        $joinPage->section_title = $request->section_title;
        $joinPage->right_role_image = $rightRoleImage;
        $joinPage->right_role_description = $request->right_role_description;
        $joinPage->modified_by = Auth::id();
        $joinPage->modified_at = Carbon::now();
        $joinPage->save();

        // ✅ Step 6: Success
        return redirect()->route('manage-join-page-details.index')
            ->with('message', 'Join Page details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = JoinPageDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-join-page-details.index')->with('message', 'Data deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}