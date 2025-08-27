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
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <nav aria-label="breadcrumb" role="navigation">
                          <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item">
                                  <a href="{{ route('manage-products.index') }}">Home</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">Product List</li>
                          </ol>
                      </nav>

                      <div class="text-end">
                          <a href="{{ route('manage-products.create') }}" class="btn btn-primary px-5 radius-30 mb-2">
                              + Add Product
                          </a><br><br>
                          <div>
                              <input type="text" id="searchInput" class="form-control" placeholder="Search by category or product" style="width: 300px !important;">
                          </div>
                      </div>
                  </div>



                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark1">
                                <tr>
                                    <th style="width: 5%"><strong>#<strong></th>
                                    <th style="width: 35%"><strong>Product Name<strong></th>
                                    <th style="width: 25%"><strong>Image<strong></th>
                                    <th style="width: 35%"><strong>Action<strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <!-- Category Header Row -->
                                    <tr class="table-primary">
                                        <td colspan="4" class="fw-bold text-center">
                                            <h6 class="mb-0"><strong>Category: {{ $category->category_name }}</strong></h6>
                                        </td>
                                    </tr>

                                    @forelse($category->products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>
                                                @if($product->thumbnail_image)
                                                    <img src="{{ asset('uploads/products/' . $product->thumbnail_image) }}" 
                                                        alt="Product Image" 
                                                        class="img-thumbnail rounded"
                                                        width="100">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('manage-products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('manage-products.destroy', $product->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure want to delete this product?')">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No products found in this category.</td>
                                        </tr>
                                    @endforelse
                                @endforeach
                            </tbody>
                        </table>

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
            document.getElementById("searchInput").addEventListener("keyup", function() {
                let filter = this.value.toLowerCase();
                let categoryRows = document.querySelectorAll("tr.table-primary"); // category rows

                categoryRows.forEach(categoryRow => {
                    let categoryName = categoryRow.innerText.toLowerCase();
                    let productRows = [];
                    let nextRow = categoryRow.nextElementSibling;

                    // collect all products under this category
                    while (nextRow && !nextRow.classList.contains("table-primary")) {
                        productRows.push(nextRow);
                        nextRow = nextRow.nextElementSibling;
                    }

                    // filter logic
                    let categoryMatch = categoryName.includes(filter);
                    let productMatch = false;

                    productRows.forEach(row => {
                        let productName = row.querySelector("td:nth-child(2)").innerText.toLowerCase();

                        if (productName.includes(filter)) {
                            row.style.display = "";
                            productMatch = true;
                        } else {
                            row.style.display = "none";
                        }
                    });

                    // show category row if category matches or any of its products match
                    if (categoryMatch || productMatch) {
                        categoryRow.style.display = "";
                        productRows.forEach(row => {
                            if (categoryMatch) row.style.display = ""; // show all products if category matched
                        });
                    } else {
                        categoryRow.style.display = "none";
                    }
                });
            });
        </script>


</body>

</html>