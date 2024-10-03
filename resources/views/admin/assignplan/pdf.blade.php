<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Timetable - Fh Fighters</title>

    <link rel="shortcut icon" href="{{ public_path('assets/favicon_io/favicon.ico') }}" type="image/x-icon">

    <style>
        body {
            overflow-x: hidden;
            font-family: 'Raleway', sans-serif;
        }

        .module-title {
            font-weight: bold;
            font-size: 30px;
        }

        .module-subtitle {
            font-size: 18px;
            font-style: italic;
            font-weight: 700;
            line-height: 1.5;
        }

        .routine-img {
            aspect-ratio: 1/1 !important;
            object-fit: contain;
        }

        .exercise-column {
            border-left: 3px solid #FFC000;
        }

        .exercise-column::before {
            content: '';
            position: relative;
            /* bottom: -335px;
            left: -238px; */
            bottom: 0px;
            left: 0px;
            width: 16px;
            height: 16px;
            background-color: #FFC000;
            border-radius: 50%;
        }

        .exercise-title {
            background: #f4f4f4;
        }

        .routine-exercise-name {
            background-color: #f4f4f4;
        }

        .routine-img {
            aspect-ratio: 1/0.5;
            object-fit: contain;
            width: 90px;
        }

        /* .routine-row, */
        .routine-row-parent {
            border-left: 3px solid #FFC000;
        }

        .routine-row::before {
            content: '';
            position: relative;
            /* bottom: -28px;
            left: -41px; */
            bottom: 0px;
            left: 0px;
            width: 16px;
            height: 13px;
            background-color: #FFC000;
            border-radius: 50%;
        }

        table {
            border-collapse: collapse;
        }

        table thead tr th {
            padding: 20px 20px;
        }

        table tbody tr td {
            padding: 10px;
            text-align: center;
        }
    </style>

</head>

<body>

    <section class="exercises" style="padding-top:0.5rem;padding-bottom:0.5rem">

        <div style="display: flex;justify-content:center;margin-top: 0.75rem;">
            <div style="text-align: center;margin: 0 auto;">
         <img src="{{asset('sitelogo/logo.png')}}" width="80px" height="80px" alt="">
                {{-- <img src="{{ asset('/assets/logo.png') }}" alt="" class="logo" width="150px"> --}}
                <h1>FH FIGHTERS</h1>
            </div>
        </div>

        <div style="margin: 0 auto">
            <table border="1" style="margin: 0 auto;">

                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Age</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Height</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>{{ $user->fname }}</th>
                        <td>{{ $user->lname }}</td>
                        <td style="padding: 0 20px">{{ $user->email }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->weight }}</td>
                        <td>{{ $user->height }}</td>
                    </tr>
                </tbody>

            </table>
        </div>

    </section>
</body>



<body>
    <section class="exercises" style="padding-top: 0.5rem; padding-bottom: 0.5rem">
        <div style="display: flex; justify-content: center; margin-top: 0.75rem;">
            <div style="text-align: center; margin: 0 auto;">
         <img src="{{asset('sitelogo/logo.png')}}" width="80px" height="80px" alt="">
            </div>
        </div>

        <div style="width: 100%; margin: 0 auto; display: flex; flex-direction: column;">

            <!-- Title -->
            <div style="padding-top: 0.5rem; padding-bottom: 0.5rem; color: white; text-align: center; background: #FFC000;">
                <div class="module-title">
                    Warmup
                </div>
                <div class="module-subtitle">
                    {{ $user->warmup_subtitle }}
                </div>
            </div>

            <!-- Exercises -->
            <div style="display: flex; width: 100%; margin-top: 3rem; flex-direction: column; align-items: center;">

                @forelse ($warmup as $warm)
                    @php 
                        $warmup_rec = App\Models\UserAllotedModule::where('id', $warm->warnup_id)->first();
                        if($warmup_rec) {
                            $title = $warmup_rec->title;
                        }

                        $exercise_ids = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $warm->warnup_id)->pluck('exercise_id')->toArray();
                        $exercises = App\Models\Exercise::whereIn('id', $exercise_ids)->orderByRaw('FIELD(id, ' . implode(',', $exercise_ids) . ') asc')->get();
                    @endphp

                    <div class="exercise-column" style="padding-left: 0.75rem; padding-right: 0.75rem; float: left; width: 40%; padding-bottom: 30px;">
                        @foreach($exercises as $exercise)
                            <div style="text-align: center; width: 120px; height: 86px; overflow: hidden; margin: 0 auto;">
                                <img class="module-img" src="{{ isset($exercise) ? asset('storage/'.$exercise->exercise_image) : asset('storage/default_image.jpg') }}" alt="Exercise Image" style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                            <div class="exercise-title" style="padding-top: 0.3rem; padding-bottom: 1rem; margin-top: 0.5rem; width: 100%; text-align: center;">
                                <p style="margin-bottom: 0;">{{ $exercise->title }}</p>
                            </div>
                        @endforeach
                    </div>

                    @if ($loop->index % 2 == 0)
                        <div style="width: 10%; float: left;"></div>
                    @else
                        <div style="clear: both;"></div>
                    @endif

                @empty
                    <div class="text-center">
                        <div class="fst-italic" style="color: #dadada">
                            <h5 class="fw-semibold">No Data Found</h5>
                        </div>
                    </div>
                @endforelse

            </div>

        </div>

    </section>
</body>
{{-- Modules --}}



   <style>
        

        .logo-container {
            display: flex;
            justify-content: center;
            margin-top: 0.75rem;
        }

        .logo-container img {
            width: 80px;
            height: 80px;
        }

        .module-title {
            font-weight: bold;
            font-size: 30px;
        }

        .routine-section {
            width: 90%;
            max-width: 800px;
            padding: 1.25rem 0;
            background: #ffffff;
            margin: 1rem 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .routine-section .header {
            padding: 1rem;
            background-color: #0e0e0e;
            color: white;
            text-align: center;
        }

        .routine-section .routine-row-parent {
            margin-top: 40px;
            padding-top: 10px;
            display: flex;
            flex-direction: column;
            border-top: 1px solid #ddd;
        }

        .routine-section .routine-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .routine-section .routine-row:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .routine-section .routine-exercise-title {
            text-align: left;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .routine-section .routine-exercise-name {
            text-align: center;
            width: 100%;
            font-weight: bold;
            padding: 0.75rem 0;
            background-color: #ffc000;
            color: white;
            border-radius: 5px;
            margin-bottom: 0.25rem;
        }

        .routine-section .routine-exercise-details {
            font-style: italic;
            font-size: 13px;
            display: flex;
            justify-content: space-around;
        }

        .routine-section .routine-img {
            margin-left: 30px;
            width: 50px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>


<body>

@foreach ($routine as $item)
    <section class="routine-section">
        <!-- Logo and header for routine -->
        <div class="logo-container">
            <center>
                <img src="{{ asset('sitelogo/logo.png') }}" alt="Logo">
            </center>
        </div>
        <div class="header">
            <div class="module-title">
                {{ $item->title }}
            </div>
        </div>

        <!-- Display routine workouts -->
        @php 
            $routine_workout = App\Models\CustomerRoutineWorkouts::where('routine_id',$item->id)->get();
        @endphp
        @foreach ($routine_workout as $RoutineExercise)
            @php 
                $exercise = App\Models\Exercise::where('id',$RoutineExercise->exercise_id)->first();
                if($exercise)
                {
                    $title = $exercise->title;
                    $image = $exercise->exercise_image;
                }
            @endphp
            <div class="routine-row-parent">
                <div class="routine-row">
                    <div style="flex: 1;">
                        <div class="routine-exercise-title">
                            {{ $RoutineExercise->title }}
                        </div>
                        <div class="routine-exercise-name" style="background-color:#E5E5E5;color:black;font-weight:bold;">
                            {{ $title }}
                        </div>
                        <div style="display: flex; justify-content: space-around; width: 100%; text-align: center;">
                            <div>
                                <p style="margin-bottom: 0;">Weight [KG]</p>
                                <input type="text" value="{{ $RoutineExercise->weight ? $RoutineExercise->weight : 'N/A' }}">
                            </div>
                            <div>
                                <p style="margin-bottom: 0;">Repetition</p>
                                <input type="text" value="{{ $RoutineExercise->repetitions ? $RoutineExercise->repetitions : 'N/A' }}">
                            </div>
                            <div>
                                <p style="margin-bottom: 0;">Work Duration [s]</p>
                                <input type="text" value="{{ $RoutineExercise->workout_duration ? $RoutineExercise->workout_duration : 'N/A' }}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <center>
                            <img src="{{ asset('/storage/' . $image) }}" class="routine-img" alt="Exercise Image" style="width:200px;text-align:center;">
                        </center>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Display cardio workouts related to this routine -->
        @php 
            $cardio = App\Models\Cardio::where('user_id',$user_id)->get();
        @endphp
        @foreach($cardio as $cardio_item)
            @php 
                $cardio_model = App\Models\CardioModel::findOrFail($cardio_item->cardio_id);
                $title_cardio = $cardio_model->title;
                $cardio_workouts = App\Models\CardioWorkout::where('cardio_id',$cardio_item->cardio_id)->get();
            @endphp
            <div class="header">
                <div class="module-title">
                    Cardio 
                </div>
            </div>
            @foreach ($cardio_workouts as $cardioexercise)
                @php 
                    $exercise = App\Models\Exercise::where('id',$cardioexercise->exercise_id)->first();
                    if($exercise)
                    {
                        $title = $exercise->title;
                        $image = $exercise->exercise_image;
                    }
                @endphp
                <div class="routine-row-parent">
                    <div class="routine-row">
                        <div style="flex: 1;">
                        <div class="routine-exercise-title">
                            {{ $title_cardio }}
                        </div>
                        <div class="routine-exercise-name" style="background-color:#E5E5E5;color:black;font-weight:bold;">
                            {{ $title }}
                        </div>
                           
                            <div class="routine-exercise-details">
                                Duration: {{ $cardioexercise->workout_duration }}
                            </div>
                        </div>
                        <div>
                            <center>
                                <img src="{{ asset('/storage/' . $image) }}" class="routine-img" alt="Exercise Image" style="width:200px;text-align:center;">
                            </center>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </section>
@endforeach

</body>

<body>
    <section class="exercises" style="padding-top: 0.5rem; padding-bottom: 0.5rem">
        <div style="display: flex; justify-content: center; margin-top: 0.75rem;">
            <div style="text-align: center; margin: 0 auto;">
                <img src="{{ asset('sitelogo/logo.png') }}" width="80px" height="80px" alt="">
            </div>
        </div>

        <div style="width: 100%; margin: 0 auto; display: flex; flex-direction: column;">

            <!-- Title -->
            <div style="padding-top: 0.5rem; padding-bottom: 0.5rem; color: white; text-align: center; background: #FFC000;">
                <div class="module-title">
                    Cool Down
                </div>

                <div class="module-subtitle">
                    {{ $user->cooldown_subtitle }}
                </div>
            </div>

            <!-- Exercises -->
            <div style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 3rem; ;">

                @if ($cooldown->isEmpty())
                    <div class="text-center">
                        <div class="fst-italic" style="color: #dadada">
                            <h5 class="fw-semibold">No Data Found</h5>
                        </div>
                    </div>
                @else
                    @foreach ($cooldown as $warm)
                        @php 
                            $warmup_rec = App\Models\UserAllotedModule::where('id', $warm->cooldown_id)->first();
                            if ($warmup_rec) {
                                $title = $warmup_rec->title;
                            }

                            $exercise_ids = App\Models\ModuleLibraryPivot::where('user_allotted_module_id', $warm->cooldown_id)->pluck('exercise_id')->toArray();
                            $exercises = App\Models\Exercise::whereIn('id', $exercise_ids)->orderByRaw('FIELD(id, ' . implode(',', $exercise_ids) . ') asc')->get();
                        @endphp

                            @foreach ($exercises as $exercise)
                        <div class="exercise-column" style="padding: 0.75rem; width: 40%; flex: 2  auto;">
                                <div style="text-align: center; width: 120px; height: 86px; overflow: hidden; margin-bottom: 1rem;">
                                    <img class="module-img" src="{{ isset($exercise) ? asset('storage/'.$exercise->exercise_image) : asset('storage/default_image.jpg') }}" alt="Exercise Image" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div class="exercise-title" style="padding-top: 0.3rem; padding-bottom: 1rem; text-align: center;">
                                    <p style="margin-bottom: 0;">{{ $exercise->title }}</p>
                                </div>
                        </div>
                            @endforeach

                    @endforeach
                @endif

            </div>

        </div>

    </section>
</body>


</html>
