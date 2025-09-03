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
                  <h4>Edit Product Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-product-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Product Details</li>
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
                                    <form class="row g-3 needs-validation custom-input" novalidate 
                                        action="{{ route('manage-product-details.update', $productDetails->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Category -->
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label">Select Category <span class="txt-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                <option value="">-- Select Category --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                        {{ $productDetails->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a category.</div>
                                        </div>


                                        <!-- Product Name -->
                                        <div class="col-md-6">
                                            <label for="product_id" class="form-label">Select Product <span class="txt-danger">*</span></label>
                                            <!-- Product Name -->
                                            <select name="product_id" id="product_id" class="form-select" required>
                                                @foreach($productsOfCategory as $product)
                                                    <option value="{{ $product->id }}" {{ $productDetails->id == $product->id ? 'selected' : '' }}>
                                                        Product #{{ $product->id }}  <!-- Use ID or any descriptive text -->
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a product.</div>
                                        </div>


                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail">Banner Image </label>
                                            <input class="form-control" id="thumbnail" type="file" name="thumbnail" onchange="previewThumbnail(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            @if($productDetails->thumbnail_image)
                                                <div class="mt-2">
                                                    <img id="thumbnailPreview" src="{{ asset('uploads/products/' . $productDetails->thumbnail_image) }}" 
                                                        alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                                </div>
                                            @endif
                                        </div>

                                        <hr>

                                        <!-- Product Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="product_image">Product Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="product_image" type="file" name="product_image" onchange="previewproduct(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            @if($productDetails->product_image)
                                                <div class="mt-2">
                                                    <img id="productPreview" src="{{ asset('uploads/products/' . $productDetails->product_image) }}" 
                                                        alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Buy Now URL -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="buy_now">Buy Now URL </label>
                                            <input class="form-control" id="buy_now" type="text" name="buy_now" 
                                                value="{{ $productDetails->buy_now }}" placeholder="Enter Buy Now URL">
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="description" id="summernote" class="form-control" rows="4" required>{{ $productDetails->description }}</textarea>
                                        </div>

                                        <!-- Use of Tablet -->
                                        <div class="col-md-12">
                                            <label for="use_of_tablet" class="form-label">Use of Tablet <span class="txt-danger">*</span></label>
                                            <textarea name="use_of_tablet" id="summernote2" class="form-control" rows="4" required>{{ $productDetails->use_of_tablet }}</textarea>
                                        </div>

                                        <!-- Direction To Use -->
                                        <div class="col-md-12">
                                            <label for="direction_to_use" class="form-label">Direction To Use <span class="txt-danger">*</span></label>
                                            <textarea name="direction_to_use" id="summernote3" class="form-control" rows="4" required>{{ $productDetails->direction_to_use }}</textarea>
                                        </div>

                                        <!-- Tablet & Dose Table -->
                                        <div class="table-container mb-4">
                                            <h5><strong>Composition Details</strong></h5>
                                            <table class="table table-bordered" id="tabletTable">
                                                <thead>
                                                    <tr>
                                                        <th>Tablet Name <span class="txt-danger">*</span></th>
                                                        <th>Dose <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $composition = json_decode($productDetails->composition, true) ?? [];
                                                    @endphp
                                                    @foreach($composition as $index => $item)
                                                        <tr>
                                                            <td><input type="text" name="tablet_name[]" class="form-control" value="{{ $item['tablet_name'] }}" required></td>
                                                            <td><input type="text" name="dose[]" class="form-control" value="{{ $item['dose'] }}" required></td>
                                                            <td>
                                                                @if($index == 0)
                                                                    <button type="button" class="btn btn-primary" id="addTabletRow">Add More</button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger removeRow">Remove</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-product-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                            <button type="button" class="btn btn-danger removeRow">Remove</button>
                        </td>
                    `;

                    tableBody.appendChild(newRow);
                    rowIndex++;
                });

                // Remove row
                document.querySelector("#tabletTable").addEventListener("click", function (e) {
                    if (e.target.classList.contains("removeRow")) {
                        const row = e.target.closest("tr");
                        row.remove();
                    }
                });
            });
        </script>


        <script>
            function loadProducts(categoryId, selectedProductId = null) {
                let productSelect = document.getElementById('product_id');
                productSelect.innerHTML = '<option value="">-- Select Product --</option>'; // reset

                if (categoryId) {
    const origin = window.location.origin; // https://anvayafoundation.com
    const pathParts = window.location.pathname.split('/'); 
    const basePath = pathParts.length > 1 ? `/${pathParts[1]}` : ''; // "/dkt"
    const baseUrl = origin + basePath; // https://anvayafoundation.com/dkt

    const fetchUrl = `${baseUrl}/get-products/${categoryId}`;

    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            // clear existing options
            productSelect.innerHTML = '<option value="">Select Product</option>';

            data.forEach(product => {
                let option = document.createElement('option');
                option.value = product.id;
                option.text = product.product_name;

                // select stored product in edit mode
                if (selectedProductId && product.id == selectedProductId) {
                    option.selected = true;
                }

                productSelect.appendChild(option);
            });
        })
        .catch(err => console.error('Error fetching products:', err));
}

            }

            // On page load, populate products of the stored category
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = document.getElementById('category_id');
                loadProducts(categorySelect.value, {{ $productDetails->id }});
            });

            // On category change
            document.getElementById('category_id').addEventListener('change', function() {
                loadProducts(this.value);
            });
        </script>


</body>

</html>