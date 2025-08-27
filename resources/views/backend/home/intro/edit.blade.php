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
                  <h4>Edit Introduction Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-intro-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Introduction</li>
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
                        <h4>Introduction Form</h4>
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
                                        action="{{ route('manage-intro-details.update', $intro->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Thumbnail Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only .jpg, .jpeg, .png, .webp allowed.</b></small>

                                            <!-- Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="{{ asset('uploads/home/' . $intro->image) }}" 
                                                    alt="Preview" class="img-fluid rounded border" style="max-height:150px;">
                                            </div>
                                        </div>

                                        <!-- Results Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="results_image">Results Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="results_image" type="file" name="results_image" onchange="previewResultsImage(event)">
                                            <div class="invalid-feedback">Please upload a Results image.</div>
                                            <small class="text-secondary"><b>Note: Max size 2MB. Only .jpg, .jpeg, .png, .webp allowed.</b></small>

                                            <!-- Preview -->
                                            <div class="mt-2">
                                                <img id="resultsPreview" src="{{ asset('uploads/home/' . $intro->results_image) }}" 
                                                    alt="Preview" class="img-fluid rounded border" style="max-height:150px;">
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="description" id="summernote" class="form-control" rows="4" required>{{ old('description', $intro->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <hr>

                                        <!-- Gallery Images -->
                                        <div class="table-container" style="margin-bottom:20px;">
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <h5 class="mb-0"><strong>Product Display Ribbon</strong></h5>
                                                <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                            </div>

                                            <table class="table table-bordered p-3" id="galleryTable">
                                                <thead>
                                                    <tr>
                                                        <th>Product Image <span class="text-danger">*</span></th>
                                                        <th>Preview</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($galleryImages as $index => $image)
                                                        <tr>
                                                            <td>
                                                                <input type="file" onchange="previewGalleryImage(this, {{ $index }})" 
                                                                    accept=".png,.jpg,.jpeg,.webp" name="gallery_image[]" 
                                                                    id="gallery_image_{{ $index }}" class="form-control">
                                                                    {{-- hidden input to preserve existing image --}}
                                                                    <input type="hidden" name="existing_gallery[]" value="{{ $image }}">
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            </td>
                                                            <td>
                                                                <div id="gallery-preview-container-{{ $index }}">
                                                                    <img src="{{ asset('uploads/home/' . $image) }}" style="max-height:100px;">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger removeRow">Remove</button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3">No gallery images uploaded.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-intro-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
            function previewResultsImage(event) {
                const input = event.target;
                const preview = document.getElementById('resultsPreview');

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
            $(document).ready(function () {
                // Start rowId from the last index of DB images
                let rowId = {{ count($galleryImages) > 0 ? count($galleryImages) : 0 }};

                // Add a new gallery image row
                $('#addGalleryRow').click(function () {
                    rowId++;
                    const newRow = `
                        <tr>
                            <td>
                                <input type="file" onchange="previewGalleryImage(this, ${rowId})" 
                                    accept=".png,.jpg,.jpeg,.webp" name="gallery_image[]" 
                                    id="gallery_image_${rowId}" class="form-control">
                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                <br>
                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                            </td>
                            <td>
                                <div id="gallery-preview-container-${rowId}"></div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeRow">Remove</button>
                            </td>
                        </tr>`;
                    $('#galleryTable tbody').append(newRow);
                });

                // Remove a gallery image row
                $(document).on('click', '.removeRow', function () {
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