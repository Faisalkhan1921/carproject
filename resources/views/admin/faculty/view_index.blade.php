@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

    <!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
    <i class="fas fa-id-badge text-dark"></i>    
    Add Faculty Records

    
    </h1> -->


      <div class="row mt-5">
        <div class="col-md-12 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-id-badge text-dark"></i>    
                            Viewing Faculty Records
                            <a href="{{route('admin.faculty.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                        
                        <!-- =============================== start of view data ================================ -->


                        <div class="row">
                           



                           <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
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
        </div><!-- panel-body -->
        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Position</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->position}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Nationality</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->nationality}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">
       

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Address</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->address}}</p>
        </div><!-- panel-body -->
         <hr style="margin:0;">

         <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Real Password</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->real_password}}</p>
        </div><!-- panel-body -->
        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Date of Birth</h3>
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
            <h3 class="panel-title">Phone Number</h3>
        </div>
    <div class="panel-body" style="padding-top:0;">
        <p>{{$users->phone_number}}</p>
        </div><!-- panel-body -->
             <hr style="margin:0;">

   

            <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Registration Date</h3>
        </div>
        <div class="panel-body" style="padding-top:0;">
        {{$users->created_at}}
        </div><!-- panel-body -->
        <hr style="margin:0;">
            
            <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">T-Shirt Size</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->t_shirt}}</p>
        </div><!-- panel-body -->
        
        
         <hr style="margin:0;">
            
            <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Exp Date</h3>
        </div>

        <div class="panel-body" style="padding-top:0;">
        <p>{{$users->exp_date}}</p>
        </div><!-- panel-body -->
        
        
        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Qrcode</h3>
        </div>

     
        <div class="panel-body" style="padding-top:0;">      
            <a href="{{asset('storage/' .$users->qrcode)}}"><img src="{{asset('storage/' .$users->qrcode)}}" ></a>
        </div>


        <hr style="margin:0;">

        <div class="panel-heading" style="border-bottom:0;">
            <h3 class="panel-title">Profile Image</h3>
        </div>


        <div class="panel-body" style="padding-top:0;">      
            <a href="{{asset('storage/' .$users->image_path)}}"><img src="{{asset('storage/' .$users->image_path)}}" width="100px" height="100px"></a>
        </div>
        <!-- <img src="{{asset('$users->qrcode')}}" alt=""> -->
                            
          
</div>
</div>










                           </div>



                        <!-- ==================================== end of view data ====================================== -->


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
            placeholder: "Select User",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select3').select2({
            placeholder: "Select Package",
            allowClear: true
        });
    });
</script>

@endsection
