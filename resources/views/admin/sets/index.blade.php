@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   
</h1> -->


      <div class="row mt-5">
        <div class="col-md-5 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Define Sets

                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.sets.store')}}" method="post" enctype="multipart/form-data">
                            @csrf


                        <div class="form-group">
                            <label for="">Define Sets</label>
                            <input type="number" name="sets" id="" class="form-control" value="{{$sets->sets}}" placeholder="Define Sets Eg: 2 3 " min="1">
                        </div>

                    

                            @if($sets->sets == NULL)
                           <input type="submit" value="Define Sets" class="form-control btn btn-primary">
                            @else
                            <input type="submit" value="Update Sets" class="form-control btn btn-success">
                            @endif
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
