@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   
</h1> -->


      <div class="row mt-5" >
        <div class="col-md-7 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">View Customer Module
                            <a href="{{route('admin.module.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           
                           <div class="form-group">
                            <label for="">Selected Module</label>
                            @php 
                            $message = App\Models\UserAllotedModule::where('id',$data->library_module_id)->first();
                            $user = App\Models\Message::where('id',$data->user_id)->first();
                            @endphp
                               <input type="text" name="" value="{{$message->title}}" id="" class="form-control" disabled>
                            
                           </div>

                           <div class="form-group">
                            <label for="">User Allotted To</label>
                            <input type="text" name="" value="{{$user->email }}" id="" class="form-control" disabled>

                           </div>



                        </div>
                    </div>
        </div>
      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
