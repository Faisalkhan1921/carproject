@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   
</h1> -->


      <div class="row mt-5">
        <div class="col-md-7 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Edit Service
                            <a href="{{route('admin.services.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.services.update',$users->id)}}" method="post" enctype="multipart/form-data">
                            @csrf


                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control" value="{{$users->title}}">
                        </div>

                        <div class="form-group">
                            <label for="">Introduction</label>
                            <input type="text" name="introduction" id="" class="form-control" value="{{$users->introduction}}">
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="description" id="" class="form-control" value="{{$users->description}}">
                        </div>

                        
                        <div class="form-group">
                            <label for="">Image Path</label>
                            <input type="file" name="image_path" id="" class="form-control" accept=".jpg, .png, .jpeg">
                            <h3>Old Image</h3>
                            <img src="{{asset('storage/' . $users->image_path)}}" alt="" width="70px" height="70px">
                          
                        </div>

                          
                      


                           <input type="submit" value="Update Service" class="form-control btn btn-primary">

                           </form>
                        </div>
                    </div>
        </div>
      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select User",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select3').select2({
            placeholder: "Select Package",
            allowClear: true
        });
    });
</script>

@endsection
