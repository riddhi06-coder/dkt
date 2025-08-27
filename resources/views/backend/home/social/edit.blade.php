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
                  <h4>Edit Social Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-social-home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Social Details</li>
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
                        <h4>Social Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate 
                                        action="{{ route('manage-social-home.update', $intro->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- for update -->

                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title">Section Title</label>
                                            <input class="form-control" id="section_title" type="text" 
                                                name="section_title" 
                                                value="{{ old('section_title', $intro->section_title) }}" 
                                                placeholder="Enter Section Title">
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>

                                        <hr>

                                        <!-- Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="heading" type="text" 
                                                name="heading" required
                                                value="{{ old('heading', $intro->heading) }}" 
                                                placeholder="Enter Heading">
                                            <div class="invalid-feedback">Please enter a Heading.</div>
                                        </div>

                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="title" type="text" 
                                                name="title" required
                                                value="{{ old('title', $intro->title) }}" 
                                                placeholder="Enter Title">
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>

                                        <!-- Thumbnail Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Image</label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                @if($intro->image)
                                                    <img id="thumbnailPreview" src="{{ asset('uploads/home/' . $intro->image) }}" 
                                                        alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Video URL -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_video">Banner Video URL</label>
                                            <input class="form-control" id="banner_video" type="url" name="banner_video"
                                                value="{{ old('banner_video', $intro->banner_video) }}"
                                                placeholder="Enter video URL (YouTube, Vimeo, or MP4 link)">
                                            <small class="text-secondary"><b>Note: Paste a valid video link.</b></small>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-social-home.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Update</button>
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
            function previewThumbnail(event) {
                const input = event.target;
                const preview = document.getElementById('thumbnailPreview');

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

        <script>
            function previewVideo(event) {
                const input = event.target;
                const preview = document.getElementById('videoPreview');

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const url = URL.createObjectURL(file);
                    preview.src = url;
                    preview.classList.remove('d-none');
                    preview.load();
                } else {
                    preview.src = "#";
                    preview.classList.add('d-none');
                }
            }
        </script>

</body>

</html>