@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

    <form id="archiveForm" method="POST" onsubmit="return handleSubmit()">
        @csrf

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-car text-dark"></i> {{ __('showroompage.showroom_records') }}
                    <a href="#" class="btn btn-success btn-sm float-right" id="btn-add" data-toggle="modal" data-target="#addNewModal">
                        <i class="fa-solid fa-square-plus text-light"></i>  {{ __('showroompage.add_new') }}
                    </a>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered users-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> {{ __('showroompage.sno') }}</th>
                                <th> {{ __('showroompage.parts') }}</th>
                                <th> {{ __('showroompage.kinds') }}</th>
                                <th> {{ __('showroompage.price') }}</th>
                                <th> {{ __('showroompage.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="showroom-table-body">
                            @php $counter = 1; @endphp
                            @if(count($data) != 0)
                                @foreach($data as $item)
                                    <tr id="row-{{ $item->id }}">
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $item->part }}</td>
                                        <td>{{ $item->kind }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-car-part" data-id="{{ $item->id }}" data-part="{{ $item->part }}" data-kind="{{ $item->kind }}" data-price="{{ $item->price }}"> {{ __('showroompage.edit') }}</a>
                                            <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-danger btn-sm delete-car-part"> {{ __('showroompage.delete') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-danger">
                                        <strong>No Data Available</strong>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                <h7> {{ __('showroompage.current_time_saudi_arabia') }}</h7>
                <div id="time" style="font-size: 2rem; font-weight: bold;"></div>
            </div>
                    </div>
                </div>
            
               


            </div>
        </div>
    </form>
</div>

<!-- Add New Modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewModalLabel"> {{ __('showroompage.add_new_part') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPartForm">
                    <div class="form-group">
                        <label for="partKind"> {{ __('showroompage.parts') }}</label>
                        <select class="form-control" id="partKind" required></select>
                    </div>

                    <div class="form-group">
                        <label for="carModel"> {{ __('showroompage.kinds') }}</label>
                        <select class="form-control" id="carModel" required></select>
                    </div>

                    <div class="form-group">
                        <label for="price"> {{ __('showroompage.price') }}</label>
                        <input type="text" name="price" class="form-control" id="price" required>
                    </div>

                    <input type="submit" value=" {{ __('showroompage.submit') }}" class="form-control btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"> {{ __('showroompage.edit_part') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPartForm">
                    <input type="hidden" id="editPartId" value="">
                    
                    <div class="form-group">
                        <label for="editPartKind"> {{ __('showroompage.parts') }}</label>
                        <select class="form-control" id="editPartKind" required></select>
                    </div>

                    <div class="form-group">
                        <label for="editCarModel"> {{ __('showroompage.kinds') }}</label>
                        <select class="form-control" id="editCarModel" required></select>
                    </div>

                    <div class="form-group">
                        <label for="editPrice"> {{ __('showroompage.price') }}</label>
                        <input type="text" name="editPrice" class="form-control" id="editPrice" required>
                    </div>

                    <input type="submit" value=" {{ __('showroompage.update') }}" class="form-control btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Fetch data and populate select options
    document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ asset('partkinds/car_parts.json') }}")
            .then(response => response.json())
            .then(data => {
                const partSelect = document.getElementById('partKind');
                const editPartSelect = document.getElementById('editPartKind');
                partSelect.innerHTML = '';
                editPartSelect.innerHTML = '';
                data.parts.forEach(part => {
                    const option = document.createElement('option');
                    option.value = part;
                    option.text = part;
                    partSelect.appendChild(option);
                    editPartSelect.appendChild(option.cloneNode(true)); // Populate edit select with same options
                });
            });

        fetch("{{ asset('partkinds/libyan_cars.json') }}")
            .then(response => response.json())
            .then(data => {
                const carModelSelect = document.getElementById('carModel');
                const editCarModelSelect = document.getElementById('editCarModel');
                carModelSelect.innerHTML = '';
                editCarModelSelect.innerHTML = '';
                data.cars.forEach(car => {
                    const option = document.createElement('option');
                    option.value = car;
                    option.text = car;
                    carModelSelect.appendChild(option);
                    editCarModelSelect.appendChild(option.cloneNode(true)); // Populate edit select with same options
                });
            });
    });

    // AJAX form submission for adding a part
    $('#addPartForm').submit(function (e) {
        e.preventDefault();

        let part = $('#partKind').val();
        let kind = $('#carModel').val();
        let price = $('#price').val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('admin.store.card_part_kind_price') }}",
            type: "POST",
            data: {
                part: part,
                kind: kind,
                price: price,
                _token: _token
            },
            success: function (response) {
                if (response) {
                    // Append new data to the table dynamically
                    let newRow = `<tr id="row-${response.id}">
                        <td>${response.counter}</td>
                        <td>${response.part}</td>
                        <td>${response.kind}</td>
                        <td>${response.price}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-car-part" data-id="${response.id}" data-part="${response.part}" data-kind="${response.kind}" data-price="${response.price}">Edit</a>
                            <a href="javascript:void(0)" data-id="${response.id}" class="btn btn-danger btn-sm delete-car-part">Delete</a>
                        </td>
                    </tr>`;
                    $('#showroom-table-body').append(newRow);

                    // Close modal
                    $('#addNewModal').modal('hide');
                    $('.modal-backdrop').remove(); // In case the backdrop persists

                    // Reset form fields
                    $('#addPartForm')[0].reset();

                    // Display success message with SweetAlert
                    Swal.fire({
                        title: 'Success!',
                        text: 'New part added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (error) {
                console.log('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to add new part. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Open edit modal and populate fields with row data
    $(document).on('click', '.edit-car-part', function () {
        const id = $(this).data('id');
        const part = $(this).data('part');
        const kind = $(this).data('kind');
        const price = $(this).data('price');

        $('#editPartId').val(id);
        $('#editPartKind').val(part);
        $('#editCarModel').val(kind);
        $('#editPrice').val(price);

        $('#editModal').modal('show');
    });

    // AJAX form submission for updating a part
    $('#editPartForm').submit(function (e) {
        e.preventDefault();

        let id = $('#editPartId').val();
        let part = $('#editPartKind').val();
        let kind = $('#editCarModel').val();
        let price = $('#editPrice').val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('admin.update.carparts', '') }}/" + id,
            type: "PUT",
            data: {
                part: part,
                kind: kind,
                price: price,
                _token: _token
            },
            success: function (response) {
                if (response.success) {
                    // Update the table row with new data
                    let row = $('#row-' + id);
                    row.find('td:eq(1)').text(part);
                    row.find('td:eq(2)').text(kind);
                    row.find('td:eq(3)').text(price);

                    // Close modal
                    $('#editModal').modal('hide');
                    $('.modal-backdrop').remove(); // In case the backdrop persists

                    // Display success message with SweetAlert
                    Swal.fire({
                        title: 'Updated!',
                        text: 'Part updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to update part. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (error) {
                console.log('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update part. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Delete part functionality
    $(document).on('click', '.delete-car-part', function () {
        const id = $(this).data('id');
        const row = $('#row-' + id);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.delete.carparts', '') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            // Remove the row from the table
                            row.remove();

                            // Display success message with SweetAlert
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Part has been deleted.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'Failed to delete part. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function (error) {
                        console.log('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to delete part. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });

    // Handle form submission for the add part modal
    function handleSubmit() {
        // Prevent form submission
        return false;
    }
</script>

<script>
        // Function to update the time
        function updateTime() {
            // Get the current date and time in UTC
            const now = new Date();

            // Convert to Saudi Arabia time (AST is UTC+3)
            const saudiTime = new Date(now.getTime() + (3 * 60 * 60 * 1000));

            // Format the time to HH:MM:SS
            const hours = String(saudiTime.getHours()).padStart(2, '0');
            const minutes = String(saudiTime.getMinutes()).padStart(2, '0');
            const seconds = String(saudiTime.getSeconds()).padStart(2, '0');

            // Display the time in the designated div
            document.getElementById('time').textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Update the time every second
        setInterval(updateTime, 1000);

        // Initial call to display the time immediately
        updateTime();
    </script>

@endsection
