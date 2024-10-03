@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">




      <div class="row mt-5">
        <div class="col-md-7 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Add Cardio Library
                            <a href="{{route('admin.cardio_library.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.cardio_library.store')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="">Cardio Title</label>
                                <input type="text" name="title" id="" class="form-control" placeholder="Enter Title">
                            </div>


                       

                           <div class="form-group">
                            <label for="">Select Exercise</label>
                            <select name="exercise_id[]" id="user_id" class="form-control select2" multiple="multiple" required>
                            <option value="" disabled>Select Exercise</option>
                            @foreach($exercise as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>

                           </div>



                                

                           <input type="submit" value="Add Cardio Library" class="form-control btn btn-primary">

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
            placeholder: "Select Exercise",
            allowClear: true
        });
    });
</script>

@endsection
