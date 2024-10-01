@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Customer Module

   
</h1> -->


      <div class="row mt-5">
        <div class="col-md-7 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Edit Message
                            <a href="{{route('admin.message.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.message.update',$users->id)}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">TimeTable</label>
                                <!-- <input type="text" name="title" id="" class="form-control" placeholder="Enter Title"> -->
                                 <input type="file" name="File1" id="" class="form-control">
                                 
        @php
            $emiratesId = json_decode($users->File1, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
            {{ $file['original_name'] }}
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File1 }}</span>
            <br>
        @endif
                            </div>

                            
                            <div class="form-group">
                                <label for="">File2</label>
                                <!-- <input type="text" name="title" id="" class="form-control" placeholder="Enter Title"> -->
                                 <input type="file" name="File2" id="" class="form-control">


                                 @php
            $emiratesId = json_decode($users->File2, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
            {{ $file['original_name'] }}
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File2 }}</span>
            <br>
        @endif


                            </div>


                            
                            <div class="form-group">
                                <label for="">File3</label>
                                <!-- <input type="text" name="title" id="" class="form-control" placeholder="Enter Title"> -->
                                 <input type="file" name="File3" id="" class="form-control">

                                 @php
            $emiratesId = json_decode($users->File3, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
            {{ $file['original_name'] }}
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File3 }}</span>
            <br>
        @endif


                            </div>


                            
                            <div class="form-group">
                                <label for="">File4</label>
                                <!-- <input type="text" name="title" id="" class="form-control" placeholder="Enter Title"> -->
                                 <input type="file" name="File4" id="" class="form-control">

                                 @php
            $emiratesId = json_decode($users->File4, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
            {{ $file['original_name'] }}
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File4 }}</span>
            <br>
        @endif


                            </div>


                            
                            <div class="form-group">
                                <label for="">File5</label>
                                <!-- <input type="text" name="title" id="" class="form-control" placeholder="Enter Title"> -->
                                 <input type="file" name="File5" id="" class="form-control">

                                 @php
            $emiratesId = json_decode($users->File5, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
            {{ $file['original_name'] }}
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File5 }}</span>
            <br>
        @endif


                            </div>

                            
                            <div class="form-group">
                                <label for="">File6</label>
                                <!-- <input type="text" name="title" id="" class="form-control" placeholder="Enter Title"> -->
                                 <input type="file" name="File6" id="" class="form-control">

                                 @php
            $emiratesId = json_decode($users->File6, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
            {{ $file['original_name'] }}
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File6 }}</span>
            <br>
        @endif


                            </div>


                       
                           <input type="submit" value="Add Customer Module" class="form-control btn btn-primary">

                           </form>
                        </div>
                    </div>
        </div>
      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Exercise",
            allowClear: true
        });
    });
</script>

@endsection
