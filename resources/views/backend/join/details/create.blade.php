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
                    <a href="{{ route('manage-join-page-details.index') }}">Home</a>
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
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-join-page-details.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_image">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" required onchange="previewImage(this, 'banner_preview')">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: Max size 2MB. Allowed: jpg, jpeg, png, webp.</b></small>
                                            <div class="mt-2">
                                                <img id="banner_preview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height:150px;">
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewImage(this, 'section_preview')" required>
                                            <div class="invalid-feedback">Please upload an image.</div>
                                             <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="mt-2">
                                                <img id="section_preview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height:150px;">
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="description_main">Description <span class="txt-danger">*</span></label>
                                            <textarea name="description_main" id="summernote" class="form-control" rows="4" placeholder="Enter description" required>{{ old('description_main') }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <hr>
                                        <h4># Why DKT Section</h4>

                                        <!-- Why DKT Description -->
                                        <div class="col-md-12 mt-5">
                                            <label class="form-label" for="why_dkt_description">Section Description <span class="txt-danger">*</span></label>
                                            <textarea name="why_dkt_description" id="summernote1" class="form-control" rows="4" placeholder="Enter description" required>{{ old('why_dkt_description') }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <!-- Features Table -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <h5 class="mb-4"><strong>Features</strong></h5>
                                            <table class="table table-bordered p-3" id="printsTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Icon <span class="text-danger">*</span></th>
                                                        <th>Heading <span class="text-danger">*</span></th>
                                                        <th>Description <span class="text-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="file" onchange="previewPrintImage(this, 0)" accept=".png, .jpg, .jpeg, .webp, .svg" 
                                                                name="icon[]" id="icon_0" class="form-control" required>
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            <div class="mt-2" id="print-preview-container-0"></div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="heading[]" class="form-control" placeholder="Enter Heading" required>
                                                        </td>
                                                        <td>
                                                            <textarea name="description_division[]" class="form-control" placeholder="Enter Description" rows="5" required></textarea>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" id="addPrintRow">Add More</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <hr>
                                        <h4># Current Openings Section</h4>

                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" placeholder="Enter Section Heading" required>
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>


                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_title">Section Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_title" type="text" name="section_title" placeholder="Enter Section Title" required>
                                            <div class="invalid-feedback">Please enter a Section Title.</div>
                                        </div>

                                        <hr>
                                        <h4># Find Right Role Section</h4>


                                        <!-- Right Role Section -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="right_role_image">Background Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="right_role_image" type="file" name="right_role_image" onchange="previewImage(this, 'right_role_preview')" required>
                                             <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="mt-2">
                                                <img id="right_role_preview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height:150px;">
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <label for="right_role_description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="right_role_description" id="summernote2" class="form-control" rows="4" placeholder="Enter description" required>{{ old('right_role_description') }}</textarea>
                                        </div>


                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-join-page-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
            $(document).ready(function() {
                $('#summernote1').summernote({
                height: 200, // Adjust height as needed
                focus: true   // Focus the editor when initialized
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#summernote2').summernote({
                height: 200, // Adjust height as needed
                focus: true   // Focus the editor when initialized
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let rowIndex = 1; // Start row index for new rows

                // Add row functionality
                document.getElementById("addPrintRow").addEventListener("click", function () {
                    const tableBody = document.querySelector("#printsTable tbody");
                    const newRow = document.createElement("tr");

                    newRow.innerHTML = `
                        <td>
                            <input type="file" onchange="previewPrintImage(this, ${rowIndex})" 
                                accept=".png, .jpg, .jpeg, .webp, .svg" 
                                name="icon[]" id="icon_${rowIndex}" class="form-control" required>
                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                    <br>
                                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                            <div class="mt-2" id="print-preview-container-${rowIndex}"></div>
                        </td>
                        <td>
                            <input type="text" name="heading[]" class="form-control" placeholder="Enter Heading" required>
                        </td>
                        <td>
                            <textarea name="description[]" class="form-control" placeholder="Enter Description" rows="5" required></textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                        </td>
                    `;

                    tableBody.appendChild(newRow);
                    rowIndex++; // Increment row index for unique IDs
                });

                // Remove row functionality
                document.querySelector("#printsTable").addEventListener("click", function (e) {
                    if (e.target.classList.contains("removePrintRow")) {
                        e.target.closest("tr").remove();
                    }
                });
            });

            // Image preview function
            function previewPrintImage(input, index) {
                const previewContainer = document.getElementById(`print-preview-container-${index}`);
                previewContainer.innerHTML = ""; // Clear previous preview

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.className = "img-fluid rounded border";
                        img.style.maxHeight = "80px";
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- JS for Image Preview -->
        <script>
            function previewImage(input, previewId) {
                const preview = document.getElementById(previewId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

</body>

</html>