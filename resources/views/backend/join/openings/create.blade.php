<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->


        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Add Join Us Page Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-job-openings.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Join Us Page Details</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Join Us Page Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-job-openings.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Job Role -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="job_role">Job Role <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="job_role" type="text" name="job_role" placeholder="Enter Job Role" required>
                                            <div class="invalid-feedback">Please enter a Job Role.</div>
                                        </div>


                                        <!-- Job Location -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="job_location">Job Location <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="job_location" type="text" name="job_location" placeholder="Enter Job Location" required>
                                            <div class="invalid-feedback">Please enter a Job Location.</div>
                                        </div>

                                      
                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="description_main">Job Description <span class="txt-danger">*</span></label>
                                            <textarea name="description_main" id="summernote" class="form-control" rows="4" placeholder="Enter description" required>{{ old('description_main') }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>


                                        <!-- Optional PDF Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="job_pdf">Upload Job PDF (Optional, Max 2MB)</label>
                                            <input class="form-control" id="job_pdf" type="file" name="job_pdf" accept=".pdf" 
                                                onchange="previewPDF(this, 'pdf_preview')">
                                            <small class="text-secondary"><b>Allowed: PDF only, max size 2MB.</b></small>
                                            <div class="mt-2">
                                                <embed id="pdf_preview" src="#" type="application/pdf" 
                                                    class="d-none" style="width:100%; height:200px; border:1px solid #ddd;">
                                            </div>
                                        </div>


                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-job-openings.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>
       
       @include('components.backend.main-js')



        <script>
            function previewPDF(input, previewId) {
                const file = input.files[0];
                const preview = document.getElementById(previewId);
                if(file && file.type === 'application/pdf'){
                    const url = URL.createObjectURL(file);
                    preview.src = url;
                    preview.classList.remove('d-none');
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                }
            }
        </script>
</body>

</html>