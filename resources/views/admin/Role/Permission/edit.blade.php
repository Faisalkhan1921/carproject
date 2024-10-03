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
                            <h5 class="m-0 font-weight-bold text-primary">Edit Permission
                            <a href="{{route('admin.perm.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.perm.update',$users->id)}}" method="post" enctype="multipart/form-data">
                            @csrf


                        <div class="form-group">
                            <label for="">Permission Name</label>
                            <input type="text" name="name" id="" class="form-control" value="{{$users->name}}">
                        </div>

                        <div class="form-group">
                            <label for="">Group Name</label>
                            <select name="group_name" id="" class="form-control">
                                <option value="" selected disabled>Select Group</option>
                                <option value="AllotToCustomers"
                                {{$users->group_name == 'AllotToCustomers' ? 'selected' : ''}}
                                >AllotToCustomers</option>
                                <option value="CustomerModule"
                                 {{$users->group_name == 'CustomerModule' ? 'selected' : ''}}
                                >CustomerModule</option>
                                <option value="CustomerRoutines"
                                 {{$users->group_name == 'CustomerRoutines' ? 'selected' : ''}}
                                >CustomerRoutines</option>
                                <option value="WorkoutLibrary"
                                 {{$users->group_name == 'WorkoutLibrary' ? 'selected' : ''}}
                                >WorkoutLibrary</option>
                                <option value="Exercises"
                                 {{$users->group_name == 'Exercises' ? 'selected' : ''}}
                                >Exercises</option>
                                <option value="Workouts"
                                 {{$users->group_name == 'Workouts' ? 'selected' : ''}}
                                >Workouts</option>
                                <option value="Routines"
                                 {{$users->group_name == 'Routines' ? 'selected' : ''}}
                                >Routines</option>
                                <option value="Messages"
                                 {{$users->group_name == 'Messages' ? 'selected' : ''}}
                                >Messages</option>
                                <option value="Coupouns"
                                 {{$users->group_name == 'Coupouns' ? 'selected' : ''}}
                                >Coupouns</option>
                                <option value="Memberships"
                                 {{$users->group_name == 'Memberships' ? 'selected' : ''}}
                                >Memberships</option>
                                <option value="CMS"
                                 {{$users->group_name == 'CMS' ? 'selected' : ''}}
                                >CMS</option>
                                <option value="CompetitionEntries"
                                 {{$users->group_name == 'CompetitionEntries' ? 'selected' : ''}}
                                >CompetitionEntries</option>
                                <option value="Services"
                                 {{$users->group_name == 'Services' ? 'selected' : ''}}
                                >Services</option>
                                <option value="Sliders"
                                 {{$users->group_name == 'Sliders' ? 'selected' : ''}}
                                >Sliders</option>
                                <option value="Accounts"
                                 {{$users->group_name == 'Accounts' ? 'selected' : ''}}
                                >Accounts</option>
                                <option value="Roles"
                                 {{$users->group_name == 'Roles' ? 'selected' : ''}}
                                >Roles</option>
                                <option value="AllPermission"
                                 {{$users->group_name == 'AllPermission' ? 'selected' : ''}}
                                >AllPermission</option>
                                <option value="Users"
                                 {{$users->group_name == 'Users' ? 'selected' : ''}}
                                >Users</option>
                            </select>
                        </div>

                        







                 
                           <input type="submit" value="Update Permission" class="form-control btn btn-primary">

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
