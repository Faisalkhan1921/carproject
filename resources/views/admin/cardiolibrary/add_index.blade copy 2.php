@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-7 m-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Add Cardio Library
                        <a href="{{route('admin.cardio_library.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.cardio_library.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Cardio Title</label>
                            <input type="text" name="title" id="" class="form-control" placeholder="Enter Title">
                        </div>

                        <div class="form-group">
                            <label for="">Select Exercise</label>
                            <select name="exercise_id[]" id="exercise_id" class="form-control select2" multiple="multiple" required>
                                <option value="" disabled>Select Exercise</option>
                                @foreach($exercise as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="button" id="importExercises" class="btn btn-secondary">Import</button>
                        </div>

                        <div id="exerciseList"></div>

                        <input type="submit" value="Add Cardio Library" class="form-control btn btn-primary mt-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing workout duration -->
<div class="modal fade" id="editDurationModal" tabindex="-1" role="dialog" aria-labelledby="editDurationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDurationModalLabel">Edit Workout Duration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="currentExerciseId">
                <div class="form-group">
                    <label for="workoutDuration">Workout Duration (in minutes)</label>
                    <input type="number" id="workoutDuration" class="form-control">
                </div>
                <button type="button" id="saveDuration" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Exercise",
            allowClear: true
        });

        $('#importExercises').on('click', function() {
            const selectedExercises = $('#exercise_id').val();
            if (selectedExercises.length === 0) {
                alert('Please select at least one exercise');
                return;
            }

            const exerciseTitles = $('#exercise_id').select2('data').map(item => ({
                id: item.id,
                title: item.text,
                duration: 0
            }));

            let exerciseListHtml = '<ul class="list-group">';
            exerciseTitles.forEach((exercise, index) => {
                exerciseListHtml += `
                    <li class="list-group-item d-flex justify-content-between bg-warning  align-items-center mb-2" style="color:white;font-weight:bold;" data-id="${exercise.id}">
                        ${exercise.title} 
                        <div>
                        <span class="badge badge-info">${exercise.duration} min</span>
                            <button type="button" class="btn btn-sm btn-primary editExercise" data-id="${exercise.id}" data-title="${exercise.title}" data-toggle="modal" data-target="#editDurationModal">
                            <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <a type="button" class="moveUp">
        <i class="fas fa-arrow-up text-primary"></i>
                            
                            </a>
                            <a type="button" class="moveDown">
        <i class="fas fa-arrow-down text-primary"></i>
                            
                            </a>
                        </div>
                    </li>`;
            });
            exerciseListHtml += '</ul>';
            $('#exerciseList').html(exerciseListHtml);
        });

        $('#exerciseList').on('click', '.moveUp', function() {
            const listItem = $(this).closest('li');
            listItem.insertBefore(listItem.prev());
        });

        $('#exerciseList').on('click', '.moveDown', function() {
            const listItem = $(this).closest('li');
            listItem.insertAfter(listItem.next());
        });

        $('#exerciseList').on('click', '.editExercise', function() {
            const exerciseId = $(this).data('id');
            const exerciseTitle = $(this).data('title');
            $('#currentExerciseId').val(exerciseId);
            $('#editDurationModalLabel').text(`Edit Workout Duration for ${exerciseTitle}`);
        });

        $('#saveDuration').on('click', function() {
            const exerciseId = $('#currentExerciseId').val();
            const duration = $('#workoutDuration').val();
            $(`[data-id="${exerciseId}"] .badge`).text(`${duration} min`);
            $(`[data-id="${exerciseId}"]`).data('duration', duration);
            $('#editDurationModal').modal('hide');
        });

        $('form').on('submit', function(e) {
            const exercises = [];
            $('#exerciseList li').each(function() {
                const id = $(this).data('id');
                const duration = $(this).data('duration') || 0;
                exercises.push({id, duration});
            });

            $('<input>').attr({
                type: 'hidden',
                name: 'exercises',
                value: JSON.stringify(exercises)
            }).appendTo('form');
        });
    });
</script>

@endsection
