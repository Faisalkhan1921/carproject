
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

<h1 class="text-center" style="color:black;">{{$user_name}} Weekly Progress</h1>
    <h2 class="text-center" style="color:black;">From {{ $start_of_week }} to {{ $end_of_week }}</h2>
    <div class="row mb-2">
<div class="col-md-6">
<a href="{{route('admin.assignplan.daily_routine',$user_id)}}" class="btn btn-primary">Daily Progress</a>
<a href="{{route('admin.routine.weekly_progress',$user_id)}}" class="btn btn-warning">Weekly Progress</a>
<a href="{{route('admin.routine.monthly_progress',$user_id)}}" class="btn btn-success">Monthly Progress</a>
</div>
</div>
    <div class="calendar">
    @foreach($daily_progress as $date => $progress)
    <div class="calendar__cell" data-bs-toggle="modal" data-bs-target="#exampleModal{{$date}}" style="cursor: pointer;">
            <div class="calendar__day">
                <div style="color:white;">{{ Carbon\Carbon::parse($date)->day }}</div>
                <div class="calendar__day-name" style="color:white;">{{ Carbon\Carbon::parse($date)->format('l') }}</div>
            </div>
            <div class="progressbar">
                <svg class="progressbar__svg">
                    <circle cx="80" cy="80" r="70" class="progressbar__svg-circle shadow-html" style="--percentage: {{ $progress['warmup'] }}"></circle>
                    <circle cx="80" cy="80" r="60" class="progressbar__svg-circle2 shadow-html2" style="--percentage: {{ $progress['cooldown'] }}"></circle>
                    <circle cx="80" cy="80" r="50" class="progressbar__svg-circle3 shadow-html3" style="--percentage: {{ $progress['cardio'] }}"></circle>
                    <circle cx="80" cy="80" r="40" class="progressbar__svg-circle4 shadow-html4" style="--percentage: {{ $progress['routine'] }}"></circle>
                </svg>
    
    <span class="progressbar__text shadow-html">Day Progress</span>

            </div>
        </div>
       


<!-- Modal for each day -->
<div class="modal fade" id="exampleModal{{$date}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$date}}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel{{$date}}">Progress for {{ $date }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <!-- Warmup Progress -->
                    <div class="col-md-12">
                        <h5 class="text-dark">Warmup Progress</h5>
                        <div class="progress">
                            <div class="progress-bar bg-warning progress-bar-animated" role="progressbar" style="width: {{$progress['warmup']}}%;" aria-valuenow="{{$progress['warmup']}}" aria-valuemin="0" aria-valuemax="100">{{$progress['warmup']}}%</div>
                        </div>
                    </div>
                    <!-- Workout Progress -->
                    <div class="col-md-12">
                        <h5 class="text-dark">Workout Progress</h5>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-animated" role="progressbar" style="width: {{$progress['routine']}}%;" aria-valuenow="{{$progress['routine']}}" aria-valuemin="0" aria-valuemax="100">{{$progress['routine']}}%</div>
                        </div>
                    </div>
                    <!-- Cardio Progress -->
                    <div class="col-md-12">
                        <h5 class="text-dark">Cardio Progress</h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-animated" role="progressbar" style="width: {{$progress['cardio']}}%;" aria-valuenow="{{$progress['cardio']}}" aria-valuemin="0" aria-valuemax="100">{{$progress['cardio']}}%</div>
                        </div>
                    </div>
                    <!-- Cooldown Progress -->
                    <div class="col-md-12">
                        <h5 class="text-dark">Cooldown Progress</h5>
                        <div class="progress">
                            <div class="progress-bar bg-info progress-bar-animated" role="progressbar" style="width: {{$progress['cooldown']}}%;" aria-valuenow="{{$progress['cooldown']}}" aria-valuemin="0" aria-valuemax="100">{{$progress['cooldown']}}%</div>
                        </div>
                    </div>
                    <!-- Overall Progress -->
                    <div class="col-md-12">
                        <hr>
                        <h5 class="text-dark">Overall Progress</h5>
                        <div class="progress">
                            <div class="progress-bar bg-dark progress-bar-animated" role="progressbar" style="width: {{$progress['overall']}}%;" aria-valuenow="{{$progress['overall']}}" aria-valuemin="0" aria-valuemax="100">{{$progress['overall']}}%</div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    @endforeach




    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection