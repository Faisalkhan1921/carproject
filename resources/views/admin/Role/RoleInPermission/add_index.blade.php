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
                            <h5 class="m-0 font-weight-bold text-primary">Add Roles
                            <a href="{{route('admin.roles.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.rp.store')}}" method="post" enctype="multipart/form-data">
                            @csrf


                        <div class="form-group">
                            <label for="">Role Name</label>
                            <!-- <input type="text" name="name" id="" class="form-control" placeholder="Enter Title"> -->
                             <select name="role_id" id="" class="form-control">
                                @foreach($data as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                             </select>
                        </div>

                        <div class="form-check">
                           
                            <input type="checkbox" name="" class="form-check-input" id="CheckDefaultMain">
                            <label for="CheckDefaultMain" class="form-check-label">All Permissions</label>
                          
                        </div>

                        <hr>

                        @foreach($permission_groups as $item3)
                        <div class="row">
                            <div class="col-md-3">

                            <div class="form-check">
                           
                           <input type="checkbox" name="" class="form-check-input" id="CheckDefault">
                           <label for="CheckDefault" class="form-check-label">{{$item3->group_name}}</label>
                         
                       </div>

                            </div>

                            <div class="col-md-9">

                            @php 
                            $permissions = App\Models\Admin::getpermissionbyGroupName($item3->group_name);
                            @endphp

                            @foreach($permissions as $perm)
                            <div class="form-check">
                           
                           <input type="checkbox" name="permission[]" class="form-check-input" id="CheckDefault{{$perm->id}}" value="{{$perm->id}}">
                           <label for="CheckDefault{{$perm->id}}" class="form-check-label">{{$perm->name}}</label>
                        </div>
                        
                        @endforeach
                        <hr>                         

                            </div>
                        </div>
                 @endforeach
                           <input type="submit" value="Add Role In Permission" class="form-control btn btn-primary">

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



<script>

    $("#CheckDefaultMain").click(function(){
        if($(this).is(':checked'))
        {
            $('input[type=checkbox').prop('checked',true);
        }
        else 
        {
            $('input[type=checkbox').prop('checked',false);

        }
    });
</script>
@endsection
