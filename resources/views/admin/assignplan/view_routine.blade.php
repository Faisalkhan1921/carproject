@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800 mb-3"></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">
                View {{$data->title}} 
                <a href="{{route('admin.assignplan.view_index',['id' =>  $user_id, 'increment'=>$increment])}}" class="btn btn-danger float-right">Back</a>
            </h5>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="updateRoutineForm" action="{{ route('admin.assignplan.updateOrder') }}" method="post">
                        @csrf
                        <table class="table" id="routineTable">
                            <thead class="bg-danger text-light" style="background-color: red !important;color:white;">
                                <tr class="bg-danger text-light" style="background-color: red !important;color:white;">
                                    <th scope="col" style="background-color:     red !important;color:white;border-right:1px solid white">#</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Title</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Exercise</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Image</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Weight[KG]</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Repetition</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">WorkoutDuration</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">RestDuration</th>
                                    <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Edit</th>
                                    <!-- <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Order</th> -->
                                </tr>
                            </thead>

                            <tbody>
                                @php 
                                $counter = 0;
                                @endphp
                                @foreach($data1 as $item)
                                <tr data-item-id="{{ $item->id }}">
                                    @php 
                                    $counter ++;
                                    @endphp
                                    <td style="display: flex;flex-direction:row;width:100%;justify-content:space-around;"> 
                                        <a type="button" class="" onclick="moveUp(this)"><i class="fa fa-arrow-up text-primary"></i></a>
                                        <a type="button" class="" onclick="moveDown(this)"><i class="fa fa-arrow-down text-primary"></i></a>
                                    </td>
                                    <td>
                                        <center>
                                            <span class="span1 text-danger" style="font-weight: bold;">{{ $item->title }}</span>
                                        </center>
                                    </td>
                                    <td>
                                        @php 
                                            $exer = App\Models\Exercise::where('id',$item->exercise_id)->first();
                                            if($exer)
                                            {
                                                $name = $exer->title;
                                            }
                                            else 
                                            {
                                                $name = '';
                                            }
                                        @endphp
                                        <center>
                                            <span class="span1 text-danger" style="font-weight: bold;">{{$name}}</span>
                                        </center>
                                    </td>
                                    <td class="blank">
                                        <span class="span1">
                                            <a href="{{ isset($exer) ? asset('storage/'.$exer->exercise_image) : asset('storage/default_image.jpg') }}" target="_blank">
                                                <img src="{{ isset($exer) ? asset('storage/'.$exer->exercise_image) : asset('storage/default_image.jpg') }}" width="90px" height="90px" alt="">
                                            </a>
                                        </span>
                                    </td>
                                    <td class="blank">
                                        <center>
                                            <span class="span1 text-danger" style="font-weight: bold;">{{ $item->weight }}</span>
                                        </center>
                                    </td>
                                   
                                    <td>
                                        <center>
                                            <span class="span1 text-danger" style="font-weight: bold;">{{ $item->repititions }}</span>
                                        </center>
                                    </td>
                                    <td class="blank">
                                        <center>
                                            <span class="span1 text-danger" style="font-weight: bold;">{{ $item->workout_duration }}</span>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <span class="span1 text-danger" style="font-weight: bold;">{{ $item->rest_duration }}</span>
                                        </center>
                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            data-weight="{{ $item->weight }}"
                                            data-workout_duration="{{ $item->workout_duration }}"
                                            data-rest_duration="{{ $item->rest_duration }}"
                                            data-repetitions="{{ $item->repititions }}" 
                                            data-item_id="{{ $item->id }}"
                                            onclick="populateModal(this)">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" id="orderInput" name="order">
                        <input type="hidden" value="{{$routine_id}}" name="routine_id">
                        <div>

                            <input type="submit" value="Update Routine" class="btn btn-success float-right">
                            <a href="{{ route('admin.assignplan.deleteroutine', ['routine_id' => $routine_id, 'user_id' => $user_id]) }}" onclick="return confirm('Are you sure want to Delete this?')" class="btn btn-danger float-right mr-3">Delete</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function moveUp(button) {
    var row = button.closest('tr');
    var prevRow = row.previousElementSibling;
    if (prevRow && prevRow.nodeName === "TR") {
        row.parentNode.insertBefore(row, prevRow);
        updateOrder();
    }
}

function moveDown(button) {
    var row = button.closest('tr');
    var nextRow = row.nextElementSibling;
    if (nextRow && nextRow.nodeName === "TR") {
        row.parentNode.insertBefore(nextRow, row);
        updateOrder();
    }
}

function updateOrder() {
    var order = [];
    document.querySelectorAll('#routineTable tbody tr').forEach(function(row, index) {
        order.push(row.getAttribute('data-item-id'));
    });
    document.getElementById('orderInput').value = order.join(',');
}

function populateModal(button) {
    var weight = button.getAttribute('data-weight');
    var workoutDuration = button.getAttribute('data-workout_duration');
    var restDuration = button.getAttribute('data-rest_duration');
    var repetitions = button.getAttribute('data-repetitions');
    var itemId = button.getAttribute('data-item_id');

    document.getElementById('weight').value = weight;
    document.getElementById('workout_duration').value = workoutDuration;
    document.getElementById('rest_duration').value = restDuration;
    document.getElementById('repetitions').value = repetitions;
    document.getElementById('item_id').value = itemId;
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{route('admin.assignplan.updatewwr')}}" method="post">
        @csrf
                    <div class="form-group">
                        <label for="weight">Weight[KG]</label>
                        <input type="text" class="form-control" id="weight" name="weight">
                    </div>
                 
                    <div class="form-group">
                        <label for="repetitions">Repetitions</label>
                        <input type="text" class="form-control" id="repetitions" name="repetitions">
                    </div>
                    <div class="form-group">
                        <label for="workout_duration">Workout Duration</label>
                        <input type="text" class="form-control" id="workout_duration" name="workout_duration">
                    </div>

                    <div class="form-group">
                        <label for="workout_duration">Rest Duration</label>
                        <input type="text" class="form-control" id="rest_duration" name="rest_duration">
                    </div>

                    <input type="hidden" id="item_id" name="item_id">

                    <input type="submit" value="Update" class="btn btn-primary form-control">
                    <button type="button" class="btn btn-danger form-control mt-2" data-bs-dismiss="modal">Close</button>
                </form>
      </div>
   
    </div>
  </div>
</div>




@endsection
