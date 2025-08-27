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
                  <h4>Add Product Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-product-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Product Details</li>
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
                        <h4>Product Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-product-details.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label">Select Category <span class="txt-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                <option value="">-- Select Category --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a category.</div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_id" class="form-label">Select Product <span class="txt-danger">*</span></label>
                                            <select name="product_id" id="product_id" class="form-select" required>
                                                <option value="">-- Select Product --</option>
                                                <!-- Products will be loaded dynamically based on category -->
                                            </select>
                                            <div class="invalid-feedback">Please select a product.</div>
                                        </div>



                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail">Banner Image </label>
                                            <input class="form-control" id="thumbnail" type="file" name="thumbnail" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            
                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                            </div>
                                        </div>

                                        <hr>

                                         <!-- Product Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="product_image">Product Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="product_image" type="file" name="product_image" required onchange="previewproduct(event)">
                                            <div class="invalid-feedback">Please upload a Product image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            
                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="productPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label" for="buy_now">Buy Now URL </label>
                                            <input class="form-control" id="buy_now" type="text" name="buy_now" placeholder="Enter Buy Now URL">
                                            <div class="invalid-feedback">Please enter a Buy Now URL.</div>
                                        </div>


                                        <!-- Description Textarea -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="description" id="summernote" class="form-control" rows="4" placeholder="Enter description" required>{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>


                                        <!-- Product Use of Tablet Textarea -->
                                        <div class="col-md-12">
                                            <label for="use_of_tablet" class="form-label">Use of Tablet <span class="txt-danger">*</span></label>
                                            <textarea name="use_of_tablet" id="summernote2" class="form-control" rows="4" placeholder="Enter Use of Tablet" required>{{ old('use_of_tablet') }}</textarea>
                                            <div class="invalid-feedback">Please enter a Use of Tablet.</div>
                                        </div>

                                        <!-- Product Direction To use Textarea -->
                                        <div class="col-md-12">
                                            <label for="direction_to_use" class="form-label">Direction To use <span class="txt-danger">*</span></label>
                                            <textarea name="direction_to_use" id="summernote3" class="form-control" rows="4" placeholder="Enter Direction To use" required>{{ old('direction_to_use') }}</textarea>
                                            <div class="invalid-feedback">Please enter a Direction To use.</div>
                                        </div>


                                        <!-- Tablet & Dose Table -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <h5 class="mb-4"><strong>Composition Details</strong></h5>
                                            <table class="table table-bordered p-3" id="tabletTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Tablet Name <span class="txt-danger">*</span></th>
                                                        <th>Dose <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="tablet_name[]" id="tablet_name_0" class="form-control" placeholder="Enter Tablet Name" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="dose[]" id="dose_0" class="form-control" placeholder="Enter Dose" required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" id="addTabletRow">Add More</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-product-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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

            function previewproduct(event) {
                const input = event.target;
                const preview = document.getElementById('productPreview');

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


        <!-- Add/Remove Row JS -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let rowIndex = 1; // start index for new rows

                // Add new row
                document.getElementById("addTabletRow").addEventListener("click", function () {
                    const tableBody = document.querySelector("#tabletTable tbody");
                    const newRow = document.createElement("tr");

                    newRow.innerHTML = `
                        <td>
                            <input type="text" name="tablet_name[]" id="tablet_name_${rowIndex}" class="form-control" placeholder="Enter Tablet Name" required>
                        </td>
                        <td>
                            <input type="text" name="dose[]" id="dose_${rowIndex}" class="form-control" placeholder="Enter Dose" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removeTabletRow">Remove</button>
                        </td>
                    `;

                    tableBody.appendChild(newRow);
                    rowIndex++;
                });

                // Remove row
                document.querySelector("#tabletTable").addEventListener("click", function (e) {
                    if (e.target.classList.contains("removeTabletRow")) {
                        const row = e.target.closest("tr");
                        row.remove();
                    }
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = document.getElementById('category_id');
                const productSelect = document.getElementById('product_id');

                categorySelect.addEventListener('change', function() {
                    const categoryId = this.value;
                    
                    // Clear previous options
                    productSelect.innerHTML = '<option value="">-- Select Product --</option>';

                    if (categoryId) {
                        fetch(`/get-products/${categoryId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(product => {
                                    const option = document.createElement('option');
                                    option.value = product.id;
                                    option.textContent = product.product_name;
                                    productSelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching products:', error));
                    }
                });
            });
        </script>

</body>

</html>