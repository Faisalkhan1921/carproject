@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
    @php 
        $adm_rec = App\Models\Message::where('id',$user)->first();
        if($adm_rec) {
            $name = $adm_rec->fname;
        }
    @endphp 

    <h1 class="h3 mb-2 text-gray-800 mb-3">
        Viewing {{$name}} Call outs
        <a href="{{route('admin.assignplan.index')}}" class="btn btn-danger float-right mr-3">Back</a>
    </h1>

    <div class="row mt-5">
        <div class="col-md-10 m-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary"></h5>

                    <ul class="nav nav-tabs" id="exerciseTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            @if($warmup_emer->isEmpty())
                            <a class="nav-link active" id="warmup-tab" data-bs-toggle="tab" href="#warmup" role="tab" aria-controls="warmup" aria-selected="true">Warmup</a>
                                @else 
                                    @php
                                        $warmup_counter = $warmup_emer->count();
                                    @endphp
                                    <a class="nav-link active" id="warmup-tab" data-bs-toggle="tab" href="#warmup" role="tab" aria-controls="warmup" aria-selected="true">
                                        Warmup ({{ $warmup_counter }})
                                    </a>
                                @endif
                        </li>
                        <li class="nav-item" role="presentation">
                        @if($emer->isEmpty())
    <a class="nav-link" id="workout-tab" data-bs-toggle="tab" href="#workout" role="tab" aria-controls="workout" aria-selected="false">Workout</a>
@else 
    @php
        $counter = $emer->count();
    @endphp
    <a class="nav-link" id="workout-tab" data-bs-toggle="tab" href="#workout" role="tab" aria-controls="workout" aria-selected="false">
        Workout ({{ $counter }})
    </a>
@endif

                        </li>
                        <li class="nav-item" role="presentation">


@if($cardio_emer->isEmpty() && $new_flag2->isEmpty())
<!-- <a class="nav-link active" id="warmup-tab" data-bs-toggle="tab" href="#warmup" role="tab" aria-controls="warmup" aria-selected="true">Warmup</a> -->
<a class="nav-link" id="cardio-tab" data-bs-toggle="tab" href="#cardio" role="tab" aria-controls="cardio" aria-selected="false">Cardio</a>

    @else 
     @php
            $cardio_counter = $cardio_emer->count() + $new_flag2->count();

        @endphp   


<a class="nav-link" id="cardio-tab" data-bs-toggle="tab" href="#cardio" role="tab" aria-controls="cardio" aria-selected="false">Cardio ({{ $cardio_counter }})</a>
    @endif
</li>
                     
                        <li class="nav-item" role="presentation">

                            @if($cooldown_emer->isEmpty() && $new_flag1->isEmpty())
                            <!-- <a class="nav-link active" id="warmup-tab" data-bs-toggle="tab" href="#warmup" role="tab" aria-controls="warmup" aria-selected="true">Warmup</a> -->
                            <a class="nav-link" id="cooldown-tab" data-bs-toggle="tab" href="#cooldown" role="tab" aria-controls="cooldown" aria-selected="false">Cooldown</a>

                                @else 
                                    @php
                                        $cooldown_counter = $cooldown_emer->count() + $new_flag1->count();

                                    @endphp
                            <a class="nav-link" id="cooldown-tab" data-bs-toggle="tab" href="#cooldown" role="tab" aria-controls="cooldown" aria-selected="false">Cooldown ({{ $cooldown_counter }})</a>

                                 
                                @endif
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- Tab Navigation -->
          

                    <!-- Tab Content -->
                    <div class="tab-content" id="exerciseTabsContent">
                        <!-- Warmup Tab -->
                        <div class="tab-pane fade show active" id="warmup" role="tabpanel" aria-labelledby="warmup-tab">
                        @if($warmup_emer->isEmpty())
    <!-- Display message or empty state -->
@else
    @php
        $currentWarmupName = null;
    @endphp

    @foreach($warmup_emer as $emers1)
        @php
            $warmup_name = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $emers1->user_allotted_module_id)->first();
            $exer_name = App\Models\Exercise::where('id', $emers1->exercise_id)->first();
            $exer_naming = $exer_name->title;
            $warmup_naming = App\Models\UserAllotedModule::where('id', $emers1->user_allotted_module_id)->value('title');
        @endphp

        @if($currentWarmupName !== $warmup_naming)
            @if($currentWarmupName !== null)
                </div></div></div> <!-- Close the previous card -->
            @endif
            <!-- Start a new card for the new warmup name -->
            <div class="col-md-12 mt-3">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-dumbbell"></i> {{$warmup_naming}}</h6>
                        <span class="badge bg-light text-dark">Skipped</span>

                    </div>
                    <div class="card-body bg-light">
                        @php $currentWarmupName = $warmup_naming; @endphp
        @endif

        <!-- Content for the current warmup -->
        <div class="mb-2">
            <h5 class="">{{$exer_naming}}</h5>
            <p class="mb-2"><strong>Emergency Stop:</strong> {{$emers1->emergency_stop}}</p>
            <a href="{{route('admin.assignplan.warmup_addindex',['id'=>$user, 'increment' => $increment])}}" class="btn btn-danger btn-sm ">
                <i class="fas fa-info-circle"></i> More Info
            </a>
            <!-- <hr> -->
        </div>
    @endforeach

    </div> <!-- Close the last card body -->
    </div> <!-- Close the last card -->
    </div> <!-- Close the last card -->
@endif


    @if($new_flag->isEmpty())
    <!-- Display message or empty state -->
@else
    @php
        $currentWarmupName = null;
    @endphp

    @foreach($new_flag as $new)
        @php
            $warmup_name = App\Models\ModuleLibraryPivot::where('user_allotted_module_id',$new->warnup_id)->first();
            $exer_name = App\Models\Exercise::where('id',$new->exercise_id)->first();
            $exer_naming = $exer_name->title;
            $warmup_naming = App\Models\UserAllotedModule::where('id', $new->warnup_id)->value('title');

            $routine_name = App\Models\CustomerRoutine::where('id', $new->warmup_day)->first();
$rutine_naming = $routine_name->title;


$routine_w_exercise_count = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $new->warnup_id)->pluck('exercise_id');
$routine_w_exercise_count1 = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $new->warnup_id)->where('exercise_performed',3)->pluck('exercise_id');

$total_w_count_ex = $routine_w_exercise_count->count(); // Total number of exercises
$total_w_skip_count_ex = $routine_w_exercise_count1->count(); // Skipped/Failed exercises

$warmup_today_p = App\Models\skipLibraries::where('warnup_id', $new->warnup_id)->where('warmup_day',$new->warmup_day)->where('exercise_performed', 1)->pluck('exercise_id');
$warmup_today_skip = App\Models\skipLibraries::where('warnup_id', $new->warnup_id)->where('warmup_day',$new->warmup_day)->where('exercise_performed', 2)->pluck('exercise_id');

$count_warmup_today_p = $warmup_today_p->count(); // Exercises performed successfully
$count_warmup_today_skip = $warmup_today_skip->count(); // Exercises skipped/failed today

// Calculate success progress percentage
if ($total_w_count_ex > 0) {
    $success_progress = ($count_warmup_today_p / $total_w_count_ex) * 100;
} else {
    $success_progress = 0; // Handle division by zero if there are no exercises
}
// dd(round($success_progress, 2) . "%");
// Display the success progress
// echo "Success Progress: " . round($success_progress, 2) . "%";



        @endphp

        @if($currentWarmupName !== $warmup_naming)
            @if($currentWarmupName !== null)
                </div></div></div> <!-- Close the previous card -->
            @endif
            <!-- Start a new card for the new warmup name -->
            <div class="col-md-12 mt-3">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-dumbbell"></i>{{$rutine_naming}} - {{$warmup_naming}}</h6>
                        <span class="badge bg-light text-dark">Progress {{round($success_progress, 2) }} %</span>
                    </div>
                    <div class="card-body bg-light">
                        @php $currentWarmupName = $warmup_naming; @endphp
        @endif

        <!-- Content for the current warmup -->
        <div class="" >
            <h5 class="">{{$exer_naming}}</h5>
            <p class="mb-2"><strong>Emergency Stop:</strong> {{$new->reason}}</p>
            
            <a href="{{route('admin.assignplan.warmup_addindex',['id'=>$user, 'increment' => $increment])}}" class="btn btn-danger btn-sm ">
                <i class="fas fa-info-circle"></i> More Info
            </a>
        </div>
        <hr>
    @endforeach

    </div> <!-- Close the last card body -->
    </div> <!-- Close the last card -->
    </div> <!-- Close the last card -->
@endif
</div>
</div>
<!-- </div> -->


<!-- ============================================================== customer routine ================================================== -->






                        <!-- Workout Tab -->
                        <div class="tab-pane fade" id="workout" role="tabpanel" aria-labelledby="workout-tab">
    @if($emer->isEmpty())
        <!-- Display message or empty state -->
    @else
        @php
            $currentRoutineName = null;
        @endphp

        @foreach($emer as $emers)
            @php
            $routine_name = App\Models\CustomerRoutine::where('id', $emers->routine_id)->first();
$exer_name = App\Models\Exercise::where('id', $emers->exercise_id)->first();
$exer_naming = $exer_name->title;
$rutine_naming = $routine_name->title;

$routine_exercise_count = App\Models\CustomerRoutineWorkouts::where('routine_id', $emers->routine_id)->pluck('exercise_id');
$routine_exercise_count1 = App\Models\CustomerRoutineWorkouts::where('routine_id', $emers->routine_id)->where('exercise_performed', 1)->pluck('exercise_id');

// Total number of exercises in the routine
$routine_ex_count = count($routine_exercise_count);

// Total number of exercises fully performed
$routine_ex_perf_count = count($routine_exercise_count1);

// Calculate progress for exercises where exercise_performed = 2
$partial_exercises = App\Models\CustomerRoutineWorkouts::where('routine_id', $emers->routine_id)
    ->where('exercise_performed', 2)
    ->get();

$partial_progress = 0;
foreach ($partial_exercises as $exercise) {
    $available_rounds = $exercise->available_rounds;
    $total_round_performed = $exercise->total_round_performed;

    // Ensure the rounds are not zero to avoid division by zero
    if ($available_rounds > 0) {
        $partial_progress += ($total_round_performed / $available_rounds) * 100;
    }
}

// Add the partial progress to the fully completed exercises progress
$total_exercises = $routine_ex_count + count($partial_exercises);
$overall_progress = ($routine_ex_perf_count * 100) + $partial_progress;

// Calculate final progress percentage
if ($total_exercises > 0) {
    $progress = intval($overall_progress / $total_exercises);
} else {
    $progress = 0; // Set to 0 if no exercises are present
}

            @endphp

            @if($currentRoutineName !== $rutine_naming)
                @if($currentRoutineName !== null)
                    </div></div></div> <!-- Close the previous card -->
                @endif
                <!-- Start a new card for the new routine name -->
                <div class="col-md-12 mt-3">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-running"></i> {{$rutine_naming}}</h6>
                            <span class="badge bg-light text-dark">Progress: {{$progress}}%</span>
                        </div>
                        <div class="card-body bg-light">
                            @php $currentRoutineName = $rutine_naming; @endphp
            @endif

            <!-- Content for the current routine -->
            <div class="mb-2">
                <h5 class="">{{$exer_naming}}</h5>
                <p><strong>Emergency Stop:</strong> {{$emers->emergency_stop}}</p>
                <a href="{{ route('admin.assignplan.view_routine_c', ['user_id' => $user , 'routine_id' => $emers->routine_id , 'increment' =>$increment , 'exercise_id' => $emers->exercise_id , 'row_id' => $emers->id]) }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-info-circle"></i> More Info
                </a>
            </div>
<hr>
        @endforeach

        </div> <!-- Close the last card body -->
        </div> <!-- Close the last card -->
        </div> <!-- Close the last card -->
      
    @endif
</div>






<!-- ============================================================== customer routine end ============================================================= -->



<!-- /////////////////////////////////////////////////////////// cardio start ========================================================= -->

     <!-- Cardio Tab -->
     <div class="tab-pane fade" id="cardio" role="tabpanel" aria-labelledby="cardio-tab">
                        @if($cardio_emer->isEmpty())
    <!-- Display message or empty state -->
@else
    @php
        $currentWarmupName1 = null;
    @endphp

    @foreach($cardio_emer as $emers5)
        @php
            $warmup_name = App\Models\CardioWorkout::where('cardio_id', $emers5->cardio_id)->first();
            $exer_name = App\Models\Exercise::where('id', $emers5->exercise_id)->first();
            $exer_naming = $exer_name->title;
            $cooldown_naming = App\Models\CardioModel::where('id', $emers5->cardio_id)->value('title');
        @endphp

        @if($currentWarmupName1 !== $cooldown_naming)
            @if($currentWarmupName1 !== null)
                
            @endif
            <!-- Start a new card for the new warmup name -->
            <div class="col-md-12 mt-3">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-dumbbell"></i> {{$cooldown_naming}}</h6>
                        <span class="badge bg-light text-dark">Skipped</span>

                    </div>
                    <div class="card-body bg-light">
                        @php $currentWarmupName1 = $cooldown_naming; @endphp
        @endif

        <!-- Content for the current warmup -->
        <div class="mb-2">
            <h5 class="">{{$exer_naming}}</h5>
            <p class="mb-2"><strong>Emergency Stop:</strong> {{$emers5->emergency_stop}}</p>
            <a href="{{ route('admin.assignplan.view_cardioroutine_c', ['user_id' => $user , 'routine_id' => $new_cardio->cardio_id , 'increment' =>$increment, 'exercise' => $emers5->exercise_id,'row_id' => $emers5->id]) }}" class="btn btn-danger btn-sm ">
                <i class="fas fa-info-circle"></i> More Info
            </a>
            <!-- <hr> -->
        </div>
    @endforeach

    </div> <!-- Close the last card body -->
    </div> <!-- Close the last card -->
    </div> <!-- Close the last card -->
@endif


    @if($new_flag2->isEmpty())

@else
    @php
        $currentWarmupName2 = null;
    @endphp

    @foreach($new_flag2 as $new_cardio)
        @php
            $warmup_name = App\Models\CardioWorkout::where('cardio_id',$new_cardio->cardio_id)->first();
            $exer_name = App\Models\Exercise::where('id',$new_cardio->exercise_id)->first();
            $exer_naming = $exer_name->title;
            $cooldown_naming = App\Models\CardioModel::where('id', $new_cardio->cardio_id)->value('title');


            $routine_name = App\Models\CardioModel::where('id', $new_cardio->cardio_id)->first();
$rutine_naming1 = $routine_name->title;

// dd($rutine_naming1);
$routine_w_exercise_count = App\Models\CardioWorkout::where('cardio_id', $new_cardio->cardio_id)->pluck('exercise_id');
$routine_w_exercise_count1 = App\Models\CardioWorkout::where('cardio_id', $new_cardio->cardio_id)->where('exercise_performed',3)->pluck('exercise_id');

$total_w_count_ex = $routine_w_exercise_count->count(); // Total number of exercises
$total_w_skip_count_ex = $routine_w_exercise_count1->count(); // Skipped/Failed exercises

$warmup_today_p = App\Models\skipLibraries::where('cardio_id', $new_cardio->cardio_id)->where('cardio_day',$new_cardio->cardio_day)->where('exercise_performed', 1)->pluck('exercise_id');
$warmup_today_skip = App\Models\skipLibraries::where('cardio_id', $new_cardio->cardio_id)->where('cardio_day',$new_cardio->cardio_day)->where('exercise_performed', 2)->pluck('exercise_id');

$count_warmup_today_p = $warmup_today_p->count(); // Exercises performed successfully
$count_warmup_today_skip = $warmup_today_skip->count(); // Exercises skipped/failed today

// Calculate success progress percentage
if ($total_w_count_ex > 0) {
    $success_progress = ($count_warmup_today_p / $total_w_count_ex) * 100;
} else {
    $success_progress = 0; // Handle division by zero if there are no exercises
}
// dd(round($success_progress, 2) . "%");
// Display the success progress
// echo "Success Progress: " . round($success_progress, 2) . "%";



        @endphp

        @if($currentWarmupName2 !== $rutine_naming1)
            @if($currentWarmupName2 !== null)
               
            @endif
            <!-- Start a new_cardio card for the new_cardio warmup name -->
            <div class="col-md-12 mt-3">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-dumbbell"></i>{{$rutine_naming1}} - {{$rutine_naming1}}</h6>
                        <span class="badge bg-light text-dark">Progress {{round($success_progress, 2) }} %</span>
                    </div>
                    <div class="card-body bg-light">
                        @php $currentWarmupName2 = $rutine_naming1; @endphp
        @endif

        <!-- Content for the current warmup -->
        <div class="" >
            <h5 class="">{{$exer_naming}}</h5>
            <p class="mb-2"><strong>Emergency Stop:</strong> {{$new_cardio->reason}}</p>
            
            <a href="{{ route('admin.assignplan.view_cardioroutine_c', ['user_id' => $user , 'routine_id' => $new_cardio->cardio_id , 'increment' =>$increment, 'exercise' => $new_cardio->exercise_id,'row_id' => $new_cardio->id]) }}" class="btn btn-danger btn-sm ">
                <i class="fas fa-info-circle"></i> More Info
            </a>
        </div>
        <hr>
    @endforeach

    </div> <!-- Close the last card body -->
    </div> <!-- Close the last card -->
    </div> <!-- Close the last card -->
@endif
                        </div>
                        </div>







                        <!-- ============================================================= cardio end ============================================== -->




<!-- ========================================================cool down ===================================== -->




<div class="tab-pane fade show active" id="cooldown" role="tabpanel" aria-labelledby="cooldown-tab">
                        @if($cooldown_emer->isEmpty())
    <!-- Display message or empty state -->
@else
    @php
        $currentWarmupName1 = null;
    @endphp

    @foreach($cooldown_emer as $emers5)
        @php
            $warmup_name = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $emers5->user_allotted_module_id)->first();
            $exer_name = App\Models\Exercise::where('id', $emers5->exercise_id)->first();
            $exer_naming = $exer_name->title;
            $cooldown_naming = App\Models\UserAllotedModule::where('id', $emers5->user_allotted_module_id)->value('title');
        @endphp

        @if($currentWarmupName1 !== $cooldown_naming)
            @if($currentWarmupName1 !== null)
                
            @endif
            <!-- Start a new card for the new warmup name -->
            <div class="col-md-12 mt-3">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-dumbbell"></i> {{$cooldown_naming}}</h6>
                        <span class="badge bg-light text-dark">Skipped</span>

                    </div>
                    <div class="card-body bg-light">
                        @php $currentWarmupName1 = $cooldown_naming; @endphp
        @endif

        <!-- Content for the current warmup -->
        <div class="mb-2">
            <h5 class="">{{$exer_naming}}</h5>
            <p class="mb-2"><strong>Emergency Stop:</strong> {{$emers5->emergency_stop}}</p>
            <a href="{{route('admin.assignplan.cooldown_addindex',['id'=>$user, 'increment' => $increment])}}" class="btn btn-danger btn-sm ">
                <i class="fas fa-info-circle"></i> More Info
            </a>
            <!-- <hr> -->
        </div>
    @endforeach

    </div> <!-- Close the last card body -->
    </div> <!-- Close the last card -->
    </div> <!-- Close the last card -->
@endif

</div> <!-- Close the last card -->

    @if($new_flag1->isEmpty())
    <!-- Display message or empty state -->
@else
    @php
        $currentWarmupName1 = null;
    @endphp

    @foreach($new_flag1 as $new)
        @php
            $warmup_name = App\Models\ModuleLibraryPivot::where('user_allotted_module_id',$new->cooldown_id)->first();
            $exer_name = App\Models\Exercise::where('id',$new->exercise_id)->first();
            $exer_naming = $exer_name->title;
            $cooldown_naming = App\Models\UserAllotedModule::where('id', $new->cooldown_id)->value('title');

            $routine_name = App\Models\CustomerRoutine::where('id', $new->cooldown_day)->first();
$rutine_naming1 = $routine_name->title;


$routine_w_exercise_count = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $new->cooldown_id)->pluck('exercise_id');
$routine_w_exercise_count1 = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $new->cooldown_id)->where('exercise_performed',3)->pluck('exercise_id');

$total_w_count_ex = $routine_w_exercise_count->count(); // Total number of exercises
$total_w_skip_count_ex = $routine_w_exercise_count1->count(); // Skipped/Failed exercises

$warmup_today_p = App\Models\skipLibraries::where('cooldown_id', $new->cooldown_id)->where('cooldown_day',$new->cooldown_day)->where('exercise_performed', 1)->pluck('exercise_id');
$warmup_today_skip = App\Models\skipLibraries::where('cooldown_id', $new->cooldown_id)->where('cooldown_day',$new->cooldown_day)->where('exercise_performed', 2)->pluck('exercise_id');

$count_warmup_today_p = $warmup_today_p->count(); // Exercises performed successfully
$count_warmup_today_skip = $warmup_today_skip->count(); // Exercises skipped/failed today

// Calculate success progress percentage
if ($total_w_count_ex > 0) {
    $success_progress = ($count_warmup_today_p / $total_w_count_ex) * 100;
} else {
    $success_progress = 0; // Handle division by zero if there are no exercises
}
// dd(round($success_progress, 2) . "%");
// Display the success progress
// echo "Success Progress: " . round($success_progress, 2) . "%";



        @endphp

        @if($currentWarmupName1 !== $cooldown_naming)
            @if($currentWarmupName1 !== null)
               
            @endif
            <!-- Start a new card for the new warmup name -->
            <div class="col-md-12 mt-3">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-dumbbell"></i>{{$rutine_naming1}} - {{$cooldown_naming}}</h6>
                        <span class="badge bg-light text-dark">Progress {{round($success_progress, 2) }} %</span>
                    </div>
                    <div class="card-body bg-light">
                        @php $currentWarmupName1 = $cooldown_naming; @endphp
        @endif

        <!-- Content for the current warmup -->
        <div class="" >
            <h5 class="">{{$exer_naming}}</h5>
            <p class="mb-2"><strong>Emergency Stop:</strong> {{$new->reason}}</p>
            
            <a href="{{route('admin.assignplan.warmup_addindex',['id'=>$user, 'increment' => $increment])}}" class="btn btn-danger btn-sm ">
                <i class="fas fa-info-circle"></i> More Info
            </a>
        </div>
        <hr>
    @endforeach

    </div> <!-- Close the last card body -->
    </div> <!-- Close the last card -->
    </div> <!-- Close the last card -->
@endif
</div>
</div>
</div>




<!-- =================================================== cool down end ============================================= -->
 




    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
