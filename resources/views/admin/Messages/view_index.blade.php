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

<a href="{{route('admin.message.index')}}" class="btn btn-warning">Return to List</a>
   
</h1>


      <div class="row mt-5" >
      


      <div class="col-md-12">

<div class="panel panel-bordered" style="padding-bottom:5px;">
    <!-- form start -->

    
     <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">First Name</h3>
            </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->fname}}</p>
        </div><!-- panel-body -->
                                    <hr style="margin:0;">

             <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Last Name</h3>
            </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->lname}}</p>
        </div><!-- panel-body -->
                                    <hr style="margin:0;">
                                                                            <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Email</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">

                                                                            <p>{{$users->email}}</p>
                                    </div><!-- panel-body -->
                                    <hr style="margin:0;">
                                                                            <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Phone</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">

                                                                            <p>{{$users->phone}}</p>
                                    </div><!-- panel-body -->
                                    <hr style="margin:0;">
                                                                           

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Age</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->age}}</p>
        </div><!-- panel-body -->
         <hr style="margin:0;">

         <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Weight</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->weight}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Height</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->height}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

               <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Gender</h3>
            </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->gender}}</p>
        </div><!-- panel-body -->
          <hr style="margin:0;">
        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Stay Active</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->stay_active}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">
             <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Be Fit</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
              <p>{{$users->be_fit}}</p>
         </div><!-- panel-body -->
            <hr style="margin:0;">

            <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Build Muscles</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->build_muscles}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Lose Fat</h3>
        </div>
    <div class="panel-body" style="padding-top:0;">
        <p>{{$users->lose_fat}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

         <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Lose Weight</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->lose_weight}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Athletic Competition</h3>
        </div>
    <div class="panel-body" style="padding-top:0;">
        <p>{{$users->athletic_competition}}</p>
        </div><!-- panel-body -->
             <hr style="margin:0;">

             <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Goal Seriousness(Rating)</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
    <p>{{$users->goal_seriousness}}</p>
    </div><!-- panel-body -->
    <hr style="margin:0;">

    <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Days Of Training</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->training_days}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

          <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Cravings</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->cravings}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">


        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Medical Condition</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->medical_condition}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">


        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Comments</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->comments}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">


        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Current Package</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
            @php 
            $pckg = App\Models\Package::where('id',$users->package_id)->first();
            $pckg_title = $pckg->title;
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
            <h3 class="panel-title">Time Of Registration</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
            <p>{{$users->created_at}}</p>
        </div><!-- panel-body -->
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

</div>
</div>



      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
