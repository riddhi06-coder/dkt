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
use App\Models\ContactDetail;


class ContactController extends Controller
{

    public function index()
    {
        return view('backend.contact.index');
    }

    public function create(Request $request)
    {
        return view('backend.contact.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'email'                => 'required|email|max:255',
            'url'                  => 'required|url|max:500',
            'contact_number'       => ['required', 'regex:/^\+?[0-9]{1,4}?[-. ]?(\(?\d{1,3}?\)?[-. ]?)?[\d]{1,4}[-. ]?[\d]{1,4}[-. ]?[\d]{1,9}$/', 'max:12'],
            'other_contact_number' => ['required', 'regex:/^\+?[0-9]{1,4}?[-. ]?(\(?\d{1,3}?\)?[-. ]?)?[\d]{1,4}[-. ]?[\d]{1,4}[-. ]?[\d]{1,9}$/', 'max:12'],
            'i_frame'              => 'required|url|max:1000',
            'address'              => 'required|string|max:2000',
            'social_media.*.platform' => 'required|string',
            'social_media.*.link'     => 'required|url',
        ], [
            'email.required'                => 'Email is required.',
            'email.email'                   => 'Please enter a valid email address.',
            'url.required'                  => 'Gmap URL is required.',
            'url.url'                        => 'Please enter a valid Gmap URL.',
            'contact_number.required'       => 'Contact Number is required.',
            'contact_number.regex'          => 'Please enter a valid Contact Number.',
            'other_contact_number.required' => 'Other Contact Number is required.',
            'other_contact_number.regex'    => 'Please enter a valid Other Contact Number.',
            'i_frame.required'              => 'IFrame URL is required.',
            'i_frame.url'                   => 'Please enter a valid IFrame URL.',
            'address.required'              => 'Address is required.',
            'social_media.*.platform.required' => 'Social Media Platform is required.',
            'social_media.*.link.required'     => 'Social Media Link is required.',
            'social_media.*.link.url'          => 'Please enter a valid URL for Social Media Link.',
        ]);

        try {
            // ✅ Store in database
            $contactDetails = new ContactDetail();
            $contactDetails->email                = $request->email;
            $contactDetails->url                  = $request->url;
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

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! '.$e->getMessage())
                        ->withInput();
        }
    }

}