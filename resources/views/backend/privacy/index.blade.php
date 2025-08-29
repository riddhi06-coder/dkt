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
                                    <a href="{{ route('manage-privacy-policy.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Privacy Policy List</li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-privacy-policy.create') }}" class="btn btn-primary px-5 radius-30">+ Add Privacy Policy</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner Heading</th>
                                <th>Banner Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              
                            @foreach($privacyPolicies as $index => $policy)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $policy->banner_heading }}</td>
                                    <td>
                                        @if($policy->banner)
                                            <img src="{{ asset('uploads/home/' . $policy->banner) }}" 
                                                alt="Banner" class="img-thumbnail" style="max-height: 130px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('manage-privacy-policy.edit', $policy->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('manage-privacy-policy.destroy', $policy->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-sm btn-danger">Delete</button>
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