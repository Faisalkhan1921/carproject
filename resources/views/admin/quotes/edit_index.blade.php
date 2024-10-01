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
                            <h5 class="m-0 font-weight-bold text-primary">Edit Motivational Quotes
                            <a href="{{route('admin.quotes.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.quotes.update',$users->id)}}" method="post" enctype="multipart/form-data">
                            @csrf


                        <div class="form-group">
                            <label for="">Motivation Quote</label>
                            <input type="text" name="quote" id="" class="form-control" value="{{$users->quote}}">
                        </div>

                    
                        <div class="form-group">
    <label for="datetime">Select Date</label>
    <input type="date" name="date" id="datetime" class="form-control" value="{{$users->date}}">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var inputDate = document.getElementById('datetime');
        var today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

        // Disable dates before today
        inputDate.setAttribute('min', today);

        // Example dates from PHP variable (replace with actual PHP code to fetch from database)
        var disabledDates = <?php echo json_encode(array_column($data->toArray(), 'date')); ?>;

        // Convert PHP dates to array of strings
        disabledDates = disabledDates.map(function(dateString) {
            return new Date(dateString).toISOString().split('T')[0];
        });

        // Function to disable specific dates
  
    });
</script>

                      


                           <input type="submit" value="Update Motivational Quote" class="form-control btn btn-primary">

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
