@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   
</h1> -->
<div class="alert alert-success" style="position: fixed;z-index: 111111;top: 15px;right: 10px;display:none;"
        id="AlertMessage">
        Workout Successfully Added
    </div>

      <div class="row mt-1">
        <div class="col-md-10 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Edit Customer Routine
                            <a href="{{route('admin.customer.routines.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                        <form role="form" class="form-edit-add"
                          action="{{ route('admin.customer.routines.update',$myid) }}"
                        method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                    <label class="control-label" for="name">Name Your Routine</label>
                                    <input type="text" class="form-control" name="routine_title_edit"
                                        id="routine_title_edit" value="{{ $dataTypeContent->title }}"
                                        placeholder="e.g. Day 1">
                                </div>



                                <div class="form-group">
                                    <label class="control-label" for="name">Please Select a User To Allot The
                                        Module</label>
                                    <select class="form-control select2" name="select_user" id="select_user">
                                        <option value="" disabled>Select User</option>
                                        @foreach ($users as $item)
                                            @if ($dataTypeContent->user->id == $item->id)
                                                <option value="{{ $item->id }}" selected>
                                                    {{ $item->fname . ' ' . $item->lname . '(' . $item->email . ')' }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">
                                                    {{ $item->fname . ' ' . $item->lname . '(' . $item->email . ')' }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                        
                         
                           <h4 style="margin-top: 35px;">Routine Workouts</h4>
                                <div class="container" id="EditPageRoutineWorkouts">
                                    <div class="row" style="display: flex;flex-direction: column;align-items: center;"
                                        id="workoutsDiv2">

                                        <h4 class="text-center bg-primary" style="padding: 10px 15px;width:100%;color:white;">
                                            Workouts For <span
                                                style="font-style: italic;">"{{ $dataTypeContent->title }}"</span>
                                        </h4>

                                        @foreach ($dataTypeContent->routineWorkout as $item)
                                            <div class="col-md-12 bg-success"
                                                style="padding: 10px;border-radius: 4px;margin-bottom:7px;">

                                                <div class="row">

                                                    <div class="col-md-10" style="margin-bottom:0px;color:white;"
                                                        id={{ $item->id }}>
                                                        {{ $item->title }} -
                                                        {{ $item->exercise->title }}
                                                    </div>

                                                    <div class="col-md-2 text-right" style="margin-bottom:0px;">
                                                        <span class="voyager-edit" style="cursor:pointer;"
                                                            title="Edit Workout"
                                                            onclick="EditEditWorkout({{ $item->routine_id }},{{ $item->id }},'{{ $item->title }}',{{ $item->exercise_id }},'{{ $item->weight }}','{{ $item->repititions }}','{{ $item->workout_duration }}')">
                                                    <i class="fas fa-edit text-danger   "></i> 
                                                        
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

                   

                               
                            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                     
                           </form>
                        </div>
                    </div>
        </div>
      </div>

</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                </h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditEditworkout" tabindex="-1" aria-labelledby="EditEditworkoutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
  
      <form id="EditEditWorkoutForm">

                    <div class="row" style="margin: 0;">

                        <input type="hidden" name="edit_routine_id" id="edit_routine_id">
                        <input type="hidden" name="edit_workout_id" id="edit_workout_id">

                        {{-- Select Title --}}
                        <div class="form-group">
                            <label class="control-label" for="name">Name Your Routine</label>
                            <input type="text" class="form-control" name="workout_title_edit"
                                id="workout_title_edit" value="{{ $dataTypeContent->title }}"
                                placeholder="e.g. Day 1">
                        </div>

                        {{-- Select Exercise --}}
                        <div class="form-group">
                            <label class="control-label" for="name">Seelct Exercise</label>
                            <select class="form-control select2" name="select_edit_exercise"
                                id="select_edit_exercise">
                                @foreach ($exercise as $item)
                                    <option value="{{ $item->id }}" class="{{ $item->id }}">
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Weight --}}
                        <div class="form-group">
                            <label class="control-label" for="name">Weight </label>
                            <input type="text" name="Editweight" id="Editweight" placeholder="e.g. 10, 12, 15 KG"
                                class="form-control">
                        </div>

                        {{-- Repititions --}}
                        <div class="form-group">
                            <label class="control-label" for="name">Number Of Repititions </label>
                            <input type="text" name="Editreps" id="Editreps" placeholder="e.g. 10 - 12 - 15"
                                class="form-control">
                        </div>

                        {{-- Workout Duration --}}
                        <div class="form-group">
                            <label class="control-label" for="name">Workout Duration</label>
                            <input type="text" name="Editduration" id="Editduration"
                                placeholder="e.g. 50 seconds" class="form-control">
                        </div>

                    </div>

                    <div class="row modal-footer" style="padding : 15px 15px 0 0">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="EditEditWorkoutFormSubmit" class="btn btn-primary">Save
                                Workout</button>
                        </div>
                    </div>

                </form>

      </div>
    
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


        


<script>
        function EditEditWorkout(routineId, workoutId, title, exercise_id, weight, repititions, duration) {
            $('#workout_title_edit').val(title);
            $('#Editweight').val(weight);
            $('#Editreps').val(repititions);
            $('#Editduration').val(duration);
            $('#edit_routine_id').val(routineId);
            $('#edit_workout_id').val(workoutId);

            // Exercise
            var ExerciseDropdown = $("#select_edit_exercise");
            ExerciseDropdown.find('.' + exercise_id).attr("selected", "selected");

            var Exercisetext = ExerciseDropdown.find('.' + exercise_id).text();
            $('#select2-select_edit_exercise-container').html(Exercisetext);

            $('#EditEditworkout').modal('show');
        }

        $("#EditEditWorkoutForm").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            var form = $("#EditEditWorkoutForm");
            form.find(":input").prop("disabled", true);
            form.find("button").prop("disabled", true);
            $("#EditEditWorkoutFormSubmit").html("Processing Your Data...");

            jQuery.ajax({
                type: "POST",
                url: "edit-edit-workout-details",
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {

                    form.find(":input").prop("disabled", false);
                    form.find("button").prop("disabled", false);
                    $("#EditEditWorkoutFormSubmit").html("Save Workout");

                    if (data.success == 'false') {
                        $('#AlertMessage').removeClass('alert-success');
                        $('#AlertMessage').addClass('alert-danger');
                        $('#AlertMessage').html(data.message);
                        $('#AlertMessage').fadeIn();
                    } else {
                        $('#EditEditworkout').modal('hide');
                        $("#EditEditWorkoutForm input").val("");

                        $('#EditPageRoutineWorkouts').html(data);

                        $('#AlertMessage').removeClass('alert-danger');
                        $('#AlertMessage').addClass('alert-success');
                        $('#AlertMessage').html('Workout Successfully Updated');
                        $('#AlertMessage').fadeIn();
                    }

                    setTimeout(function() {
                        $('#AlertMessage').fadeOut();
                    }, 3000);
                },

                error: function(xhr, textStatus, errorThrown) {

                    $("#EditEditWorkoutFormSubmit").html("Save Workout");
                    form.find(":input").prop("disabled", false);
                    form.find("button").prop("disabled", false);

                    $('#AlertMessage').removeClass('alert-success');
                    $('#AlertMessage').addClass('alert-danger');
                    $('#AlertMessage').html(xhr.responseJSON.message);
                    $('#AlertMessage').fadeIn();

                    $('#EditAddWorkout').modal('hide');
                    setTimeout(function() {
                        $('#AlertMessage').fadeOut();
                    }, 3000);
                },
            });
        });
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
