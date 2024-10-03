@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

    <div class="row mt-5">
        <div class="col-md-7 m-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Add Stretches Library
                        <a href="{{ route('admin.module.library.index') }}" class="btn btn-warning btn-sm float-right">Return to List</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form id="addStretchesForm" action="{{ route('admin.assignplan.store_stretches') }}" method="post">
                        @csrf
                        <input type="hidden" name="user" value="{{ $user }}">
                        <input type="hidden" name="increment" value="{{ $increment }}">
                        <div class="form-group">
                            <label for="">Workout Title</label>
                            <input type="text" name="title" class="form-control" value="Warm up">
                        </div>

                        <div class="form-group">
                            <label for="">Select Exercise</label>
                            <select name="exercise_id[]" id="user_id" class="form-control select2" multiple="multiple" required>
                                <option value="" disabled>Select Exercise</option>
                                @foreach($exercise as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="submit" value="Add Stretches" class="form-control btn btn-primary">

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Exercise",
            allowClear: true
        });

        // Submit form with confirmation
        $('#addStretchesForm').on('submit', function(event) {
            event.preventDefault(); // Prevent normal form submission

            var form = this;
            var workoutTitle = $('input[name="title"]').val();

            // Show confirmation dialog
            var confirmMessage = `Do you want to add these stretches to '${workoutTitle}'?`;
            if (confirm(confirmMessage)) {
                form.action = "{{ route('admin.assignplan.forcewarmupstore') }}"; // Change action
            } else {
                form.action = "{{ route('admin.assignplan.store_stretches') }}"; // Default action
            }

            // Submit the form
            form.submit();
        });
    });
</script>

@endsection
