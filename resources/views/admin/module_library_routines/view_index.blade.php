@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Viewing User Routine Library 

<a href="{{route('admin.module.library.routines.index')}}" class="btn btn-warning">Return to List</a>
   
</h1>


      <div class="row mt-5" >
      



      <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 0;background-color:white;">
                <div class="panel panel-bordered">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Title</h3>
                        <div class="panel-body" style="padding-top:0;">
                         

                           {{$data->title}}
                        </div>
                    </div>
                </div>
                </div>

                </div>
<hr>
<div class="row">
            <div class="col-md-12" style="background-color: white;">
                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Routine Workouts</h3>

                        <div class="panel-body" style="padding-top:0;">
                            <table class="table table-bordered table-striped" id="">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col" style="min-width: 200px;">Exercise</th>
                                        <th scope="col">Workout</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($data1 as $item)
                                    @php 
                                    $exercise = App\Models\Exercise::where('id',$item->exercise_id)->first();
                                    @endphp
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $exercise->title }}</td>
                                            <td><img src="{{ asset('storage/' . $exercise->exercise_image) }}"
                                                    alt="{{ $exercise->title . 'Image' }}" width="200px">
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

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
