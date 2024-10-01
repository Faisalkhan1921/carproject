@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

                    <div class="side-body padding-top">
                        @yield('page_header')
                        <div class="container" style="margin-top: 40px;">
                            <div class="row">                      
                                <!-- start of col 1 -->
                                 

                            <!-- end of col1 -->

                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                            <!-- start of col 2 -->
                       
                                    
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="text-center"> Messages View
                                                <a href="{{url('admin/studentcoachmessages')}}" class="btn btn-warning float-right">Return to List</a>
                                            </h3>
                                        </div>
                                     
                                        <div class="card-body">
                                         
                                        
                                        <div style="height: 400px; overflow-y: auto;">
                        @foreach($data as $item)
                            @php
                                // Parse the created_at timestamp into a Carbon instance
                                $createdAt = \Carbon\Carbon::parse($item->created_at);
                                
                                // Get today's date in the same format for comparison
                                $today = \Carbon\Carbon::today();
                                
                                // Determine if the message was sent today, yesterday, or another day
                                if ($createdAt->isToday()) {
                                    $formattedTime = $createdAt->format('h:i A'); // Format like 09:30 PM
                                    $timeDisplay = 'Today, ' . $formattedTime;
                                } elseif ($createdAt->isYesterday()) {
                                    $formattedTime = $createdAt->format('h:i A'); // Format like 09:30 PM
                                    $timeDisplay = 'Yesterday, ' . $formattedTime;
                                } else {
                                    $timeDisplay = $createdAt->isoFormat('YYYY-MMMM-DD, h:mm A'); // Format like 2024-July-10, 09:30 PM
                                }
                            @endphp

                            @if($item->st_sent == 1)
                                <div style="text-align: left; margin-bottom: 10px;">
                                @if($item->st_softDelete == 1 && $item->fac_softDelete == 1)
    <span style="background-color: #f0f0f0;  padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }}    <i class="fa-regular fa-trash-can" style="margin-left:3px;color:green;font-weight:bold;"></i>
    </span>
@elseif($item->st_softDelete == 1)
    <span style="background-color: #f0f0f0;  padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }}    <i class="fa-regular fa-trash-can" style="margin-left:3px;color:gray;font-weight:bold;"></i>
    </span>
@elseif($item->fac_softDelete == 1)
    <span style="background-color: #f0f0f0;padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }}    <i class="fa-regular fa-trash-can" style="margin-left:3px;color:blues;font-weight:bold;"></i>
    </span>
@else 
    <span style="background-color: #f0f0f0; padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }}    <i class="fa-regular fa-trash-can" style="margin-left:3px;color:black;font-weight:bold;"></i>
    </span>
@endif

                                    <br>
                                    <span style="font-size: 0.8em; color: #999;">{{ $timeDisplay }}</span>
                                    
                                </div>
                            @elseif($item->fac_sent == 1)
                                <div style="text-align: right; margin-bottom: 10px;">
                                @if($item->st_softDelete == 1 && $item->fac_softDelete == 1)
    <span style="background-color: #f0f0f0;  padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }} <i class="fa-regular fa-trash-can" style="margin-left:3px;color:green;font-weight:bold;"></i>
    </span>
@elseif($item->st_softDelete == 1)
    <span style="background-color: #f0f0f0; padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }} <i class="fa-regular fa-trash-can" style="margin-left:3px;color:gray;font-weight:bold;"></i>
    </span>
@elseif($item->fac_softDelete == 1)
    <span style="background-color: #f0f0f0; padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }}  <i class="fa-regular fa-trash-can" style="margin-left:3px;color:blue;font-weight:bold;"></i>
    </span>
@else 
    <span style="background-color: #f0f0f0;  padding: 5px; border-radius: 10px; display: inline-block; max-width: 80%; word-wrap: break-word;">
        {{ $item->message }}  <i class="fa-regular fa-trash-can" style="margin-left:3px;color:black;font-weight:bold;"></i>
    </span>
@endif

                                    <br>
                                    
                                    <span style="font-size: 0.8em; color: #999;">{{ $timeDisplay }}</span>
                                    <!-- Checkbox for selecting messages -->
                                   
                                 
                                </div>
                            @endif
                        @endforeach
                    </div>





                                        </div>
                                    </div>
                                </div>
                            <!-- end of col 2 -->
                            </div>
                        </div>
                        <div id="voyager-notifications"></div>
                        @yield('content')
                    </div>
                </div>
@endsection