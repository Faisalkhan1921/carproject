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
                            <h5 class="m-0 font-weight-bold text-primary">Add Membership Records
                            <a href="{{route('admin.membership.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.membership.store')}}" method="post" enctype="multipart/form-data">
                            @csrf


                       

                           <div class="form-group">
                            <label for="">User Email</label>
                            <select name="user_id" id="user_id" class="form-control select2"  required>
                            <option value="" disabled>Select User</option>
                            @foreach($message as $item)
                            <option value="{{$item->id}}">{{$item->email}}</option>
                            @endforeach
                        </select>

                           </div>

                           
                           <div class="form-group">
                            <label for="">Package Purchased</label>
                            <select name="package_id" id="user_id1" class="form-control select3"  required>
                            <option value="" disabled>Package Purchased</option>
                            @foreach($package as $item1)
                            <option value="{{$item1->id}}">{{$item1->title}}</option>
                            @endforeach
                        </select>

                           </div>


                           <div class="form-group">
                            <label for="">Discount Given</label>
                            <input type="number" name="discount_give" min="0" max="100" id="" class="form-control" placeholder="Discount Given">
                           </div>



                           <div class="form-group">
                            <label for="">Customer Info</label>
                            <input type="file" name="customer_info" accept=".pdf,.docx,.doc" id="" class="form-control">
                           </div>

                           <input type="submit" value="Add Membership" class="form-control btn btn-primary">

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
