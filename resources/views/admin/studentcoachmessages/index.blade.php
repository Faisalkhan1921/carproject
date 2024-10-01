@extends('admin.admin_master')

@section('admin_content')

                    
                        <div class="container" style="margin-top: 40px;">
                            <div class="row">                      
                                <!-- start of col 1 -->
                                 

                            <!-- end of col1 -->

                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                            <!-- start of col 2 -->
                       
                                    
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="text-center">Student Coach Messages</h3>
                                        </div>
                                     
                                        <div class="card-body">
                                         
                                        
                                            
                                            <div class="row m-auto">
                                            @foreach($faculty as $item)
                                            @php 
                                            $messages = App\Models\StudentCoachesMessages::where('coach_id', $item->id)
                                            ->with('reg_userss')  // Eager load the faculty
                                            ->selectRaw('MAX(id) as id')  // Get the most recent message by id
                                            ->groupBy('student_id')  // Group by coach
                                            ->get()
                                            ->map(function ($message) {
                                                return App\Models\StudentCoachesMessages::find($message->id);  // Get the full message model for the most recent message
                                            });
                                            if($messages)
                                            {
                                                $counter = count($messages);
                                            }
                                            @endphp
                                           <center>
                                           <div class="col-md-12 " style=" ">
                                                <div class="card" style="border:1px solid gray; margin-bottom:12px;border-radius:12px; box-shadow: 10px 4px 8px rgba(42, 54, 59, 0.4); ">
                                                    <div class="card-header " style="background-color:#F9F9F9;color:black;">
                                                        <h4 class="text-center">
                                                            {{$item->name}}
                                                        </h4>

                                                    </div>

                                                    <div class="card-body" style="background-color: #F9F9F9;">

                                                        <center>
                                                            @if($counter == 0)
                                                            <p>New Chat Initialized [{{$counter}}]</p>
                                                            @else 
                                                            <p style="color:red;font-weight:bold;">New Chat Initialized [{{$counter}}]</p>

                                                            @endif
                                                            <a href="{{route('admin.messages.inbox',$item->id)}}" class="btn btn-primary">View Chat</a>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                           </center>
                                            @endforeach
                                        </div>
            





                                        </div>
                                    </div>
                                </div>
                            <!-- end of col 2 -->
                            </div>
                        </div>

                      
@endsection