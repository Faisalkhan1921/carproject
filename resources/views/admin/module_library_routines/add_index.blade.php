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
                        <div class="card-head   er py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Add User Routine Library
                            <a href="{{route('admin.module.library.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                        <form id="routineForm" action="{{ route('admin.module.library.routines.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Name Your Routine</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="eg Day 1">
    </div>
 <div class="row">
    <div class="col-md-6" style="border-right:1px solid gray; margin-bottom:12px;">
    <div class="form-group">
        <h3> Workouts

        <button type="button" class="btn  float-right mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            <i class="fa-solid fa-plus"></i> 
        </button>
        </h3>
       
    </div>
   

    </div>


    <div class="col-md-6" >
    <div class="form-group">
        <h3>Exercises

        <button type="button" class="btn  float-right mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i> 
        </button>
        </h3>
       
    </div>
    <!-- <div class="container" id="workoutcontainer">
       
    </div> -->
    </div>


   
 </div>

 <div class="col-md-12">
    <div class="main-div" style="display: flex; flex-direction: column; width: 100%; justify-content: center;">

        <div class="container" id="workoutcontainer1">
            <!-- Workouts will be dynamically added here -->
        </div>

        <div class="container" id="workoutcontainer" style="width: 100%; margin-left: auto;">
          
        </div>

    </div>
</div>

    <input type="submit" value="Add User Routine Library" class="form-control btn btn-primary">
</form>


                        </div>
                    </div>
        </div>
      </div>

</div>


<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="exampleModalLabel">New Workout</h5>
            </div>
            <div class="modal-body">
                <form id="workoutForm">
                    <div class="form-group">
                        <label for="routine_workout_title">Workout Title</label>
                        <input type="text" name="routine_workout_title" id="routine_workout_title" class="form-control" placeholder="Workout Title">
                    </div>
                    <div class="form-group">
                        <label for="exercise_id">Select Exercise</label>
                        <select name="exercise_id" id="exercise_id" class="form-control">
                            <option value="" disabled selected>Select Exercise</option>
                            @foreach($exercise as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary float-right" id="addWorkoutBtn">Add Workout</button>
                    <button type="button" class="btn btn-secondary float-right mr-2" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="exampleModal1Label"> Workout Library</h5>
            </div>
            <div class="modal-body">
                <form id="workoutForm1">
                   
                    <div class="form-group">
                        <label for="workout_id">Select Workout</label>
                        <select name="workout_id" id="workout_id" class="form-control">
                            <option value="" disabled selected>Select Workout</option>
                            @php 
                            $workoutlibrary = App\Models\UserAllotedModule::all();
                            @endphp
                            @foreach($workoutlibrary as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary float-right" id="addonlyWorkoutBtn">Add Workout Library</button>
                    <button type="button" class="btn btn-secondary float-right mr-2" data-bs-dismiss="modal">Cancel</button>
                </form>
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
<script>
    $(document).ready(function() {
        $('#addWorkoutBtn').on('click', function() {
            // Gather data from modal form
            var routineWorkoutTitle = $('#routine_workout_title').val();
            var exerciseId1 = $('#exercise_id').val();

            // Fetch exercise name based on exerciseId
            var exerciseName = $('#exercise_id option:selected').text();

            // Append new workout item to container
            var workoutItem = '<div class="workout-item">' +
                                  '<p> <li> ' + routineWorkoutTitle +'</li></p>' +
                                  '<p > ' + '<span style="margin-left:22px;"> - ' + exerciseName + '</span></p>' +

                                  
                                  '<input type="hidden" name="workouts[]" value="' + routineWorkoutTitle + '-' + exerciseId1 + '">' +
                              '</div>';
            $('#workoutcontainer').append(workoutItem);

            // Clear modal form fields
            $('#exampleModal').modal('hide');
            $('#workoutForm')[0].reset();
        });
    });
</script>

<script>
   

   $(document).ready(function() {
    $('#addonlyWorkoutBtn').on('click', function() {
        // Gather data from modal form
        var routineWorkoutTitle = $('#routine_workout_title').val();
        var exerciseId = $('#workout_id').val();
        var exerciseName1 = $('#workout_id option:selected').text();
        var moduleId = 123; // Replace with actual module_id value

        // Fetch exercise names based on exerciseId using AJAX
        $.ajax({
            url: '{{route("admin.fetch.exercisesname")}}',
            method: 'GET',
            data: {
                exerciseId: exerciseId,
                module_id: moduleId // Pass module_id here
            },
            success: function(response) {
                // Append new workout item to container
                var workoutItem = '<div class="workout-item">' +
                                      '<p style="margin-top:12px;"> <li>' + routineWorkoutTitle + '  ' + exerciseName1 + '</li></p>';

                // Append each exercise name
                        
                $.each(response.exercises, function(index, exercise) {
                    workoutItem += '<span> <strong style="margin-left:22px;">-</strong>' + exercise.name + '<br> ' + ' </span>';
                });
             
                workoutItem += '<input type="hidden" name="workouts1[]" value="' + routineWorkoutTitle + '-' + exerciseId + '-' + moduleId + '-' + exerciseName1 + '">' +
                '</div>';

                $('#workoutcontainer').append(workoutItem);

                // Clear modal form fields
                $('#exampleModal1').modal('hide');
                $('#workoutForm1')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching exercises:', error);
                // Handle error if needed
            }
        });
    });
});

</script>




@endsection
