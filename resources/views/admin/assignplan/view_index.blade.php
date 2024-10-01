@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">


@php 
$cooldown = App\Models\Module::findOrFail(3);
$cooldown_subtitle = $cooldown->subtitle;
$warmup = App\Models\Module::findOrFail(3);
$warmup_subtitle = $warmup->subtitle;

@endphp

<form id="archiveForm" method="POST" onsubmit="return handleSubmit()">
    @csrf
    <h1 class="h3 mb-2 text-gray-800 mb-3">

    
    <!-- <button type="button" class="btn btn-danger btn-sm" style="display:inline-block;" onclick="handleAction('archive')">Bulk Delete</button> -->
    <input type="hidden" name="selectedAction" id="selectedAction" value=""> <!-- Add a hidden input to store the selected action -->

    <!-- <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a> -->

</h1>
@php 
$adm_rec = App\Models\Message::where('id',$user)->first();
if($adm_rec)
{
    $name = $adm_rec->fname;
   
}



        $warmup_routine = App\Models\WarmupModel::where('user_id',$user)->orderBy('created_at','asc')->get();
        $warmup_routine_ids = $warmup_routine->pluck('warnup_id'); 
        $total_w_ent = App\Models\ModuleLibraryPivot::orderBy('created_at', 'asc')
        ->whereIn('user_allotted_module_id', $warmup_routine_ids) // Use whereIn to filter by multiple IDs
        ->where('exercise_performed', 0)
        ->get();
        $warmup_emer_2 = App\Models\skipLibraries::orderBy('created_at', 'asc')
        ->whereIn('warnup_id', $warmup_routine_ids)->where('warmup_day',92) // Use whereIn to filter by multiple IDs
        ->where('exercise_performed', 2)
        ->get();
        $warmup_emer_3 = App\Models\skipLibraries::orderBy('created_at', 'asc')
        ->whereIn('warnup_id', $warmup_routine_ids)->where('warmup_day',92) // Use whereIn to filter by multiple IDs
        ->where('exercise_performed', 3)
        ->get();
        $warmup_emer_1 = App\Models\skipLibraries::orderBy('created_at', 'asc')
        ->whereIn('warnup_id', $warmup_routine_ids)->where('warmup_day',92) // Use whereIn to filter by multiple IDs
        ->where('exercise_performed', 1)
        ->get();
        $total_w_entries = $total_w_ent->count();
        $total_w_skip = $warmup_emer_3->count();
        $total_w_eme_stop = $warmup_emer_2->count();
        $total_w_p = $warmup_emer_1->count();
        $warmup_emer = $total_w_eme_stop + $total_w_skip;
$successful_entries = $total_w_entries - ($total_w_skip + $total_w_eme_stop);
if ($total_w_entries > 0) {
    $percentage_successful = ($successful_entries / $total_w_entries) * 100;
} else {
    $percentage_successful = 0; // or some other default value
}


@endphp 

            <div class="row mt-5">
                <div class="col-md-10 m-auto">
                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Viewing {{$name}} Plans
                                
                            <a href="{{ route('admin.assignplan.daily_routine', ['user_id' => $user]) }}" class="btn btn-success float-right ml-2">Progress</a>
                            <a href="{{ route('admin.assignplan.routine', ['id' => $user, 'increment' => $increment]) }}" class="btn btn-primary float-right">Add new Day</a>

                                <a href="{{route('admin.assignplan.index')}}" class="btn btn-danger float-right mr-3">back</a>
                                </h5>
                                
                            </div>
                        <div class="card-body">
                           <div class="row">

                         <div class="col-md-12 m-auto">
                            <a href="{{route('admin.assignplan.warmup_addindex',['id'=>$user, 'increment' => $increment])}}" class="btn btn-primary">Warm Up {{$warmup_subtitle}} <span class="badge bg-danger text-light float-right ml-3">0 % </span></a>

                            <div class="row mt-5">
                                @php 
                                $counter = 0;
                                @endphp
                                @foreach($routine_workout as $item)
                                @php 
                                $counter ++;

                                $routine_exercise_count = App\Models\CustomerRoutineWorkouts::where('routine_id', $item->id)->pluck('exercise_id');
        $routine_exercise_count1 = App\Models\CustomerRoutineWorkouts::where('routine_id', $item->id)->where('exercise_performed', 1)->pluck('exercise_id');

        $routine_ex_count = count($routine_exercise_count);
        $routine_ex_perf_count = count($routine_exercise_count1);
      
        $progress = intval(($routine_ex_perf_count * 100)/$routine_ex_count);

        // dd($progress);
                                @endphp
                                <div class="col-md-4 mt-2">
                                    <div class="card p-1 m-3" style="box-shadow: 12px 12px 12px rgba(12,12,12,0.3);border:1px solid rgba(12,12,12,0.3);">
                                        <div class="card-header">
                                        <center>
                                                <a href="{{ route('admin.assignplan.view_routine', ['user_id' => $user , 'routine_id' => $item->id , 'increment' =>$increment]) }}" class=""> Day {{$counter}}  <span class="badge bg-danger text-light float-right">{{$progress}} %</span></a>
                                            </center>
                                        </div>

                                        <div class="card-body">
                                        <center>
                                                <a href="{{ route('admin.assignplan.view_routine', ['user_id' => $user , 'routine_id' => $item->id , 'increment' =>$increment]) }}" class="btn btn-info"> {{$item->title}}</a>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                          

                            </div>

                            
                            <a href="{{route('admin.assignplan.cardio_addindex',['id' =>$user , 'increment' =>$increment ])}}" class="btn btn-primary mt-5 mb-5">Cardio Library {{$cooldown_subtitle}}</a>
                            <br>
                            <a href="{{route('admin.assignplan.cooldown_addindex',['id' =>$user , 'increment' =>$increment ])}}" class="btn btn-primary mt-2">Cool Down {{$cooldown_subtitle}}</a>
                       
                         </div>
                        <div class="col-md-12">
                            <a href="{{route('admin.assignplan.downloadpdf',['user_id'=>$user, 'increment' => $increment])}}" class="float-right btn btn-secondary">Download PDF</a>
                        </div>

                     

                           </div>
                        </div>
                    </div>
                </div>
            </div>
                    </form>
</div>

<script>
function handleSubmit() {
    // This function will handle form submission based on the selected action
    var selectedAction = document.getElementById('selectedAction').value;

    if (selectedAction === 'archive') {
        document.getElementById('archiveForm').action = "{{ route('admin.comp.bulkdelete') }}";
    } else if (selectedAction === 'reminder') {
        // document.getElementById('archiveForm').action = "";
    }

    document.getElementById('archiveForm').submit(); // Submit the form
    return true; // Allow form submission
}

function handleAction(action) {
    // This function will handle the button click and set the selected action
    document.getElementById('selectedAction').value = action;
    handleSubmit(); // Call handleSubmit to dynamically set the form action and submit the form
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selectedRows[]"]');

        // Add event listener to the "Select All" checkbox
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
