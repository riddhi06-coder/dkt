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
                  <h4>Add Privacy Policy Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-privacy-policy.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Privacy Policy</li>
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
                        <h4>Privacy Policy Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-privacy-policy.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>


                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner" type="file" name="banner" required onchange="previewbanner(event)">
                                            <div class="invalid-feedback">Please upload a Banner Image .</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            
                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="bannerPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description">Privcay Policy <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="description" rows="5" placeholder="Enter Privcay Policy here" required value="{{ old('description') }}"></textarea>
                                            <div class="invalid-feedback">Please enter Privcay Policy here.</div>
                                        </div>

                                       
                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-privacy-policy.index') }}" class="btn btn-danger px-4">Cancel</a>
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
        <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

        <script>
            ClassicEditor.create(document.querySelector('#editor'))
                .catch(error => { console.error(error); });
        </script>


       <!----- Image Preview --->
        <script>
            function previewbanner(event) {
                const input = event.target;
                const preview = document.getElementById('bannerPreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none'); // show preview
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = "#";
                    preview.classList.add('d-none'); // hide if no file
                }
            }
        </script>



</body>

</html>