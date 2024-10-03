@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   
</h1> -->

@php 
$module = App\Models\Module::findOrFail(3);
$subtitle = $module->subtitle;
@endphp
      <div class="row mt-5">
        <div class="col-md-8 m-auto ">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">CoolDown {{$subtitle}}
                            <a href="{{route('admin.assignplan.view_index',['id' => $user, 'increment' =>$increment])}}" class="btn btn-danger btn-sm float-right">Back</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                        <form id="routineForm" action="{{ route('admin.assignplan.updatecooldown_subtitle',$module->id) }}" method="POST">
    @csrf
        <div class="row">
            <div class="col-md-5">
            <div class="form-group">
        <label for="title">Sub Title</label>
        <input type="text" name="subtitle" id="title" value="{{$subtitle}}" class="form-control" placeholder="eg Day 1">
    </div>
            </div>


           <div class="col-md-6">
            @if($subtitle != 'null')
           <input type="submit" value="Update" class=" btn btn-success " style="margin-top:31px;">
            @else 
            <input type="submit" value="Add" class=" btn btn-primary " style="margin-top:31px;">
            @endif
           </div> 
        </div>

        </form>
 <div class="row">
    <div class="col-md-12" style=" margin-bottom:12px;">
    <div class="form-group">
        <h3> Warmup & Cool Down

        <button type="button" class="btn  float-right mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            <i class="fa-solid fa-plus"></i> 
        </button>
        </h3>
       
    </div>
   

    </div>


    <div class="col-md-12 mt-3">
    <table class="table table-bordered users-table"  id="dataTable"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                       
                                        <!-- <th>Sno</th> -->
                                            <th>S.No</th>
                                            <th>Title</th>
                                            <th>Exercise</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
    @if($cooldown->isEmpty())
    <tr>
        <td colspan="5" class="text-center text-danger"><strong>No Data Available</strong></td>
    </tr>
    @else 
    @php 
    $counter = 0;
    @endphp
    @foreach($cooldown as $warm)
    @php 
    $counter++;
    $cooldown_rec = App\Models\UserAllotedModule::where('id', $warm->cooldown_id)->first();
    if($cooldown_rec)
    {
        $title = $cooldown_rec->title;
    }

    $exercise_ids = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $warm->cooldown_id)->pluck('exercise_id')->toArray();
    $exercises = App\Models\Exercise::whereIn('id', $exercise_ids)->orderByRaw('FIELD(id, ' . implode(',', $exercise_ids) . ') asc')->get();
    @endphp
    <tr> 
        <td>{{$counter}}</td>
        <td>{{$title}}</td>
        <td>
            @foreach($exercises as $exercise)
                <span class="badge badge-info p-2 mb-2">{{ $exercise->title }}</span>
            @endforeach
        </td>
        <td><a href="{{route('admin.assignplan.delete_cooldown',$warm->id)}}" onclick="return confirm('Are you sure want to Delete this?')" class="btn btn-danger btn-sm">Delete</a></td>
    </tr>
    @endforeach
    @endif
</tbody>

                                </table>

    </div>

   
 </div>

 <div class="col-md-12">
    <div class="main-div" style="display: flex; flex-direction: column; width: 100%; justify-content: center;">
<!-- 
        <div class="container" id="workoutcontainer1">
               </div>


        <div class="container" id="workoutcontainer" style="width: 100%; margin-left: auto;">
          
        </div> -->





    </div>
</div>




                        </div>
                    </div>
        </div>
      </div>

</div>




<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="exampleModal1Label"> Warmup & Cooldown</h5>
            </div>
            <div class="modal-body">
                <form  action="{{route('admin.assignplan.storecooldown')}}" method="post">
                    @csrf
                   <input type="hidden" name="user" value="{{$user}}" class="form-control">
                    <div class="form-group">
                        <label for="workout_id">Select CoolDown</label>
                        <select name="workout_id" id="workout_id" class="form-control">
                            <option value="" disabled selected>Select Warmup</option>
                            @php 
                            $workoutlibrary = App\Models\UserAllotedModule::all();
                            @endphp
                            @foreach($workoutlibrary as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <button type="button" class="btn btn-primary float-right" id="addonlyWorkoutBtn">Add Warmup</button> -->
                    <input type="submit" value="Add Cooldown" class=" btn btn-primary float-right">
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
