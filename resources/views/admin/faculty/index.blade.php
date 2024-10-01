@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">



<form id="archiveForm" method="POST" onsubmit="return handleSubmit()">
    @csrf
    <h1 class="h3 mb-2 text-gray-800 mb-3">
<!-- <i class="fas fa-dumbbell text-dark"></i>     -->
<!-- <i class="fa-solid fa-message text-light"></i> -->
<i class="fas fa-id-badge text-dark"></i>


Faculty Records
    <a href="{{route('admin.faculty.add_index')}}" class="btn btn-success btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New</a>
    <!-- <button type="button" class="btn btn-danger btn-sm" style="display:inline-block;" onclick="handleAction('archive')">Bulk Delete</button> -->

    <input type="hidden" name="selectedAction" id="selectedAction" value=""> <!-- Add a hidden input to store the selected action -->

    <!-- <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a> -->

</h1>


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Faculty Records 

                            </h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
 
 
                                <table class="table table-bordered users-table"  id="dataTable"  width="100%" cellspacing="0">
                                <thead>
                                                    <tr>

                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>DOB</th>

                                                        <th>Phone</th>

                                                      
                                                        <th>QrCode</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php 
                                                       // dd($data1);
                                                    @endphp
                                                    @foreach($data1 as $item)
                                                    <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->age}}</td>
                                                    <td>
                                                    <!-- <a href="{{asset('storage/' .$item->qrcode)}}"><img src="{{asset('storage/' .$item->qrcode)}}" width="100px" height="100px" alt="" ></a> -->
                                                    {{$item->phone_number}}
                                                   
                                                    </td>
                                                    
                                                    
                                              
                                                    <td class="text-center">
                                                    <a href="{{asset('storage/' .$item->qrcode)}}"><img src="{{asset('storage/' .$item->qrcode)}}">
                                                    </a>
                                                    </td>

                                                 
                                                    <!-- <td>
                                                    <a href="{{asset($item->qrcode)}}" class="btn" style="background-color: purple; color:white;">
                                                    <img src="{{asset($item->qrcode)}}" alt="" width="100px" height="100px">
                                                    </a>
                                                    </td> -->
                                                    @php 
                                                    $sell = $item->sell_price;
                                                    $cost = $item->cost_price;
                                                    $profit = $sell - $cost;
                                                    @endphp 
                                               
                                                        <td>
                                                            <!-- <a href="" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a> -->

                                                            <a href="{{route('admin.faculty.view_data',$item->id)}}" class="btn" style="background-color:#F4A629;padding:4px;color:white;text-decoration:none;"><i class="voyager-eye"></i>View</a>


                                                            <a href="{{route('admin.faculty.edit_data',$item->id)}}" class="btn" style="background-color:#22A7F0;padding:4px;color:white;text-decoration:none;"> 
                                                             <i class="voyager-edit"></i>Edit

                                                            </a>

                                                         
                                                            <a href="{{route('admin.faculty.delete',$item->id)}}" class="btn" onclick="return confirm('Are you sure you want to Delete This?')" style="background-color:#FA2A00;padding:4px;color:white;text-decoration:none;"><i class="voyager-trash"></i>Delete</a>
                                                            
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                    
                                </table>

                          
                            </div>
                        </div>
                    </div>
                    </form>
</div>

<script>
function handleSubmit() {
    // This function will handle form submission based on the selected action
    var selectedAction = document.getElementById('selectedAction').value;

    if (selectedAction === 'archive') {
        document.getElementById('archiveForm').action = "{{ route('admin.membership.bulkdelete') }}";
    } else if (selectedAction === 'reminder') {
        // document.getElementById('archiveForm').action = "";
    }

    document.getElementById('archiveForm').submit(); // Submit the form
    return true; // Allow form submission
}

function handleAction(action) {
    // This function will handle the button click and set the selected action
    document.getElementById('selectedAction').value = action;
    handleSubmit(); // Call handleSubmit to dynamically set the form action and submit the form
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selectedRows[]"]');

        // Add event listener to the "Select All" checkbox
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




@endsection
