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
                            <h5 class="m-0 font-weight-bold text-primary">Edit Role
                            <a href="{{route('admin.roles.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.roles.update',$users->id)}}" method="post" enctype="multipart/form-data">
                            @csrf


                        <div class="form-group">
                            <label for="">Role Name</label>
                            <input type="text" name="name" id="" class="form-control" value="{{$users->name}}">
                        </div>

                        <h3>Permissions</h3>

                        <div class="row">

<div class="col-md-4">
    <div class="form-group">
        <div class="controls">
            <fieldset>
                <input type="checkbox" name="customermodule" id="checkbox1" value="1" 
                {{$perm -> customermodule==1 ? 'checked' : ''}}
                >
                <label for="checkbox1">Customer Module</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="customerroutine" id="checkbox2" value="1" 
                {{$perm -> customerroutine==1 ? 'checked' : ''}}
                >
                <label for="checkbox2">Customer Routine</label>
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-4">
<div class="form-group">
        <div class="controls">
            <fieldset>
                <input type="checkbox" name="exercise" id="checkbox3" value="1"
                {{$perm -> exercise==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox3">Exercise</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="workouts" id="checkbox4" value="1"
                {{$perm -> workout==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox4">Workouts</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="library" id="checkbox5" value="1"
                {{$perm -> routines==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox5">Library</label>
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-4">
<div class="form-group">
        <div class="controls">
            <fieldset>
                <input type="checkbox" name="messages" id="checkbox6" value="1"
                {{$perm -> messages==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox6">Messages</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="coupouns" id="checkbox7" value="1"
                {{$perm -> coupouns==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox7">Coupouns</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="membership" id="checkbox8" value="1"
                {{$perm -> membership==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox8">Membership</label>
            </fieldset>
        </div>
    </div>
</div>


<div class="col-md-4">
<div class="form-group">
        <div class="controls">
            <fieldset>
                <input type="checkbox" name="competition" id="checkbox9" value="1"
                {{$perm -> competition==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox9">Competition Entries</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="services" id="checkbox10" value="1"
                {{$perm -> services==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox10">Services</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="slider" id="checkbox11" value="1"
                {{$perm -> slider==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox11">Sliders</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="quotes" id="checkbox14" value="1"
                {{$perm -> quotes==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox14">Quotes</label>
            </fieldset>
        </div>
    </div>
</div>


<div class="col-md-4">
<div class="form-group">
        <div class="controls">
            <fieldset>
                <input type="checkbox" name="admins" id="checkbox12" value="1" 
                {{$perm -> user==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox12">All Admins</label>
            </fieldset>

            <fieldset>
                <input type="checkbox" name="roles" id="checkbox13" value="1" 
                {{$perm -> adminroles==1 ? 'checked' : ''}}
                
                >
                <label for="checkbox13">Roles & Permission</label>
            </fieldset>

    
        </div>
    </div>
</div>

</div>
                     

                 
                           <input type="submit" value="Update Role" class="form-control btn btn-primary">

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
