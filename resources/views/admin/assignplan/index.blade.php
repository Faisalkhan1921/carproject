@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">



<form id="archiveForm" method="POST" onsubmit="return handleSubmit()">
    @csrf
    <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Assign Plan
    
    <!-- <button type="button" class="btn btn-danger btn-sm" style="display:inline-block;" onclick="handleAction('archive')">Bulk Delete</button> -->
    <input type="hidden" name="selectedAction" id="selectedAction" value=""> <!-- Add a hidden input to store the selected action -->

    <!-- <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a> -->

</h1>


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Assigned Plan Records
                            <a href="{{route('admin.assignplan.addplanindex')}}" class="btn btn-primary float-right btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New Plan</a>
                            <a href="" class="btn btn-primary float-right btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Progress</a>

                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <div class="row">

                  

                           @if($users->isEmpty())
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No Record Available
                </div>
            </div>
        @else
                        @foreach($users as $user)
                        @php 
        $inc = App\Models\Message::findOrFail($user->id);
        $increment = $inc->increment;
        @endphp
            <div class="col-md-4" style="">
                <div class="card" style="border:1px solid gray; margin-bottom:12px;border-radius:12px; box-shadow: 10px 4px 8px rgba(42, 54, 59, 0.4);">
                    <div class="card-header" style="background-color:#F9F9F9;color:black;">
                        <h4 class="text-center">{{ $user->fname }}
                            @php 

        $customer_routine = App\Models\CustomerRoutine::where('user_id',$user->id)->orderBy('created_at','asc')->get();
        $routine_ids = $customer_routine->pluck('id');
      
        $data = App\Models\CustomerRoutine::orderBy('created_at','asc')->get();
        $data1 = App\Models\CustomerRoutineWorkouts::orderBy('created_at','asc')->get();
        
        $emer = App\Models\CustomerRoutineWorkouts::orderBy('created_at', 'asc')
        ->whereIn('routine_id', $routine_ids) // Use whereIn to filter by multiple IDs
        ->where('exercise_performed', 2)
        ->get();

        $warmup_routine = App\Models\WarmupModel::where('user_id',$user->id)->orderBy('created_at','asc')->get();
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

        $cooldown_routine = App\Models\CoolDown::where('user_id',$user->id)->orderBy('created_at','asc')->get();
        // dd($cooldown_routine);
        $cooldown_routine_ids = $cooldown_routine->pluck('cooldown_id');
        
        // dd($warmup_routine_ids);
        $cooldown_emer = App\Models\ModuleLibraryPivot::orderBy('created_at', 'asc')
        ->whereIn('user_allotted_module_id', $cooldown_routine_ids) // Use whereIn to filter by multiple IDs
        ->where('exercise_performed', 2)
        ->get();
        
        $cardio_routine = App\Models\Cardio ::where('user_id',$user->id)->whereNotNull('cardio_id')->orderBy('created_at','asc')->get();
        $cardio_routine_ids = $cardio_routine->pluck('cardio_id');
        
        
        $cardio_emer = App\Models\CardioWorkout::orderBy('created_at', 'asc')
        ->whereIn('cardio_id', $cardio_routine_ids) // Use whereIn to filter by multiple IDs
        ->where('exercise_performed', 2)
        ->get();
        // dd($cardio_emer);

                            @endphp

                            @if($emer->isEmpty() && $warmup_emer == 0 && $cooldown_emer->isEmpty() && $cardio_emer->isEmpty())
                            <a href="{{ route('admin.assignplan.callout', ['id' => $user->id , 'increment' => $increment]) }}" class="float-right" style="pointer-events: none;">
                            <i class="fa-solid fa-circle-exclamation text-dark"></i>
                            </a>
                            @else 
                            <a href="{{ route('admin.assignplan.callout', ['id' => $user->id , 'increment' => $increment]) }}" class="float-right">
                            <i class="fa-solid fa-circle-exclamation text-danger"></i>
                            </a>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body" style="background-color: #F9F9F9;">
                    <center>
                            <a href="{{ route('admin.assignplan.view_index', ['id' => $user->id , 'increment' => $increment]) }}" class="btn btn-primary">View Plan</a>
                        </center>
                    </div>
                </div>
            </div>
        @endforeach
        @endif


                        
               

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
