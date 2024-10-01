
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="container-fluid">

<style>
        body {
            background-color: white;
            color: black;
        }
        * {
            box-sizing: border-box;
        }
        .container1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: hsl(0, 0%, 5%);
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(5, 0.5fr);
            gap: 0.2em;
        }
        .calendar__cell {
            position: relative;
            background-color: hsl(0, 0%, 15%);
            border-radius: 0.5em;
            height: 220px;
            width: 190px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .progressbar {
            position: relative;
            width: 180px;
            transform: rotate(-90deg);
        }
        .progressbar__svg {
            width: 180px;
            height: 160px;
            padding: 0;
            margin: 0;
        }
        .progressbar__svg-circle,
        .progressbar__svg-circle2,
        .progressbar__svg-circle3,
        .progressbar__svg-circle4 {
            fill: none;
            stroke-width: 4;
            stroke-linecap: round;
            transform: translate(5px, 5px); 
            stroke-dasharray: var(--circumference);
            stroke-dashoffset: calc(var(--circumference) * (1 - var(--percentage) / 100));
            animation: anim_circle-html 3s ease-in-out backwards;
        }
        .progressbar__svg-circle {
            stroke: hsl(0, 48%, 54%);
            --circumference: 440;
            animation-delay: 0s;
        }
        .progressbar__svg-circle2 {
            stroke: hsl(75, 78%, 44%);
            --circumference: 377;
            animation-delay: 0.5s;
        }
        .progressbar__svg-circle3 {
            stroke: hsl(4, 89%, 38%);
            --circumference: 314;
            animation-delay: 1s;
        }
        .progressbar__svg-circle4 {
            stroke: hsl(216, 5%, 81%);
            --circumference: 251;
            animation-delay: 1.5s;
        }
        @keyframes anim_circle-html {
            0% {
                stroke-dashoffset: var(--circumference);
            }
            100% {
                stroke-dashoffset: calc(var(--circumference) * (1 - var(--percentage) / 100));
            }
        }
        .shadow-html {
            filter: drop-shadow(0 0 5px hsl(63, 92%, 42%));
        }
        .shadow-html2 {
            filter: drop-shadow(0 0 5px hsl(0, 73%, 3%));
        }
        .shadow-html3 {
            filter: drop-shadow(0 0 5px hsl(0, 100%, 100%));
        }
        .shadow-html4 {
            filter: drop-shadow(0 0 5px hsl(0, 100%, 100%));
        }
        .progressbar__text {
            position: absolute;
            top: 50%;
            left: 50%;
            padding: 0.25em 0.5em;
            color: hsl(0, 0%, 100%);
            font-family: Arial, Helvetica, sans-serif;
            border-radius: 0.25em;
            transform: translate(-50%, -50%) rotate(90deg);
        }
        .calendar__day {
            text-align: center;
            color: hsl(0, 0%, 90%);
            margin-bottom: 5px;
        }
        .calendar__day-name {
            font-size: 0.9em;
            color: hsl(0, 0%, 70%);
        }

        @media (max-width: 480px) {
            .calendar {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5em;
            }
            /* .calendar__cell {
                height: 220px;
                width: 190px;
            }
            .progressbar {
                width: 120px;
            }
            .progressbar__svg {
                width: 120px;
                height: 100px;
            } */
        }
    </style>


<h1 style="text-align: center;color:black;">{{$user_name}} Daily Progress</h1>
    <h2 class="text-center " style="text-align: center;color:black;">{{$current_date}} Progress</h2>
    <div class="row">
<div class="col-md-6">
<a href="{{route('admin.assignplan.daily_routine',$user_id)}}" class="btn btn-primary">Daily Progress</a>
<a href="{{route('admin.routine.weekly_progress',$user_id)}}" class="btn btn-warning">Weekly Progress</a>
<a href="{{route('admin.routine.monthly_progress',$user_id)}}" class="btn btn-success">Monthly Progress</a>
</div>
</div>
    @if ($data) <!-- Check if there's data for the current date -->
        <div class="calendar__cell" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;">
            <div class="calendar__day">
                <div style="color:white;" >{{ Carbon\Carbon::parse($current_date)->day }}</div>
                <div class="calendar__day-name " style="color:white;">{{ Carbon\Carbon::parse($current_date)->format('l') }}</div>
            </div>
            <div class="progressbar" >
                <svg class="progressbar__svg">
                    <circle cx="80" cy="80" r="70" class="progressbar__svg-circle shadow-html" style="--percentage: {{ $data->circle1_percentage }}"></circle>
                    <circle cx="80" cy="80" r="60" class="progressbar__svg-circle2 shadow-html2" style="--percentage: {{ $data->circle2_percentage }}"></circle>
                    <circle cx="80" cy="80" r="50" class="progressbar__svg-circle3 shadow-html3" style="--percentage: {{ $data->circle3_percentage }}"></circle>
                    <circle cx="80" cy="80" r="40" class="progressbar__svg-circle4 shadow-html4" style="--percentage: {{ $data->circle4_percentage }}"></circle>
                </svg>
                <span class="progressbar__text shadow-html">{{ $data->title }}</span>
            </div>
        </div>
    @else
    <div class="col-md-12 text-danger text-center">
        No Record Available
    </div>
    @endif
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Daily {{$user_name}}'s Plan Progress</h5>
        <!-- <button type="button" class="btn-danger" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
    <div class="row">
        <!-- =================== warmup progress =================== -->
        <div class="col-md-12">
            <h5 class="text-dark">Warmup Progress</h5>
            <div class="progress">
                <div class="progress-bar bg-warning progress-bar-animated" role="progressbar" style="width: {{$final_warmup_p}}%;" aria-valuenow="{{$final_warmup_p}}" aria-valuemin="0" aria-valuemax="100">{{$final_warmup_p}}%</div>
            </div>
        </div>
        <!-- ======================= Workout Progress ================== -->
        <div class="col-md-12">
            <h5 class="text-dark">Workout Progress</h5>
            <div class="progress">
                <div class="progress-bar bg-success progress-bar-animated" role="progressbar" style="width: {{$routine_p}}%;" aria-valuenow="{{$routine_p}}" aria-valuemin="0" aria-valuemax="100">{{$routine_p}}%</div>
            </div>
        </div>
        <!-- ======================== Cardio Progress ===================== -->
        <div class="col-md-12">
            <h5 class="text-dark">Cardio Progress</h5>
            <div class="progress">
                <div class="progress-bar bg-danger progress-bar-animated" role="progressbar" style="width: {{$final_cardio_p}}%;" aria-valuenow="{{$final_cardio_p}}" aria-valuemin="0" aria-valuemax="100">{{$final_cardio_p}}%</div>
            </div>
        </div>
        <!-- ============================ Cooldown Progress ==================== -->
        <div class="col-md-12">
            <h5 class="text-dark">Cooldown Progress</h5>
            <div class="progress">
                <div class="progress-bar bg-info progress-bar-animated" role="progressbar" style="width: {{$final_cooldown_p}}%;" aria-valuenow="{{$final_cooldown_p}}" aria-valuemin="0" aria-valuemax="100">{{$final_cooldown_p}}%</div>
            </div>
        </div>

        <!-- <hr><hr> -->
         <div class="col-md-12">
            <hr>
         </div>

        <div class="col-md-12 mt-2">
            <h5 class="text-dark">Overall Progress</h5>
            <div class="progress">
                <div class="progress-bar bg-dark progress-bar-animated" role="progressbar" style="width: {{$final_daily_overall}}%;" aria-valuenow="{{$final_daily_overall}}" aria-valuemin="0" aria-valuemax="100">{{$final_daily_overall}}%</div>
            </div>
        </div>
    </div>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection