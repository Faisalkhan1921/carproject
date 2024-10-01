@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">



<form id="archiveForm" method="POST" onsubmit="return handleSubmit()">
    @csrf
    <h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Package Entries
    <a href="{{route('admin.package.add')}}" class="btn btn-success btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New</a>
    
    <!-- <button type="button" class="btn btn-danger btn-sm" style="display:inline-block;" onclick="handleAction('archive')">Bulk Delete</button> -->
    <input type="hidden" name="selectedAction" id="selectedAction" value=""> <!-- Add a hidden input to store the selected action -->

    <!-- <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a> -->

</h1>


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Package Entries Records

                            </h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
 
 
                                                <table class="table table-bordered users-table"  id="dataTable"  width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th>#</th> -->
                                                            <th><input type="checkbox" id="selectAll"></th>

                                                        <!-- <th>Sno</th> -->
                                                            <th>TitlePackage</th>
                                                            <th>Price</th>
                                                            <th>Status</th>
                                                            
                                                            <th>Type</th>
                                                            <th>NumberofDays</th>
                                                            <th>Session</th>
                                                            
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                
                                                    <tbody>
                                                    
                                                    @php 
                                                    $counter = 1;
                                                    @endphp

                                                    @if(count($data) != 0)
                                                    @foreach($data as $item)
                                                <tr>
                                                
                                                    <td>
                                                    <input type="checkbox" name="selectedRows[]" value="{{ $item->id }}">

                                                    </td>
                                                    <td>{{$item->title}}</td>
                                                    <td>{{$item->price}}</td>
                                                    <td>
                                                        @if($item->status == 0)
                                                        Active
                                                        @else 
                                                        DeActive 
                                                        @endif
                                                 
                                                    </td>

                                                    <td>{{$item->type}}</td>
                                                


                                                    <td>
                                                        @if($item->days == NULL)
                                                        Not Defined 
                                                        @else 
                                                        {{$item->days}}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($item->session == NULL)
                                                        Not Defined 
                                                        @else 
                                                        {{$item->session}}
                                                        @endif
                                                    </td>
                                              
                                                  
                                                    
                                                    <td>

                                                            <a href="{{route('admin.package.edit',$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                                            <a href="{{route('admin.package.delete',$item->id)}}" onclick="return confirm('Are You Sure Want To Delete This?')" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                    </tr>
                                                @endforeach

                                                @else 
                                                <tr>
                                                    <!-- <strong class="text-center text-danger">No Data Available</strong> -->
                                                    <td colspan="5" class="text-center text-danger"><strong>No Data Available</strong>
                                                    <hr>

                                                </td>
                                                </tr>
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
        document.getElementById('archiveForm').action = "{{ route('admin.comp.bulkdelete') }}";
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
