@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">




    <h1 class="h3 mb-2 text-gray-800 mb-3">

    <!-- <a href="{{route('admin.comp.add')}}" class="btn btn-success btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New</a>
    
    <button type="button" class="btn btn-danger btn-sm" style="display:inline-block;" onclick="handleAction('archive')">Bulk Delete</button> -->
    <!-- <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a> -->

</h1>



            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">View {{$data->title}} 
                            <a href="{{route('admin.assignplan.view_index',['id' =>  $user_id, 'increment'=>$increment])}}" class="btn btn-danger float-right">Back</a>
                            </h5>
                            
                        </div>
                        
                <div class="card-body">

                    <div class="row">

                    <div class="col-md-12">


                        <table class="table">
                        <thead class="bg-danger text-light" style="background-color: red !important;color:white;">
                        <tr class="bg-danger text-light" style="background-color: red !important;color:white;">
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white"></th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">SNO</th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Title</th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Exercise</th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Image</th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Weight[KG]</th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">WorkoutDuration</th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Repetition</th>
                        <th scope="col" style="background-color: red !important;color:white;border-right:1px solid white">Edit</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php 
                        $counter = 0;
                        @endphp
                        @foreach($data1 as $item)
                        <tr id="row_{{ $item->id }}">
                        @php 
                        $counter ++;
                        @endphp
                        <form action="{{route('admin.assignplan.swaproutineposition',$item->id)}}" method="post">
                            @csrf
                        <td>
       <div style="display: flex;flex-direction:row;width:100%;justify-content:space-around;">
       <input type="text" name="id[]" value="{{$item->id}}">
       <input type="text" name="position[]" value="{{$item->position}}">
       <a href="#" class="arrow-up" data-item-id="{{ $item->id }}"><i class="fa fa-arrow-up"></i></a>
       <a href="#" class="arrow-down" data-item-id="{{ $item->id }}"><i class="fa fa-arrow-down"></i></a>
       </div>
        </td>
                        <td style="background-color: gray !important;color:white;border-right:1px solid white">
                        <span class="span1 ">{{ $counter }}</span>
                        </td>
                        <td >
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
                        <br>
                        <center>

                            
                        </center>
                        </td>
                        <td class="blank">
                        <span class="span1">
                        <a href="{{ isset($exer) ? asset('storage/'.$exer->exercise_image) : asset('storage/default_image.jpg') }}" target="_blank">
                        <img src="{{ isset($exer) ? asset('storage/'.$exer->exercise_image) : asset('storage/default_image.jpg') }}" width="90px" height="90px" alt="">
                        </a>

                        </span>
                        </td>
                        <td class="blank" >
                        <center>
                        <span class="span1 text-danger" style="font-weight: bold;">{{ $item->weight }}</span>

                        </center>
                        <br>
                        <center>

     
                    </center>
                    </td>

                    <td class="blank">
                    <center>
                    <span class="span1 text-danger" style="font-weight: bold;">{{ $item->workout_duration }}</span>

                    </center>
                    <br>
                    <center>

                        
                    </center>
                    </td>

                    <td >
                    <center>
                    <span class="span1 text-danger" style="font-weight: bold;">{{ $item->repititions }}</span> <!-- Typo fixed: 'repititions' should be 'repetitions' -->

                    </center>
                    <br>
                    <center>

     
                        </center>
                        </td>

                        <td>
    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
        data-weight="{{ $item->weight }}"
        data-workout_duration="{{ $item->workout_duration }}"
        data-repetitions="{{ $item->repititions }}" 
        data-item_id="{{ $item->id }}"
        onclick="populateModal(this)">
        <i class="fa-regular fa-pen-to-square"></i>
    </a>
</td>

<script>
function populateModal(button) {
    var weight = button.getAttribute('data-weight');
    var workoutDuration = button.getAttribute('data-workout_duration');
    var repetitions = button.getAttribute('data-repetitions');
    var itemId = button.getAttribute('data-item_id');

    document.getElementById('weight').value = weight;
    document.getElementById('workout_duration').value = workoutDuration;
    document.getElementById('repetitions').value = repetitions;
    document.getElementById('item_id').value = itemId;
}
</script>

                        </tr>

                       
                        @endforeach <!-- Make sure to close the foreach loop properly -->
                        </tbody>
                        </table>
                        <input type="hidden" name="routine_id" value="{{$routine_id}}">
                        <input type="submit" value="Save Routine" class="form-control btn btn-success">
                        </form>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
    $(document).ready(function() {
        // Handle click on arrow-up button
        $('body').on('click', '.arrow-up', function(e) {
            e.preventDefault();
            var currentRow = $(this).closest('tr');
            var prevRow = currentRow.prev('tr');

            if (prevRow.length) {
                currentRow.insertBefore(prevRow);
                updateSno();
            }
        });

        // Handle click on arrow-down button
        $('body').on('click', '.arrow-down', function(e) {
            e.preventDefault();
            var currentRow = $(this).closest('tr');
            var nextRow = currentRow.next('tr');

            if (nextRow.length) {
                currentRow.insertAfter(nextRow);
                updateSno();
            }
        });

        // Function to update serial numbers (Sno)
       
    function updateSno() {
        $('tbody tr').each(function(index) {
            $(this).find('td:first .span1').text(index + 1);
            $(this).find('input[name="position[]"]').val(index + 1);
        });
    }
    });
</script>
                        <!-- <input type="submit" value="Save Plan" class="btn btn-success float-right"> -->
                        <a href="{{ route('admin.assignplan.deleteroutine', ['routine_id' => $routine_id, 'user_id' => $user_id]) }}" onclick="return confirm('Are you sure want to Delete this?')" class="btn btn-danger float-right mr-3">Delete</a>

                        </div>

                        </div>
                        </div>

                    </div>
                   
                </div>

                


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
                        <label for="workout_duration">Workout Duration[Minutes]</label>
                        <input type="text" class="form-control" id="workout_duration" name="workout_duration">
                    </div>
                    <div class="form-group">
                        <label for="repetitions">Repetitions</label>
                        <input type="text" class="form-control" id="repetitions" name="repetitions">
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
