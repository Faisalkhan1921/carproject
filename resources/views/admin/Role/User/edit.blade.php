@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   
</h1> -->


      <div class="row mt-5">
        <div class="col-md-10 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Edit Admin
                            <a href="{{route('admin.user.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.user.update',$data1->id)}}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="" class="form-control" value="{{$data1->name}}" >
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="" class="form-control" value="{{$data1->email}}">
                            </div>


                        <div class="form-group">
                            <label for="">Role Name</label>
                           <select name="role_id" id="" class="form-control" required>
                            <option value="" selected disabled>Select Role</option>
                            @foreach($data as $role)
                            <option value="{{$role->id}}"
                            {{$data1->role_id == $role->id ? 'selected' : ''}}
                            >{{$role->name}}</option>
                            @endforeach
                           </select>
                        </div>


                        <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="image_path" id="" class="form-control" >

                                <img src="{{asset('storage/'.$data1->avatar)}}" alt="" width="100px" height="100px">
                            </div>


                           

                           <input type="submit" value="Update Admin" class="form-control btn btn-primary">

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
