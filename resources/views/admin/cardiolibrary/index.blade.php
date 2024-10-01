@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">



<form id="archiveForm" method="POST" onsubmit="return handleSubmit()">
    @csrf
    <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Cardio Library
    <a href="{{route('admin.cardio_library.add')}}" class="btn btn-success btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New</a>
    
    <!-- <button type="button" class="btn btn-danger btn-sm" style="display:inline-block;" onclick="handleAction('archive')">Bulk Delete</button> -->
    <input type="hidden" name="selectedAction" id="selectedAction" value=""> <!-- Add a hidden input to store the selected action -->

    <!-- <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a> -->

</h1>


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Cardio Library Records

                            </h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
 
 
                            <table class="table table-bordered users-table" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
          
            <th>S.no</th>
            <th>Title</th>
            <th>CardioCreatedOn</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      
    @if($data->isEmpty())
    <tr>
       <td colspan="12" style="text-align:center;font-weight:bold;font-size:2.1rem;">No Data Found!!</td>
    </tr>
    @else 
    @php 

    $counter = 0;
    @endphp
    @foreach($data as $item)
    @php 
$counter ++;
    @endphp
                    <tr>
                      
                        <td>{{$counter}}</td>
                        <td>{{$item->title}}</td>
                  
                        <td>
                            {{$item->created_at}}
                        </td>

                        <td>
                            <a href="{{route('admin.cardio_library.view',$item->id)}}" class="btn btn-warning btn-sm">View</a>
                            <a href="{{route('admin.cardio_library.edit',$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{route('admin.cardio_library.delete',$item->id)}}" onclick="return confirm('Are You Sure Want To Delete This?')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
         @endforeach
         @endif
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
        document.getElementById('archiveForm').action = "{{ route('admin.module.bulkdelete') }}";
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
