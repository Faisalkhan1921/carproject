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


Membership Records
    <a href="{{route('admin.membership.add')}}" class="btn btn-success btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New</a>
    <button type="button" class="btn btn-danger btn-sm" style="display:inline-block;" onclick="handleAction('archive')">Bulk Delete</button>

    <input type="hidden" name="selectedAction" id="selectedAction" value=""> <!-- Add a hidden input to store the selected action -->

    <!-- <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a> -->

</h1>


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Membership Records 

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
                                            <th>UserEmail</th>
                                            <th>PackagePurchase</th>
                                            <th>DiscountPercentage</th>
                                            <th>CustomerInfo</th>
                                            <th>File1</th>
                                            <th>File2</th>
                                            <th>File3</th>
                                            <th>File4</th>
                                            <th>File5</th>
                                            <th>File6</th>
                                            <th>PurchasedOn</th>
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
                                     @php 
                                    $reg = App\Models\Message::where('id',$item->reg_id)->first();
                                    if($reg)
                                    {

                                        $email = $reg->email;
                                    }
                                    else 
                                    {
                                        $email = 'N/A';
                                    }
                                    
                                    $package = App\Models\Package::where('id',$item->package_id)->first();
                                    if($package)
                                    {
                                        $package_name = $package->title;
                                    }
                                    else 
                                    {
                                        $package_name = 'N/A';
                                    }
                                     @endphp
                                     <td>{{$email}}</td>
                                     <td>{{$package_name}}</td>
                                     <td>{{$item->discount_percentage}}</td>
                                     <td>

                                     @php
                                    $emiratesId = json_decode($item->file_path, true); // Decode the JSON string into an array
                                    @endphp

                                    @if (is_array($emiratesId))
                                    @foreach($emiratesId as $file)
                                    <div class="panel-body" style="padding-top:0;">
                                    <a href="{{ asset('storage' .$file['download_link']) }}">
                                    {{$file['original_name']}}
                                    </a>
                                    </div><!-- panel-body -->

                                    @endforeach
                                    @else
                                    <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
                                    <span style="color:blue;font-weight:bold;">{{ $item->file_path }}</span>
                                    <br>
                                    @endif

                                     </td>
                                     


                                    <td>

                                    @php
                                    $emiratesId = json_decode($item->File1, true); // Decode the JSON string into an array
                                @endphp

                                @if (is_array($emiratesId))
                                    @foreach($emiratesId as $file)
                                    <div class="panel-body" style="padding-top:0;">
                                    <a href="{{ asset('storage' .$file['download_link']) }}">
                                                {{$file['original_name']}}
                                            </a>
                                    </div><!-- panel-body -->
                                    
                                    @endforeach
                                @else
                                    <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
                                    <span style="color:blue;font-weight:bold;">{{ $item->File1 }}</span>
                                    <br>
                                @endif
                                    </td>

                                    <td>

                                    @php
                                    $emiratesId = json_decode($item->File2, true); // Decode the JSON string into an array
                                    @endphp

                                    @if (is_array($emiratesId))
                                    @foreach($emiratesId as $file)
                                    <div class="panel-body" style="padding-top:0;">
                                    <a href="{{ asset('storage' .$file['download_link']) }}">
                                    {{$file['original_name']}}
                                    </a>
                                    </div><!-- panel-body -->

                                    @endforeach
                                    @else
                                    <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
                                    <span style="color:blue;font-weight:bold;">{{ $item->File2 }}</span>
                                    <br>
                                    @endif
                                    </td>


                                    <td>

                                    @php
                                    $emiratesId = json_decode($item->File3, true); // Decode the JSON string into an array
                                    @endphp

                                    @if (is_array($emiratesId))
                                    @foreach($emiratesId as $file)
                                    <div class="panel-body" style="padding-top:0;">
                                    <a href="{{ asset('storage' .$file['download_link']) }}">
                                    {{$file['original_name']}}
                                    </a>
                                    </div><!-- panel-body -->

                                    @endforeach
                                    @else
                                    <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
                                    <span style="color:blue;font-weight:bold;">{{ $item->File3 }}</span>
                                    <br>
                                    @endif
                                    </td>

                              

                                    <td>

                                    @php
                                    $emiratesId = json_decode($item->File4, true); // Decode the JSON string into an array
                                    @endphp

                                    @if (is_array($emiratesId))
                                    @foreach($emiratesId as $file)
                                    <div class="panel-body" style="padding-top:0;">
                                    <a href="{{ asset('storage' .$file['download_link']) }}">
                                    {{$file['original_name']}}
                                    </a>
                                    </div><!-- panel-body -->

                                    @endforeach
                                    @else
                                    <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
                                    <span style="color:blue;font-weight:bold;">{{ $item->File4 }}</span>
                                    <br>
                                    @endif
                                    </td>


                                    <td>

                                    @php
                                    $emiratesId = json_decode($item->File5, true); // Decode the JSON string into an array
                                    @endphp

                                    @if (is_array($emiratesId))
                                    @foreach($emiratesId as $file)
                                    <div class="panel-body" style="padding-top:0;">
                                    <a href="{{ asset('storage' .$file['download_link']) }}">
                                    {{$file['original_name']}}
                                    </a>
                                    </div><!-- panel-body -->

                                    @endforeach
                                    @else
                                    <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
                                    <span style="color:blue;font-weight:bold;">{{ $item->File5 }}</span>
                                    <br>
                                    @endif
                                    </td>

                                        <td>

                                        @php
                                        $emiratesId = json_decode($item->File6, true); // Decode the JSON string into an array
                                        @endphp

                                        @if (is_array($emiratesId))
                                        @foreach($emiratesId as $file)
                                        <div class="panel-body" style="padding-top:0;">
                                        <a href="{{ asset('storage' .$file['download_link']) }}">
                                        {{$file['original_name']}}
                                        </a>
                                        </div><!-- panel-body -->

                                        @endforeach
                                        @else
                                        <!-- Handle the case where $item->emirates_id is not a valid JSON string -->
                                        <span style="color:blue;font-weight:bold;">{{ $item->File6 }}</span>
                                        <br>
                                        @endif
                                        </td>
                                   
                                        <td>{{$item->created_at}}</td>
                                     <td>
                                             <a href="{{route('admin.membership.view',$item->id)}}" class="btn btn-warning btn-sm">View</a>
                                             <a href="{{route('admin.membership.edit',$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                             <a href="{{route('admin.membership.delete',$item->id)}}" onclick="return confirm('Are You Sure Want To Delete This?')" class="btn btn-danger btn-sm">Delete</a>
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
