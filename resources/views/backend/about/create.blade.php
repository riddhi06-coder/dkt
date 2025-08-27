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
                  <h4>Add About Us Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-about-us.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add About Us</li>
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
                        <h4>About Us Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-about-us.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <h5 class="mb-3"><strong># Section 1</strong></h5>

                                     <!-- Gallery Image Upload -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <h5 class="mb-4"><strong>Gallery Image Upload</strong></h5>
                                        <table class="table table-bordered p-3" id="galleryTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Uploaded Gallery Image: <span class="text-danger">*</span></th>
                                                    <th>Preview</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="file" onchange="previewGalleryImage(this, 0)" accept=".png, .jpg, .jpeg, .webp" name="gallery_image[]" id="gallery_image_0" class="form-control" placeholder="Upload Gallery Image" multiple required>
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td>
                                                        <div id="gallery-preview-container-0"></div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>



                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                        <label class="form-label" for="description">Small Description <span class="txt-danger">*</span></label>
                                        <textarea id="summernote" class="form-control" name="description" rows="5" placeholder="Enter description here" required value="{{ old('description') }}"></textarea>
                                        <div class="invalid-feedback">Please enter description here.</div>
                                    </div>

                                    <hr>
                                    <h5 class="mb-3"><strong># Section 2</strong></h5>

                                    <!-- Section Image -->
                                    <div class="col-md-6">
                                        <label class="form-label" for="thumbnail">Section Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="thumbnail" type="file" name="thumbnail" required onchange="previewThumbnail(event)">
                                        <div class="invalid-feedback">Please upload a Section Image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        
                                        <!-- Image Preview -->
                                        <div class="mt-2">
                                            <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                        </div>
                                    </div>


                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                        <label class="form-label" for="description">Small Description <span class="txt-danger">*</span></label>
                                        <textarea id="summernote2" class="form-control" name="description" rows="5" placeholder="Enter description here" required value="{{ old('description') }}"></textarea>
                                        <div class="invalid-feedback">Please enter description here.</div>
                                    </div>


                                    <!-- Division Details Table -->
                                    <div class="table-container mb-4">
                                        <h5 class="mb-4"><strong>Division Details</strong></h5>
                                        <table class="table table-bordered p-3" id="compositionTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Icon <span class="txt-danger">*</span></th>
                                                    <th>Title <span class="txt-danger">*</span></th>
                                                    <th>Description <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="compositionBody">
    <tr>
        <td>
            <input type="file" name="icon[]" class="form-control icon-input" onchange="previewIcon(this)" required>
            <div class="mt-2">
                <img class="img-fluid rounded border d-none icon-preview" style="max-height: 80px;">
            </div>
        </td>
        <td>
            <input type="text" name="title[]" class="form-control" placeholder="Enter Title" required>
        </td>
        <td>
            <textarea name="description[]" class="form-control" placeholder="Enter Description" rows="2" required></textarea>
        </td>
        <td>
            <button type="button" class="btn btn-primary" id="addRow">Add More</button>
        </td>
    </tr>
</tbody>



                                        </table>
                                    </div>



                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('manage-about-us.index') }}" class="btn btn-danger px-4">Cancel</a>
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


        <script>
            $(document).ready(function() {
                $('#summernote2').summernote({
                height: 200, // Adjust height as needed
                focus: true   // Focus the editor when initialized
                });
            });
        </script>


        <!-- Scripts for dynamic rows & image preview -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let rowIndex = 1; // dynamic counter for all rows

                const compositionBody = document.getElementById("compositionBody");

                // Add new row
                document.getElementById("addRow").addEventListener("click", function () {
                    const newRow = document.createElement("tr");

                    newRow.innerHTML = `
                        <td>
                            <input type="file" name="icon[]" class="form-control icon-input" onchange="previewIcon(this)" required>
                            <div class="mt-2">
                                <img class="img-fluid rounded border d-none icon-preview" style="max-height: 80px;">
                            </div>
                        </td>
                        <td>
                            <input type="text" name="title[]" class="form-control" placeholder="Enter Title" required>
                        </td>
                        <td>
                            <textarea name="description[]" class="form-control" placeholder="Enter Description" rows="2" required></textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removeRow">Remove</button>
                        </td>
                    `;

                    compositionBody.appendChild(newRow);
                    rowIndex++;
                });

                // Remove row
                compositionBody.addEventListener("click", function(e) {
                    if(e.target.classList.contains("removeRow")) {
                        e.target.closest("tr").remove();
                    }
                });
            });

            // Preview function (works for all rows)
            function previewIcon(input) {
                const file = input.files[0];
                const preview = input.closest("td").querySelector(".icon-preview");

                if(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.classList.add('d-none');
                }
            }
        </script>





</body>

</html>