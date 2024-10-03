@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   <!-- Include select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</h1>
<div class="alert alert-success" style="position: fixed;z-index: 111111;top: 15px;right: 10px;display:none;"
        id="AlertMessage">
        Workout Successfully Added
    </div>

      <div class="row mt-1">
        <div class="col-md-10 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Add Customer Routine

                            <a href="{{ route('admin.assignplan.view_index', ['id' => $user, 'increment' => $increment]) }}" class="btn btn-warning float-right">Return to List</a>

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
                           
                            <input type="hidden" name="select_user" value="{{$user}}" id="" class="form-control">
                           </div>

                       <div class="form-group">
    @php 
        $routine = App\Models\Routine::all();
    @endphp
    <label for="select_routine_2">Please Select a Routine From The Library</label>
    <select class="form-control select2" ame="routine" id="select_routine">
        <option value="" selected disabled>Select Routine</option>
        @foreach ($routine as $item)
            <option value="{{ $item->id }}">
                {{ $item->title }}
            </option>
        @endforeach
    </select>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Routine"
        });
    });
</script>


                           <!-- <button type="submit" value="Import Routine Template" class=" btn btn-info float-right"> -->
                            <!-- <button class="btn btn-info float-right">Import Routine Template</button> -->
                            <div class="text-right">
                                    <a id="importRoutineBtn"
   class="btn btn-outline-info"
   title="Import Routine" style="background-color: #F0F0F0; color: #76838F;" onclick="ImportRoutineLayout()"
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

    @php
    $sets = App\Models\Sets::findOrFail(1); // Fetch your Sets model data
    $numberOfInputs = $sets->sets; // Get the number of input fields needed

    $inc = App\Models\Message::findOrFail($user);
    $increment_val = $increment;
    
    
@endphp

<div class="col-md-12 col-sm-12">
    <label class="control-label" for="name">Enter Weight [KG]</label>
    <div class="row">
    @for ($i = 0; $i < $numberOfInputs; $i++)
            <div class="col-md-3">
               


                       <input type="text" name="weight[]" id="weight{{ $i + 1 }}" 
                       class="form-control weight-input @if ($i > 0) readonly @endif" 
                       placeholder="e.g. 10, 12, 15 KG"
                       @if ($i > 0) readonly @endif required>
            </div>
        @endfor

        <button type="button" id="editButton" class="btn btn-primary">Edit</button>
    </div>
</div>

    <div class="col-md-12 col-sm-12">
        <label class="control-label" for="name">Enter Number Of Repititions </label>
        <div class="row">
        @for ($i = 0; $i < $numberOfInputs; $i++)
            <div class="col-md-3">
                <input type="text" name="reps[]" id="reps{{ $i + 1 }}" 
                       class="form-control reps-input @if ($i > 0) readonly @endif" 
                       placeholder="e.g. 10, 12, 15 KG"
                       @if ($i > 0) readonly @endif required>
            </div>
        @endfor

        <button type="button" id="editRepsButton" class="btn btn-primary">Edit</button>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
    <label class="control-label" for="name">Enter Workout Duration [Seconds]</label>
    <div class="input-group">
        <input type="text" name="duration" id="duration" placeholder="e.g. 50" class="form-control" required>
        <div class="input-group-append">
        <div class="input-group-text">
            <label style="margin-right:2px;margin-left:2px;"><input type="radio" style="margin-left:2px;" name="duration_unit" value="Mins" required> Mins</label>
            <label><input type="radio" style="margin-left:2px;" name="duration_unit" value="Secs"> Secs</label>
            </div>
        </div>
    </div>
</div>


<div class="col-md-12 col-sm-12">
    <label class="control-label" for="name">Enter Rest Duration Duration </label>
    <div class="input-group">
        <input type="text" name="rest_duration" id="duration" placeholder="e.g. 50" class="form-control" required>
        <div class="input-group-append">
        <div class="input-group-text">
            <label style="margin-right:2px;margin-left:2px;"><input type="radio" style="margin-left:2px;" name="rest_d_unit" value="res_Mins" required> Mins</label>
            <label><input type="radio" style="margin-left:2px;" name="rest_d_unit" value="res_Secs"> Secs</label>
            </div>
        </div>
    </div>
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
    $(document).ready(function() {
        $('#weight1').on('input', function() {
            var enteredValue = parseInt($(this).val());

            if (!isNaN(enteredValue)) {
                var currentValue = enteredValue;
                var increment = {{ intval($increment_val) }}; // Ensure $increment_val is an integer

                // Update readonly fields
                $('.weight-input.readonly').each(function(idx) {
                    currentValue += increment;
                    $(this).val(currentValue.toFixed(0));
                });
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#editButton').on('click', function() {
            $('.weight-input.readonly').prop('readonly', false).addClass('editable');
            $(this).hide(); // Hide the edit button after clicking
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#reps1').on('input', function() {
            var enteredValue = parseInt($(this).val());

            if (!isNaN(enteredValue)) {
                var currentValue = enteredValue;
                var increment = {{ $increment_val }};

                // Update readonly fields
                $('.reps-input.readonly').each(function(idx) {
                    currentValue += increment;
                    $(this).val(currentValue.toFixed(0));
                });
            }
        });

        $('#editRepsButton').on('click', function() {
            $('.reps-input.readonly').prop('readonly', false).addClass('editable');
            $(this).hide(); // Hide the edit button after clicking
        });
    });
</script>

<script>
document.getElementById('EditWorkoutForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the current values
    const weight = document.getElementById('weight').value;
    const reps = document.getElementById('reps').value;
    const duration = document.getElementById('duration').value;

    // Simulate form submission success
    alert('Workout saved successfully!');

    // After submission, keep the values in the input fields
    document.getElementById('weight').setAttribute('value', weight);
    document.getElementById('reps').setAttribute('value', reps);
    document.getElementById('duration').setAttribute('value', duration);
});
</script>

        
<script>
      function ImportRoutineLayout() {
        document.getElementById('importRoutineBtn').style.pointerEvents = 'none';
    document.getElementById('importRoutineBtn').style.opacity = '0.5'; // Optional: reduce opacity to indicate disabled state

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            let routine = $('#select_routine').val();

            $('#voyager-loader').css('display', 'block');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.fetchRoutineTemplate') }}",
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
    url: "{{route('admin.planroutine.store')}}",
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
            // $("#EditWorkoutForm input").val("");

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
    url: "{{route('admin.assignplan.submitform')}}",
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
            window.location.href = '{{route("admin.assignplan.view_index", ['id' => $user, 'increment' => $increment]  )}}';
            $(form + " input").val("");
            $('workoutsDiv').html('');
        }

        setTimeout(function() {
            $('#AlertMessage').fadeOut();
        }, 3000);
    },

    error: function(xhr, textStatus, errorThrown) {
    // Hide loader
    $('#voyager-loader').css('display', 'none');

    // Remove any existing alert classes and add danger class
    $('#AlertMessage').removeClass('alert-success').addClass('alert-danger');

    // Display error message from server response
    var errorMessage = "An error occurred";
    if (xhr.responseJSON && xhr.responseJSON.message) {
        errorMessage = xhr.responseJSON.message;
    } else if (xhr.status === 401) {
        errorMessage = "Unauthorized access. Please login again.";
        // Optionally, handle specific HTTP status codes with custom messages
    } else if (xhr.status === 403) {
        errorMessage = "Forbidden. You don't have permission to access this resource.";
    } else if (xhr.status === 404) {
        errorMessage = "Resource not found.";
    } else {
        errorMessage = "An unknown error occurred. Please try again later.";
    }

    // Display error message in alert box
    $('#AlertMessage').html(errorMessage).fadeIn();

    // Hide modal (if any) after showing alert
    $('#EditAddWorkout').modal('hide');

    // Fade out alert message after 3 seconds
    setTimeout(function() {
        $('#AlertMessage').fadeOut();
    }, 3000);
}

});
});
</script>






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
