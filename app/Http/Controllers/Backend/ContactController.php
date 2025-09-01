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
use App\Models\ContactDetail;


class ContactController extends Controller
{

    public function index()
    {
        $contacts = ContactDetail::wherenull('deleted_by')->get(); 
        return view('backend.contact.index', compact('contacts'));
    }

    public function create(Request $request)
    {
        return view('backend.contact.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email'                => 'required|email|max:255',
                'url'                  => 'required|url|max:500',
                'contact_number'       => ['required', 'digits_between:8,15'],
                'other_contact_number' => ['required', 'digits_between:8,15'],
                'i_frame'              => 'required|string|max:2000', 
                'address'              => 'required|string|max:2000',
                'social_media.*.platform' => 'required|string',
                'social_media.*.link'     => 'required|url',
            ], [
                'email.required'                => 'Email is required.',
                'email.email'                   => 'Please enter a valid email address.',
                'url.required'                  => 'Gmap URL is required.',
                'url.url'                       => 'Please enter a valid Gmap URL.',
                'contact_number.required'       => 'Contact Number is required.',
                'contact_number.digits_between' => 'Please enter a valid Contact Number (8–15 digits).',
                'other_contact_number.required' => 'Other Contact Number is required.',
                'other_contact_number.digits_between' => 'Please enter a valid Other Contact Number (8–15 digits).',
                'i_frame.required'              => 'IFrame embed code is required.',
                'address.required'              => 'Address is required.',
                'social_media.*.platform.required' => 'Social Media Platform is required.',
                'social_media.*.link.required'     => 'Social Media Link is required.',
                'social_media.*.link.url'          => 'Please enter a valid URL for Social Media Link.',
            ]);


            // ✅ Store in database
            $contactDetails = new ContactDetail();
            $contactDetails->email                = $request->email;
            $contactDetails->map_url                  = $request->url;
            $contactDetails->contact_number       = $request->contact_number;
            $contactDetails->other_contact_number = $request->other_contact_number;
            $contactDetails->i_frame              = $request->i_frame;
            $contactDetails->address              = $request->address;

            // JSON encode social media links
            $contactDetails->social_media_links = json_encode($request->social_media);

            $contactDetails->inserted_by = Auth::id();
            $contactDetails->inserted_at = Carbon::now();


            $contactDetails->save();


            return redirect()->route('manage-contact-details.index')
                            ->with('message', 'Contact Details saved successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; 
        } catch (\Exception $e) {
          
            return back()->with('error', 'Something went wrong! '.$e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $contact = ContactDetail::findOrFail($id);
        $contact_details = $contact->social_media_links ? json_decode($contact->social_media_links, true) : [];

        return view('backend.contact.edit', compact('contact', 'contact_details'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'email'                => 'required|email|max:255',
                'url'                  => 'required|url|max:500',
                'contact_number'       => ['required', 'digits_between:8,15'],
                'other_contact_number' => ['required', 'digits_between:8,15'],
                'i_frame'              => 'required|string|max:2000', 
                'address'              => 'required|string|max:2000',
                'social_media.*.platform' => 'required|string',
                'social_media.*.link'     => 'required|url',
            ], [
                'email.required'                => 'Email is required.',
                'email.email'                   => 'Please enter a valid email address.',
                'url.required'                  => 'Gmap URL is required.',
                'url.url'                       => 'Please enter a valid Gmap URL.',
                'contact_number.required'       => 'Contact Number is required.',
                'contact_number.digits_between' => 'Please enter a valid Contact Number (8–15 digits).',
                'other_contact_number.required' => 'Other Contact Number is required.',
                'other_contact_number.digits_between' => 'Please enter a valid Other Contact Number (8–15 digits).',
                'i_frame.required'              => 'IFrame embed code is required.',
                'address.required'              => 'Address is required.',
                'social_media.*.platform.required' => 'Social Media Platform is required.',
                'social_media.*.link.required'     => 'Social Media Link is required.',
                'social_media.*.link.url'          => 'Please enter a valid URL for Social Media Link.',
            ]);

            // ✅ Find record
            $contactDetails = ContactDetail::findOrFail($id);

            // ✅ Update fields
            $contactDetails->email                = $request->email;
            $contactDetails->map_url              = $request->url;
            $contactDetails->contact_number       = $request->contact_number;
            $contactDetails->other_contact_number = $request->other_contact_number;
            $contactDetails->i_frame              = $request->i_frame;
            $contactDetails->address              = $request->address;

            // JSON encode social media links
            $contactDetails->social_media_links   = json_encode($request->social_media);

            $contactDetails->modified_by = Auth::id();
            $contactDetails->modified_at = Carbon::now();

            $contactDetails->save();

            return redirect()->route('manage-contact-details.index')
                            ->with('message', 'Contact Details updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; 
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! '.$e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ContactDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-contact-details.index')->with('message', 'Data deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}