@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

    <div class="row mt-5">
        <div class="col-md-12  m-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Edit Cardio Library
                        <a href="{{ route('admin.module.library.routines.index') }}" class="btn btn-warning btn-sm float-right">Return to List</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form id="routineForm" action="{{ route('admin.cardio_library.update1', $data->id) }}" method="POST">
                        @csrf
                      
                        <div class="form-group">
                            <label for="title">Name Your Cardio</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="eg Day 1" value="{{ $data->title }}">
                        </div>
                        <div class="form-group">
                            <h3>Cardio Workouts

                            <!-- <button type="button" class="btn  float-right mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-plus"></i> 
                            </button> -->
                            </h3>
                            
                        </div>
                        <div class="container mt-3 " id="workoutcontainer">
    @foreach($data1 as $workout)
    
    <div class="workout-item" data-id="{{ $workout->id }}">
    
        <div class="workout-item-actions ">
        <p style="margin: none; padding:none;display:inline-block;">  {{ $workout->exercise->title }}</p>
        <input type="hidden" name="workouts[]" value="{{ $workout->exercise_id }}">
            <a href="#" class="edit-workout" data-id="{{ $workout->id }}" data-exercise="{{ $workout->exercise_id }}"><i class="fas fa-edit"></i></a>
            <a href="#" class="delete-workout" data-id="{{ $workout->id }}"><i class="fas fa-trash-alt"></i></a>
        </div>
    </div>
    @endforeach
</div>


                        <input type="submit" value="Update Cardio Library" class="form-control btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<!-- Modal HTML -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="exampleModalLabel">Edit Cardo</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.cardio_library.update',$data2->id)}}" id="editWorkoutForm" method="post">
                    @csrf
                    <input type="hidden" id="editWorkoutId">
                 
                    <div class="form-group">
                        <label for="edit_exercise_id">Select Exercise</label>
                        <select name="exercise_id" id="exercise_ids" class="form-control">
                            <option value="" disabled selected>Select Exercise</option>
                            @php 
                                    $exercise = App\Models\Exercise::all();

                                    @endphp
                            @foreach($exercise as $item1)
                            @php 
                                    
                                    $exercise1 = App\Models\Exercise::where('id',$data2->exercise_id)->first();
                                    @endphp
                            <option value="{{ $item1->id }}"
                            
                                {{$exercise1->id == $item1->id ? 'selected' : ''}}
                            >{{ $item1->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <button type="button" class="btn btn-primary float-right" id="updateWorkoutBtn">Update Workout</button> -->
                     <input type="submit" value="Update Cardio Workout" class="btn btn-primary float-right">
                    <button type="button" class="btn btn-secondary float-right mr-2" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for AJAX and Event Handling -->

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
    // Edit Workout: Populate form and show modal
    $(document).on('click', '.edit-workout', function(e) {
        e.preventDefault();
        var workoutId = $(this).data('id');
        // var workoutTitle = $(this).data('title');
        var exerciseId = $(this).data('exercise');

        // console.error(workoutTitle);
        console.error(exerciseId);
        // Set values in the edit form
        $('#editWorkoutId').val(workoutId);
        // $('#edit_routine_workout_title').val(workoutTitle);
        $('#edit_exercise_id').val(exerciseId);

        // Show edit modal
        $('#editModal').modal('show');
    });

    // Update Workout using AJAX
    // $('#updateWorkoutBtn').on('click', function(e) {
    //     e.preventDefault();
    //     var workoutId = $('#editWorkoutId').val();
    // var workoutTitle = $('#edit_routine_workout_title').val();
    // var exerciseId = $('#edit_exercise_ids').val();

    // // Validate exerciseId before sending AJAX request
    // if (!exerciseId) {
    //     alert('Please select an exercise');
    //     return;
    // }

    //     $.ajax({
    //         url: '/admin/module/library/routine-workouts/update/' + workoutId,
    //         type: 'post', // Assuming you use PUT method for update
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             routine_workout_title: workoutTitle,
    //             exercise_id: exerciseId
    //         },
    //         success: function(response) {
    //             // Update workout item in UI
    //             var updatedWorkoutItem = '<div class="workout-item" data-id="' + workoutId + '">' +
    //                                           '<p>' + workoutTitle + ' - ' + $('#edit_exercise_id option:selected').text() + '</p>' +
    //                                           '<input type="hidden" name="workouts[]" value="' + workoutTitle + '-' + exerciseId + '">' +
    //                                           '<div class="workout-item-actions">' +
    //                                               '<a href="#" class="edit-workout" data-id="' + workoutId + '" data-title="' + workoutTitle + '" data-exercise="' + exerciseId + '"><i class="fas fa-edit"></i></a>' +
    //                                               '<a href="#" class="delete-workout" data-id="' + workoutId + '"><i class="fas fa-trash-alt"></i></a>' +
    //                                           '</div>' +
    //                                       '</div>';
    //             // Replace old workout item with updated one
    //             $('#workoutcontainer').find('.workout-item[data-id="' + workoutId + '"]').replaceWith(updatedWorkoutItem);

    //             // Close modal after update
    //             $('#editModal').modal('hide');
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(error);
    //             // Handle errors if needed
    //         }
    //     });
    // });
</script>


<!-- <script>
    $(document).ready(function() {
        $('#addWorkoutBtn').on('click', function() {
            // Gather data from modal form
            var routineWorkoutTitle = $('#routine_workout_title').val();
            var exerciseId = $('#exercise_id').val();

            // Fetch exercise name based on exerciseId
            var exerciseName = $('#exercise_id option:selected').text();

            // Append new workout item to container
            var workoutItem = '<div class="workout-item">' +
                                  '<p>' + routineWorkoutTitle + ' - ' + exerciseName + '</p>' +
                                  '<input type="hidden" name="workouts[]" value="' + routineWorkoutTitle + '-' + exerciseId + '">' +
                                  '<div class="workout-item-actions">' +
                                      '<a href="#" class="edit-workout"  data-title="' + $('#routine_workout_title').val() + '" data-exercise="' + $('#exercise_id').val() + '"><i class="fas fa-edit"></i></a>' +
                                      '<a href="#" class="delete-workout" ><i class="fas fa-trash-alt"></i></a>' +
                                  '</div>' +
                              '</div>';
            $('#workoutcontainer').append(workoutItem);

            // Clear modal form fields
            $('#exampleModal').modal('hide');
            $('#workoutForm')[0].reset();
        });
    });
</script> -->

<script>
    // Edit workout
    $(document).on('click', '.edit-workout', function(e) {
        e.preventDefault();
        var workoutId = $(this).data('id');
        // var workoutTitle = $(this).data('title');
        var exerciseId = $(this).data('exercise');

        // Populate modal with current values
        $('#exampleModal').modal('show');
        // $('#routine_workout_title').val(workoutTitle);
        $('#exercise_id').val(exerciseId).trigger('change'); // Trigger change event if using select2 or similar

        // Handle submit for update
        $('#addWorkoutBtn').off('click').on('click', function() {
            // Update the workout item in the container
        

            // Replace existing workout item with updated one
            $('#workoutcontainer').find('.workout-item[data-id="' + workoutId + '"]').replaceWith(workoutItem);

            // Clear modal form fields
            $('#exampleModal').modal('hide');
            $('#workoutForm')[0].reset();
        });
    });

    // Delete workout
    $(document).on('click', '.delete-workout', function(e) {
        e.preventDefault();
        var workoutId = $(this).data('id');

        // AJAX delete request
        $.ajax({
            url: '/admin/module/library/routine-workouts/delete/' + workoutId, // Adjust the URL as per your route setup
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Remove workout item from container on success
                $('#workoutcontainer').find('.workout-item[data-id="' + workoutId + '"]').remove();
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle errors if needed
            }
        });
    });
</script>


@endsection
