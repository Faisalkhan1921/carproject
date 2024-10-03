@extends('admin.admin_master')

@section('admin_content')

<style>

    body 
    {
        background-color: white !important;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid " style="background-color: white;">

<h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Viewing Message

<a href="{{route('admin.membership.index')}}" class="btn btn-warning">Return to List</a>
   
</h1>


      <div class="row mt-5" >
      


      <div class="col-md-12">

<div class="panel panel-bordered" style="padding-bottom:5px;">
    <!-- form start -->

  
    <hr style="margin:0;">

   @php 
    $user1 = App\Models\Message::where('id',$users->reg_id)->first();

  
    if($user1)
    {
        $email=$user1->email;
    }
   @endphp

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">User Email</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$email}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">


        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Current Package</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
            @php 
            $pckg = App\Models\Package::where('id',$users->package_id)->first();
            if($pckg)
            {

                $pckg_title = $pckg->title;
            }
            @endphp
        <p>{{$pckg_title}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">
          <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Reports File</h3>
        </div>

        @php
            $emiratesId = json_decode($users->file_path, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
        <a href="{{ asset('storage' .$file['download_link']) }}">
        {{ $file['original_name'] }}
        </a>
                        <br>
        </div><!-- panel-body -->
             
            @endforeach
        @else
            <!-- Handle the case where $users->file_path is not a valid JSON string -->
            <span>{{ $users->file_path }}</span>
        @endif
        
       
      
        <hr style="margin:0;">
        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Timetable</h3>
        </div>

        @php
            $emiratesId = json_decode($users->File1, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a  href="{{ asset('storage' .$file['download_link']) }}">
                        Download
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File1 }}</span>
            <br>
        @endif
       
            <hr style="margin:0;">

                  

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">File2</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
           
        @php
            $emiratesId = json_decode($users->File2, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
                        Download
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File2 }}</span>
            <br>
        @endif
       


        </div><!-- panel-body -->


        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">File3</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
           
        @php
            $emiratesId = json_decode($users->File3, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
                        Download
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File3 }}</span>
            <br>
        @endif
       


        </div><!-- panel-body -->



        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">File4</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
           
        @php
            $emiratesId = json_decode($users->File4, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
                        Download
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File4 }}</span>
            <br>
        @endif
       


        </div><!-- panel-body -->



        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">File5</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
           
        @php
            $emiratesId = json_decode($users->File5, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
                        Download
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File5 }}</span>
            <br>
        @endif
       


        </div><!-- panel-body -->



        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">File6</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
           
        @php
            $emiratesId = json_decode($users->File6, true); // Decode the JSON string into an array
        @endphp

        @if (is_array($emiratesId))
            @foreach($emiratesId as $file)
            <div class="panel-body" style="padding-top:0;">
            <a href="{{ asset('storage' .$file['download_link']) }}">
                        Download
                    </a>
            </div><!-- panel-body -->
              
            @endforeach
        @else
            <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
            <span style="color:blue;font-weight:bold;">{{ $users->File6 }}</span>
            <br>
        @endif
       


        </div><!-- panel-body -->

        <hr style="margin:0;">
        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Purchase On</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
            <p>{{$users->created_at}}</p>
        </div><!-- panel-body -->

</div>
</div>



      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
