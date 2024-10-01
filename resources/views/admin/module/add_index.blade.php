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
                            <h5 class="m-0 font-weight-bold text-primary">Add Customer Module
                            <a href="{{route('admin.module.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.module.store')}}" method="post">
                            @csrf
                           <div class="form-group">
                            <label for="">Selected Module</label>
                            <select name="library_module_id" id="" class="form-control" required>
                                <option value="" selected disabled>Select Module</option>
                                @foreach($data as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                           </div>

                           <div class="form-group">
                            <label for="">User Allotted To</label>
                            <select name="user_id" id="" class="form-control" required>
                                <option value="" selected disabled>Select User</option>
                                @foreach($message as $item1)
                                <option value="{{$item1->id}}">{{$item1->email}}</option>
                                @endforeach
                            </select>
                           </div>


                           <input type="submit" value="Add Customer Module" class="form-control btn btn-primary">

                           </form>
                        </div>
                    </div>
        </div>
      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
