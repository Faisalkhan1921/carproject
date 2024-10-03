@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

    <!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
    <i class="fas fa-id-badge text-dark"></i>    
    Add Faculty Records

    
    </h1> -->


      <div class="row mt-5">
        <div class="col-md-12 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-id-badge text-dark"></i>    
                            Editing Faculty Records
                            <a href="{{route('admin.faculty.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                        
                        <!-- =============================== start of view data ================================ -->

                        <form  action="{{ route('admin.faculty.update',$users->id) }}" method="post" enctype="multipart/form-data">

@csrf
<div class="form-group">
    <label for="">Name </label>
    <input type="text" name="name" id="" class="form-control" value="{{$users->name}}">
    @error ('name')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="">Email </label>
    <input type="email" name="email" id="" class="form-control" value="{{$users->email}}">
    @error ('email')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="">Position </label>
    <input type="text" name="position" id="" class="form-control" value="{{$users->position}}">
    @error ('position')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="">Nationality</label>
    <input type="text" name="nationality"  class="form-control" value="{{$users->nationality}}">
    @error ('nationality')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>


<div class="form-group">
    <label for="">Gender </label>
    <select name="gender" id="" class="form-control">
    <option value="" disabled>Select Gender</option>
    <option value="male" <?php echo ($users->gender == 'male') ? 'selected' : ''; ?>>Male</option>
    <option value="female" <?php echo ($users->gender == 'female') ? 'selected' : ''; ?>>Female</option>
</select>

    @error ('gender')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
<label for="age">Date Of Birth</label>
<input type="date" name="age" id="age" class="form-control" max="{{ date('Y-m-d') }}" value="{{$users->age}}">
@error('age')
    <span class="text-danger">{{ $message }}</span>
@enderror
</div>


<div class="form-group">
    <label for="">Phone Number</label>
    <input type="number" name="phone_number" id="" class="form-control" placeholder="971561153480" value="{{$users->phone_number}}" disabled>
    @error ('phone')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>


<div class="form-group">
    <label for="">Address</label>
    <textarea name="address" id="" cols="30" rows="2" class="form-control">{{$users->address}}</textarea>
    @error ('phone')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="">Weight (kg)</label>
    <input type="number" name="weight" id="" class="form-control" placeholder="" value="{{$users->weight}}">
    @error ('weight')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>



<div class="form-group">
    <label for="">Height (cm)</label>
    <input type="number" name="height" id="" class="form-control" placeholder="" value="{{$users->height}}">
    @error ('height')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="">T-Shirt Size</label>
    <input type="text" name="t_shirt" id="" class="form-control" placeholder="" value="{{$users->t_shirt}}">
    @error ('t_shirt')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="">Password </label>
    <input type="text" name="password" id="" class="form-control"  value="{{$users->real_password}}">
    @error ('password')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>





<div class="form-group">
    <input type="submit" value="Update Faculty" class="form-control btn btn-success">
</div>
</form>
              

                        <!-- ==================================== end of view data ====================================== -->


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
