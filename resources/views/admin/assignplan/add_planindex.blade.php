@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<form method="GET" action="{{ route('admin.assignplan.next') }}">
    @csrf
    <h1 class="h3 mb-2 text-gray-800 mb-3">
        <!-- Your header content here -->
    </h1>

    <div class="row mt-5">
        <div class="col-md-6 m-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Adding New Plan
                        <a href="{{ route('admin.assignplan.index') }}" class="btn btn-warning float-right btn-sm" id="btn-add">
                            <i class="fa-solid fa-square-plus text-light"></i> Return to List
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 m-auto">
                            @php
                                $messages = App\Models\Message::all();
                            @endphp
                            <label for="">Select User</label>
                            <select name="user_id" id="" class="form-control" required>
                                <option value="" class="text-center" selected disabled>----------- Select User ----------</option>
                                @foreach($messages as $message)
                                <option value="{{ $message->id }}">{{ $message->fname }} {{ $message->lname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="">Increment</label>
                            <input type="number" name="incremenet" min="1" id="" class="form-control" required placeholder="Enter Increment Eg: 2 5 10">
                        </div>
                        <input type="submit" value="Next" class="btn btn-primary form-control mt-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
