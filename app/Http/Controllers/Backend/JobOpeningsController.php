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
use App\Models\JobOpening;


class JobOpeningsController extends Controller
{

    public function index()
    {
        $jobOpenings = JobOpening::orderBy('inserted_at', 'asc')->get();
        return view('backend.join.openings.index', compact('jobOpenings'));
    }

    public function create(Request $request)
    {
        return view('backend.join.openings.create');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate form inputs with custom messages
        $validator = Validator::make($request->all(), [
            'job_role' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'description_main' => 'required|string',
            'job_pdf' => 'nullable|mimes:pdf|max:2048', // optional PDF up to 2MB
        ], [
            'job_role.required' => 'Please enter the Job Role.',
            'job_role.string' => 'Job Role must be a valid string.',
            'job_role.max' => 'Job Role cannot exceed 255 characters.',

            'job_location.required' => 'Please enter the Job Location.',
            'job_location.string' => 'Job Location must be a valid string.',
            'job_location.max' => 'Job Location cannot exceed 255 characters.',

            'description_main.required' => 'Please enter the Job Description.',
            'description_main.string' => 'Job Description must be valid text.',

            'job_pdf.mimes' => 'Only PDF files are allowed for upload.',
            'job_pdf.max' => 'PDF file size cannot exceed 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Step 2: Handle PDF upload if exists
        $pdfFileName = null;
        if ($request->hasFile('job_pdf')) {
            $pdf = $request->file('job_pdf');
            $pdfFileName = time() . rand(10, 999) . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('uploads/jobs'), $pdfFileName);
        }

        // ✅ Step 3: Store data in database
        $jobOpening = new JobOpening(); // Assuming model name is JobOpening
        $jobOpening->job_role = $request->job_role;
        $jobOpening->job_location = $request->job_location;
        $jobOpening->description_main = $request->description_main;
        $jobOpening->job_pdf = $pdfFileName; // store PDF filename or null
        $jobOpening->inserted_by = Auth::id();
        $jobOpening->inserted_at = Carbon::now();
        $jobOpening->save();

        // ✅ Step 4: Redirect with success message
        return redirect()->route('manage-job-openings.index')
            ->with('message', 'Job Opening saved successfully!');
    }

    public function edit($id)
    {
        $intro = JobOpening::findOrFail($id);
        return view('backend.join.openings.edit', compact('intro'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Step 1: Validate inputs with same rules and messages
        $validator = Validator::make($request->all(), [
            'job_role' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'description_main' => 'required|string',
            'job_pdf' => 'nullable|mimes:pdf|max:2048', // optional PDF up to 2MB
        ], [
            'job_role.required' => 'Please enter the Job Role.',
            'job_role.string' => 'Job Role must be a valid string.',
            'job_role.max' => 'Job Role cannot exceed 255 characters.',

            'job_location.required' => 'Please enter the Job Location.',
            'job_location.string' => 'Job Location must be a valid string.',
            'job_location.max' => 'Job Location cannot exceed 255 characters.',

            'description_main.required' => 'Please enter the Job Description.',
            'description_main.string' => 'Job Description must be valid text.',

            'job_pdf.mimes' => 'Only PDF files are allowed for upload.',
            'job_pdf.max' => 'PDF file size cannot exceed 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Step 2: Find existing record
        $jobOpening = JobOpening::findOrFail($id);

        // ✅ Step 3: Handle PDF upload (replace old if new uploaded)
        if ($request->hasFile('job_pdf')) {
            // Delete old PDF if exists
            if ($jobOpening->job_pdf && file_exists(public_path('uploads/jobs/' . $jobOpening->job_pdf))) {
                unlink(public_path('uploads/jobs/' . $jobOpening->job_pdf));
            }

            $pdf = $request->file('job_pdf');
            $pdfFileName = time() . rand(10, 999) . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('uploads/jobs'), $pdfFileName);
            $jobOpening->job_pdf = $pdfFileName;
        }

        // ✅ Step 4: Update other fields
        $jobOpening->job_role = $request->job_role;
        $jobOpening->job_location = $request->job_location;
        $jobOpening->description_main = $request->description_main;
        $jobOpening->modified_by = Auth::id();
        $jobOpening->modified_at = Carbon::now();
        $jobOpening->save();

        // ✅ Step 5: Redirect with success message
        return redirect()->route('manage-job-openings.index')
            ->with('message', 'Job Opening updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = JobOpening::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-job-openings.index')->with('message', 'Data deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}