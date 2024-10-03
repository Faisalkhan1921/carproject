@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Viewing Admin Library Record

<a href="{{route('admin.module.library.index')}}" class="btn btn-warning">Return to List</a>
   
</h1>


      <div class="row mt-5" >
      



      <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 0;">
                <div class="panel panel-bordered">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Title</h3>
                        <div class="panel-body" style="padding-top:0;">
                           @php 
                            $title = App\Models\UserAllotedModule::where('id',$dataTypeContent->user_allotted_module_id)->first();
                            $name_title = $title->title;
                           @endphp

                           {{$name_title}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 0;">
                <div class="panel panel-bordered">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Module</h3>
                        <div class="panel-body" style="padding-top:0;">
                        @php 
                            $mtitle = App\Models\UserAllotedModule::where('id',$dataTypeContent->user_allotted_module_id)->first();
                          
                            $module_id = App\Models\UserAllotedModule::where('module_id',$mtitle->module_id)->first();
                            $module = App\Models\UserAllotedModule::where('id',$module_id->id)->first();
                            $mname_title = $module->title;
                            $mname_subtitle = $module->subtitle;
                           @endphp
                            {{ $mname_title . ' - ' . $mname_subtitle }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Workouts</h3>

                        <div class="panel-body" style="padding-top:0;">
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="min-width: 200px;">Exercise</th>
                                        <th scope="col">Workout</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($data as $item)
                                    @php 
                                    $exercise = App\Models\Exercise::where('id',$item->exercise_id)->first();
                                    @endphp
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
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
