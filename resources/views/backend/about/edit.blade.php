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
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-about-us.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" value="{{ old('banner_heading', $about->banner_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner" type="file" name="banner" onchange="previewbanner(event)">
                                            <div class="invalid-feedback">Please upload a Banner Image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="mt-2">
                                                @if($about->banner)
                                                <img id="bannerPreview" src="{{ asset('uploads/about/' . $about->banner) }}" alt="Banner Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                <img id="bannerPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <hr>
                                        <h5 class="mb-3"><strong># Section 1</strong></h5>

                                        <!-- Gallery Image Upload -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0"><strong>Gallery Image Upload</strong></h5>
                                                <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                            </div>

                                            <table class="table table-bordered p-3" id="galleryTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Uploaded Gallery Image: <span class="text-danger">*</span></th>
                                                        <th>Preview</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($galleryImages as $index => $gallery)
                                                    <tr>
                                                        <td>
                                                            <input type="file" name="gallery_image[]" onchange="previewGalleryImage(this, {{ $index }})" class="form-control" accept=".png,.jpg,.jpeg,.webp">
                                                            <input type="hidden" name="gallery_image_existing[]" value="{{ $gallery }}">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                        </td>
                                                        <td>
                                                            <div id="gallery-preview-container-{{ $index }}">
                                                                <img src="{{ asset('uploads/about/' . $gallery) }}" alt="Gallery" class="img-fluid rounded border" style="max-height: 100px;">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger removeGalleryRow">Remove</button>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td>
                                                            <input type="file" name="gallery_image[]" onchange="previewGalleryImage(this, 0)" class="form-control" accept=".png,.jpg,.jpeg,.webp" required>
                                                        </td>
                                                        <td>
                                                            <div id="gallery-preview-container-0"></div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Section 1 Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description1">Small Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" class="form-control" name="description1" rows="5" placeholder="Enter description here" required>{{ old('description1', $about->section1_description ?? '') }}</textarea>
                                            <div class="invalid-feedback">Please enter description here.</div>
                                        </div>

                                        <hr>
                                        <h5 class="mb-3"><strong># Section 2</strong></h5>

                                        <!-- Section 2 Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Section Image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="mt-2">
                                                @if($about->section_image)
                                                <img id="thumbnailPreview" src="{{ asset('uploads/about/' . $about->section_image) }}" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                <img id="thumbnailPreview" src="#" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Section 2 Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description2">Small Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote2" class="form-control" name="description2" rows="5" placeholder="Enter description here" required>{{ old('description2', $about->section2_description ?? '') }}</textarea>
                                            <div class="invalid-feedback">Please enter description here.</div>
                                        </div>

                                        <!-- Division Details -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0"><strong>Division Details</strong></h5>
                                                <button type="button" class="btn btn-primary" id="addPrintRow">Add More</button>
                                            </div>

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
                                                    @forelse($divisionDetails as $index => $detail)
                                                    <tr>
                                                        <td>
                                                            <input type="file" name="icon[]" onchange="previewPrintImage(this, {{ $index }})" class="form-control">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            <div id="print-preview-container-{{ $index }}">
                                                                <img src="{{ asset('uploads/about/' . $detail['icon']) }}" class="img-fluid rounded border" style="max-height: 80px;">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="heading[]" class="form-control" value="{{ $detail['heading'] }}">
                                                        </td>
                                                        <td>
                                                            <textarea name="description_division[]" class="form-control" rows="5">{{ $detail['description'] }}</textarea>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td>
                                                            <input type="file" name="icon[]" class="form-control" required>
                                                            <div id="print-preview-container-0"></div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="heading[]" class="form-control" required>
                                                        </td>
                                                        <td>
                                                            <textarea name="description_division[]" class="form-control" rows="5" required></textarea>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" id="addPrintRow">Add More</button>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <hr>
                                        <h5 class="mb-3"><strong># Section 3</strong></h5>

                                        <!-- Section 3 Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image1">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_image1" type="file" name="section_image1" onchange="previewThumbnail1(event)">
                                            <div class="invalid-feedback">Please upload a Section Image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="mt-2">
                                                @if($about->section_image1)
                                                <img id="thumbnail1Preview" src="{{ asset('uploads/about/' . $about->section_image1) }}" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                <img id="thumbnail1Preview" src="#" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Section 3 Description -->
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <label class="form-label" for="description3">Small Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote3" class="form-control" name="description3" rows="5" placeholder="Enter description here" required>{{ old('description3', $about->section3_description ?? '') }}</textarea>
                                            <div class="invalid-feedback">Please enter description here.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-about-us.index') }}" class="btn btn-danger px-4">Cancel</a>
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


       <!----- Image Preview --->
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

            function previewThumbnail1(event) {
                const input = event.target;
                const preview = document.getElementById('thumbnail1Preview');

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


        <!----- Summernote script --->
        <script>
            $(document).ready(function() {
                $('#summernote2').summernote({
                height: 200, // Adjust height as needed
                focus: true   // Focus the editor when initialized
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#summernote3').summernote({
                height: 200, // Adjust height as needed
                focus: true   // Focus the editor when initialized
                });
            });
        </script>


        <!-- Scripts for dynamic rows & image preview Division Details -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Initialize rowIndex with the last existing index
                let rowIndex = {{ isset($divisionDetails) ? count($divisionDetails) : 0 }};

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
                            <textarea name="description_division[]" class="form-control" placeholder="Enter Description" rows="5" required></textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removeRow">Remove</button>
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



        <!--- Gallery Image Upload js ----->
        <script>
            $(document).ready(function () {
                // Initialize rowId with the last existing gallery index
                let rowId = {{ count($galleryImages) > 0 ? count($galleryImages) - 1 : 0 }};

                // Add a new gallery image row
                $('#addGalleryRow').click(function () {
                    rowId++;
                    const newRow = `
                        <tr>
                            <td>
                                <input type="file" onchange="previewGalleryImage(this, ${rowId})" accept=".png,.jpg,.jpeg,.webp" name="gallery_image[]" id="gallery_image_${rowId}" class="form-control" placeholder="Upload Gallery Image">
                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                <br>
                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                            </td>
                            <td>
                                <div id="gallery-preview-container-${rowId}"></div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeGalleryRow">Remove</button>
                            </td>
                        </tr>`;
                    $('#galleryTable tbody').append(newRow);
                });

                // Remove a gallery image row
                $(document).on('click', '.removeGalleryRow', function () {
                    $(this).closest('tr').remove();
                });
            });

            // Preview function for gallery images
            function previewGalleryImage(input, rowId) {
                const file = input.files[0];
                const previewContainer = document.getElementById(`gallery-preview-container-${rowId}`);

                // Clear previous preview
                previewContainer.innerHTML = '';

                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '120px';
                            img.style.maxHeight = '100px';
                            img.style.objectFit = 'cover';

                            previewContainer.appendChild(img);
                        };

                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.innerHTML = '<p>Unsupported file type</p>';
                    }
                }
            }

        </script>




</body>

</html>