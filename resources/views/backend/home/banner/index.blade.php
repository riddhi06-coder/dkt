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
                                    <a href="{{ route('manage-home-banner-details.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Banner Details List</li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-home-banner-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Banner Details</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner Heading</th>
                                <th>Banner Image</th>
                                <th>Banner Video</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              @php $count = 1; @endphp
                                @foreach($banners as $banner)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $banner->banner_heading }}</td>
                                        <td>
                                            @if($banner->thumbnail)
                                                <img src="{{ asset('uploads/home/' . $banner->thumbnail) }}" 
                                                    alt="Banner Image" style="height: 100px;">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($banner->banner_video)
                                                <video src="{{ asset('uploads/home/' . $banner->banner_video) }}" 
                                                    style="max-height: 130px;" controls autoplay muted playsinline>
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manage-home-banner-details.edit', $banner->id) }}" class="btn btn-sm btn-primary">Edit</a><br><br>
                                            <form action="{{ route('manage-home-banner-details.destroy', $banner->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
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

</body>

</html>