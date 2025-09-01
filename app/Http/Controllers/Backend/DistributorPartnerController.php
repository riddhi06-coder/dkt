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
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\User;
use App\Models\DistributorPartner;


class DistributorPartnerController extends Controller
{

    public function index()
    {
        $doctorPartners = DistributorPartner::wherenull('deleted_by')->get();
        return view('backend.partner.distributor.index', compact('doctorPartners'));
    }
    
    public function create(Request $request)
    {
        return view('backend.partner.distributor.create');
    }

    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'banner_heading' => 'required|string|max:255',
                'thumbnail'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
                'description'    => 'required|string',
            ], [
                'banner_heading.required' => 'Banner Heading is required.',
                'banner_heading.string'   => 'Banner Heading must be a valid string.',
                'banner_heading.max'      => 'Banner Heading cannot exceed 255 characters.',
                'thumbnail.required'      => 'Banner Image is required.',
                'thumbnail.image'         => 'Banner Image must be a valid image file.',
                'thumbnail.mimes'         => 'Allowed image types: jpg, jpeg, png, webp.',
                'thumbnail.max'           => 'Maximum allowed image size is 2MB.',
                'description.required'    => 'Description is required.',
                'description.string'      => 'Description must be a valid text.',
            ]);

            $bannerImage = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/home'), $bannerImage);
            }

            // ✅ Save to database
            $doctorPartner = new DistributorPartner();
            $doctorPartner->banner_heading = $validated['banner_heading'];
            $doctorPartner->banner      = $bannerImage;
            $doctorPartner->description = $validated['description'];
            $doctorPartner->inserted_by = Auth::id();
            $doctorPartner->inserted_at = Carbon::now();
            $doctorPartner->save();

            return redirect()->route('manage-distributor-partner.index')
                            ->with('message', 'Distributor Partner details added successfully!');
            
        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; 
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $partner = DistributorPartner::findOrFail($id);
        return view('backend.partner.distributor.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'banner_heading' => 'required|string|max:255',
                'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
                'description'    => 'required|string',
            ], [
                'banner_heading.required' => 'Banner Heading is required.',
                'banner_heading.string'   => 'Banner Heading must be a valid string.',
                'banner_heading.max'      => 'Banner Heading cannot exceed 255 characters.',
                'thumbnail.image'         => 'Banner Image must be a valid image file.',
                'thumbnail.mimes'         => 'Allowed image types: jpg, jpeg, png, webp.',
                'thumbnail.max'           => 'Maximum allowed image size is 2MB.',
                'description.required'    => 'Description is required.',
                'description.string'      => 'Description must be a valid text.',
            ]);

            // Find the record
            $doctorPartner = DistributorPartner::findOrFail($id);

            // Handle new image upload
            if ($request->hasFile('thumbnail')) {
                // Delete old image if exists
                if ($doctorPartner->banner && file_exists(public_path('uploads/home/' . $doctorPartner->banner))) {
                    unlink(public_path('uploads/home/' . $doctorPartner->banner));
                }

                $image = $request->file('thumbnail');
                $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/home'), $bannerImage);
                $doctorPartner->banner = $bannerImage;
            }

            // Update fields
            $doctorPartner->banner_heading = $validated['banner_heading'];
            $doctorPartner->description    = $validated['description'];
            $doctorPartner->modified_by     = Auth::id();
            $doctorPartner->modified_at     = Carbon::now();

            $doctorPartner->save();

            return redirect()->route('manage-distributor-partner.index')
                            ->with('message', 'Distributor Partner details updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = DistributorPartner::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-distributor-partner.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}