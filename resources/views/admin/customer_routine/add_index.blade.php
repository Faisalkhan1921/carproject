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
                            <h5 class="m-0 font-weight-bold text-primary">Sara's Plan
                            <a href="{{route('admin.customer.routines.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                        <form role="form" class="form-edit-add"
                        action=""
                        method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label for="">Name Your Routine</label>
                                <input type="text" name="routine_title" class="form-control" id="" placeholder="e.g Day 1">
                            </div>


                          

                           <div class="form-group">
                         
                                @php 
                                $routine = App\Models\Routine::all();
                            @endphp
                           
                            <label for="">Please Select a Routine From The Library</label>
                            <select class="form-control select2" name="routine" id="select_routine">
                                        <option value="" selected disabled>Select Routine</option>
                                        @foreach ($routine as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->title }}
                                            </option>
                                        @endforeach
                                    </select>
                           </div>


                           <!-- <button type="submit" value="Import Routine Template" class=" btn btn-info float-right"> -->
                            <!-- <button class="btn btn-info float-right">Import Routine Template</button> -->
                            <div class="text-right">
                                    <a class="btn btn-outline-info" title="Import Routine" onclick="ImportRoutineLayout()"
                                        style="background-color: #F0F0F0;color:#76838F;">Import Routine
                                        Template</a>
                                </div>

                        <br>
                           <h5>Routine Workouts</h5>
                           <div class="container" id="RoutineWorkouts" style="color:white;">
                           </div>


                           <input type="submit" value="Save" class="btn btn-primary ">
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

<div class="modal fade" id="Editworkout" tabindex="-1" aria-labelledby="EditworkoutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <form id="EditWorkoutForm">

<div class="row" style="margin: 0;">

    <input type="hidden" name="workout_title" id="workout_title">
    <input type="hidden" name="workout_id" id="workout_id">
    <input type="hidden" name="exercise_id" id="exercise_id">
    <input type="hidden" name="routine_id" id="routine_id">

    <div class="col-md-12 col-sm-12">
        <label class="control-label" for="name">Enter Weight </label>
        <input type="text" name="weight" id="weight" placeholder="e.g. 10, 12, 15 KG"
            class="form-control">
    </div>

    <div class="col-md-12 col-sm-12">
        <label class="control-label" for="name">Enter Number Of Repititions </label>
        <input type="text" name="reps" id="reps" placeholder="e.g. 10 - 12 - 15"
            class="form-control">
    </div>

    <div class="col-md-12 col-sm-12">
        <label class="control-label" for="name">Enter Workout Duration</label>
        <input type="text" name="duration" id="duration" placeholder="e.g. 50 seconds"
            class="form-control">
    </div>

</div>

<div class="row modal-footer" style="padding : 15px 15px 0 0">
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" aria-label="Close" >Cancel</button>
        <button type="submit" id="EditWorkoutFormSubmit" class="btn btn-primary">Save
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
      function ImportRoutineLayout() {

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            let routine = $('#select_routine').val();

            $('#voyager-loader').css('display', 'block');
            $.ajax({
                type: "POST",
                url: "fetch-routine-template",
                data: {
                    'routine': routine,
                },

                success: function(data) {

                    $('#voyager-loader').css('display', 'none');
                    if (data.success == 'false') {
                        $('#AlertMessage').removeClass('alert-success');
                        $('#AlertMessage').addClass('alert-danger');
                        $('#AlertMessage').html(data.message);
                        $('#AlertMessage').fadeIn();

                        $('#EditAddWorkout').modal('hide');
                        setTimeout(function() {
                            $('#AlertMessage').fadeOut();
                        }, 3000);
                    } else {
                        $('#RoutineWorkouts').html(data);
                        $('#AlertMessage').removeClass('alert-danger');
                        $('#AlertMessage').addClass('alert-success');
                        $('#AlertMessage').html('Routine Successfully Imported');
                        $('#AlertMessage').fadeIn();

                        $('#EditAddWorkout').modal('hide');
                        setTimeout(function() {
                            $('#AlertMessage').fadeOut();
                        }, 3000);
                    }
                },

                error: function(xhr, textStatus, errorThrown) {
                    $('#voyager-loader').css('display', 'none');
                    $('#AlertMessage').removeClass('alert-success');
                    $('#AlertMessage').addClass('alert-danger');
                    $('#AlertMessage').html('An Unknown Error Has Occured. Please Try Again LAter');
                    $('#AlertMessage').fadeIn();

                    setTimeout(function() {
                        $('#AlertMessage').fadeOut();
                    }, 3000);
                },
            });
        }

        function EditWorkout(workout_id, routine_id, exercise_id, title) {

$('#WorkoutTitle').html(
    '<i class="voyager-smile" style="margin-right: 5px;font-size: 20px;"></i>Add Workout Fields - ' + title)

$('#workout_title').val(title);
$('#workout_id').val(workout_id);
$('#routine_id').val(routine_id);
$('#exercise_id').val(exercise_id);
$('#Editworkout').modal('show');
}

$("#EditWorkoutForm").submit(function(event) {
event.preventDefault();
var formData = new FormData(this);

var csrfToken = $('meta[name="csrf-token"]').attr('content');
jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});

var form = $("#EditWorkoutForm");
form.find(":input").prop("disabled", true);
form.find("button").prop("disabled", true);
$("#EditWorkoutFormSubmit").html("Processing Your Data...");

jQuery.ajax({
    type: "POST",
    url: "edit-workout-details",
    data: formData,
    contentType: false,
    processData: false,

    success: function(data) {

        form.find(":input").prop("disabled", false);
        form.find("button").prop("disabled", false);
        $("#EditWorkoutFormSubmit").html("Save Workout");

        if (data.success == 'false') {
            $('#AlertMessage').removeClass('alert-success');
            $('#AlertMessage').addClass('alert-danger');
            $('#AlertMessage').html(data.message);
            $('#AlertMessage').fadeIn();
        } else {
            $('#Editworkout').modal('hide');
            $("#EditWorkoutForm input").val("");

            $('#' + data.data + ' span.editing-status').replaceWith(
                '<span class="voyager-check editing-status text-success" title="Workout Edited"></span>'
            );

            $('#AlertMessage').removeClass('alert-danger');
            $('#AlertMessage').addClass('alert-success');
            $('#AlertMessage').html(data.message);
            $('#AlertMessage').fadeIn();
        }

        setTimeout(function() {
            $('#AlertMessage').fadeOut();
        }, 3000);
    },

    error: function(xhr, textStatus, errorThrown) {

        $("#EditWorkoutFormSubmit").html("Save Workout");
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

$(".form-edit-add").submit(function(event) {
event.preventDefault();
$('#voyager-loader').css('display', 'block');
var formData = new FormData(this);

var csrfToken = $('meta[name="csrf-token"]').attr('content');
jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});

var form = $(".form-edit-add");

jQuery.ajax({
    type: "POST",
    url: "submit-final-form",
    data: formData,
    contentType: false,
    processData: false,

    success: function(data) {

        if (data.success == 'false') {
            $('#AlertMessage').removeClass('alert-success');
            $('#AlertMessage').addClass('alert-danger');
            $('#AlertMessage').html(data.message);
            $('#AlertMessage').fadeIn();
            $('#voyager-loader').css('display', 'none');
        } else {
            window.location.href = '/admin/customer-routines';
            $(form + " input").val("");
            $('workoutsDiv').html('');
        }

        setTimeout(function() {
            $('#AlertMessage').fadeOut();
        }, 3000);
    },

    error: function(xhr, textStatus, errorThrown) {

        $('#voyager-loader').css('display', 'none');

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
