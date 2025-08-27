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
                                    <a href="{{ route('manage-product-details.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details List</li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-product-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Product Details</a>
                    </div>

                    <div class="d-flex justify-content-end mb-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by Product or Category Name" style="width: 300px;">
                    </div>



                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordered table-striped" id="basic-1">
                            <thead class="table-dark1">
                                <tr>
                                    <th>#</th>
                                    <th><strong>Product Name<strong></th>
                                    <th><strong>Banner Image<strong></th>
                                    <th><strong>Action<strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    @if($category->productsDetails->isNotEmpty())
                                        <tr class="table-primary" style="text-align:center;">
                                            <td colspan="4"><strong>{{ $category->category_name }}</strong></td>
                                        </tr>

                                        @php $count = 1; @endphp
                                        @foreach($category->productsDetails as $product)
                                            <tr>
                                                <td>{{ $count++ }}</td>

                                                <td>{{ $product->product->product_name ?? 'N/A' }}</td>

                                                <td>
                                                    @if($product->thumbnail_image)
                                                        <img src="{{ asset('uploads/products/' . $product->thumbnail_image) }}" 
                                                            alt="Banner Image" class="img-thumbnail" style="height: 80px;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('manage-product-details.edit', $product->id) }}" class="btn btn-sm btn-primary mb-1">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('manage-product-details.destroy', $product->id) }}" 
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
                let categoryRows = document.querySelectorAll("tr.table-primary");

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
                        if(categoryMatch){
                            productRows.forEach(row => row.style.display = ""); // show all products if category matched
                        }
                    } else {
                        categoryRow.style.display = "none";
                    }
                });
            });
        </script>

</body>

</html>