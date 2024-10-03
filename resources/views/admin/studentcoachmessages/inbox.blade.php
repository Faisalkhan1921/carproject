@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

                    <div class="side-body padding-top">
                      
                        <div class="container" style="margin-top: 40px;">
                            <div class="row">                      
                                <!-- start of col 1 -->
                                 

                            <!-- end of col1 -->

                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                            <!-- start of col 2 -->
                       
                                    
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="text-center">Inbox Chat

                                            <a href="{{url('admin/studentcoachmessages')}}" class="btn btn-warning float-right">Return to List</a>
                                            </h3>
                                        </div>
                                     
                                        <div class="card-body">
                                         
                                        
                 <input type="text" id="searchInput" placeholder="Search by name..." class="form-control" style="margin-bottom: 10px; border:1px solid gray;">

<div style="height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;" id="facultyList">
    
@if($messages->isEmpty())
                 <center>
                    <div>

                        <h3 class="text-danger" style="color:red;">No Chat Found</h3>
                    </div>
                 </center>
    @else
@foreach($messages as $item)
    @php
        $faculty = $item->reg_userss;  // Access the preloaded faculty data
       
        $name = $faculty->name;
        $lastMessage = strlen($item->message) > 100 ? substr($item->message, 0, 100) . '...' : $item->message;
        $image = $faculty->image_path ?? 'https://www.pngall.com/wp-content/uploads/5/Profile-PNG-File.png';  // Default image URL
        $isSeen = $item->st_seen == 1;
    @endphp

    <a href="{{ route('admin.messages.reply_index1', ['coach_id' => $item->coach_id, 'student_id' => $item->student_id]) }}" style="text-decoration: none; color: inherit; display: flex; align-items: center; margin-bottom: 10px;">
        <img src="{{ $image }}" alt="{{ $name }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
        <div style="flex-grow: 1;">
            <div style="font-weight: bold; margin-bottom: 5px;">{{ $name }}</div>
            <div style="color: #666; font-size: 0.9em; margin-bottom: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; {{ $isSeen ? 'font-weight: bold;color:blue;' : '' }}">{{ $lastMessage }}</div>
            </div>
    </a>
@endforeach
@endif
</div>

<script>
    // JavaScript for filtering faculty list
    const searchInput = document.getElementById('searchInput');
    const facultyList = document.getElementById('facultyList');

    searchInput.addEventListener('input', function () {
        const searchValue = this.value.toLowerCase();
        Array.from(facultyList.children).forEach(function (facultyItem) {
            const facultyName = facultyItem.querySelector('div > div:first-child').textContent.toLowerCase();
            if (facultyName.includes(searchValue)) {
                facultyItem.style.display = 'block';
            } else {
                facultyItem.style.display = 'none';
            }
        });
    });
</script>

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