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
                            <h5 class="m-0 font-weight-bold text-primary">Add Package
                            <a href="{{route('admin.package.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.package.store')}}" method="post" enctype="multipart/form-data">
                            @csrf


                        <div class="form-group">
                            <label for="">Package Title</label>
                            <input type="text" name="title" id="" class="form-control" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="price" id="" class="form-control" placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="" disabled selected>Select Status</option>
                                <option value="0">Active</option>
                                <option value="1">DeActive</option>
                            </select>
                            
                        </div>

                        
                        <div class="form-group">
    <label>Type</label><br>
    <input type="radio" id="train" name="type" value="train" onchange="toggleFields()">
    <label for="train">Train</label><br>
    <input type="radio" id="consultant" name="type" value="consultant" onchange="toggleFields()">
    <label for="consultant">Consultant</label><br>
</div>

<div class="form-group" id="daysField" style="display: none;">
    <label for="">Days</label>
    <input type="text" name="days" id="daysInput" class="form-control" placeholder="Enter Days">
</div>

<div class="form-group" id="sessionField" style="display: none;">
    <label for="">Session</label>
    <input type="text" name="session" id="sessionInput" class="form-control" placeholder="Enter Session">
</div>

<script>
    function toggleFields() {
        if (document.getElementById('train').checked) {
            document.getElementById('sessionField').style.display = 'block';
            document.getElementById('daysField').style.display = 'none';
        } else if (document.getElementById('consultant').checked) {
            document.getElementById('daysField').style.display = 'block';
            document.getElementById('sessionField').style.display = 'none';
        }
    }
</script>



                           
                      


                           <input type="submit" value="Add Package" class="form-control btn btn-primary">

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
