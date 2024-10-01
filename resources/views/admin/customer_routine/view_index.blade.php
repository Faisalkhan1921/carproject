@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Viewing Customer Routine   

   <a href="{{route('admin.customer.routines.index')}}" class="btn btn-warning">Return to List</a>
</h1>


      <div class="row mt-5" >
     
      <div class="page-content read container-fluid">
        <div class="row">

   

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
            <h3 class="panel-title">Routine Title</h3>
              <div class="card-body mb-4">
              {{ $dataTypeContent->title }}

              </div>
            </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
            <h3 class="panel-title">User Details</h3>
              <div class="card-body">
              
              <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 0;">
                  <b>User Name : </b> {{ $dataTypeContent->user->fname }}
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 0;">
                  <b>Email : </b> {{ $dataTypeContent->user->email }}
              </div>
              </div>
              </div>
            </div>
            </div>



         

            <div class="col-md-12">

                <div class="card mt-3" style="padding-bottom:5px;">
                    <div class="card-header" style="border-bottom:0;">
                        <h3 class="panel-title text-primary">Routine Workouts</h3>
                    </div>

                    <div class="card-body" style="padding-top:0;">

                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Repititions</th>
                                    <th scope="col">Workout Duration</th>
                                    <th scope="col">Exercise Name</th>
                                    <th scope="col">Exercise Image</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($dataTypeContent->routineWorkout as $item)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->weight }}</td>
                                        <td>{{ $item->repititions }}</td>
                                        <td>{{ $item->workout_duration }}</td>
                                        <td>{{ $item->exercise->title }}</td>
                                        <td><img src="{{ asset('storage/' . $item->exercise->exercise_image) }}"
                                                alt="{{ $item->exercise->title . 'Image' }}" width="150px">
                                        </td>
                                    </tr>

                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>











      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
