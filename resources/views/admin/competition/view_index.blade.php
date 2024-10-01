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
Viewing Competition Entry

<a href="{{route('admin.comp.index')}}" class="btn btn-warning">Return to List</a>
   
</h1>


      <div class="row mt-5" >
      
      <div class="col-md-12">

<div class="panel panel-bordered" style="padding-bottom:5px;">
    <!-- form start -->

  
    <hr style="margin:0;">



        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Name</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->name}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">


          <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Email</h3>
        </div>

       
     
            <div class="panel-body" style="padding-top:0;">
            <p>{{$users->email}}</p>
        
                        <br>
        </div><!-- panel-body -->
             
          
       
      
      

        <hr style="margin:0;">
          <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Phone</h3>
        </div>

       
     
            <div class="panel-body" style="padding-top:0;">
            <p>{{$users->phone}}</p>
        
                        <br>
        </div><!-- panel-body -->
             
      
        <hr style="margin:0;">
          <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Answer</h3>
        </div>

       
     
            <div class="panel-body" style="padding-top:0;">
            <p>{{$users->answer}}</p>
        
                        <br>
        </div><!-- panel-body -->
             

        <hr style="margin:0;">
          <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Carousel</h3>
        </div>

       
     
            <div class="panel-body" style="padding-top:0;">
            @php 
                                    $message = App\Models\Carousel::where('id',$users->carousel_id)->first();
                                    if($message)
                                    {
                                        $title = $message->title;
                                    }
                                    else 
                                    {
                                        $title = 'N/A';
                                    }

                                     @endphp
            <p>{{$title}}</p>
        
                        <br>
        </div><!-- panel-body -->
             


</div>
</div>



      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
