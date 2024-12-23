@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
<style>
    .range-btn.active {
    background-color: #FF6600 !important; /* Blue background for active */
    color: white !important;           /* White text for active button */
    border-color: #007bff;             /* Blue border */
}

</style>
<form id="totalForm">
    <div class="col-md-12">
        <div class="row">
            <!-- Date Range Buttons -->
            <div class="col-md-8">
                <div class="form-group">
                    <button type="button" class="btn btn-primary range-btn" data-range="today">Today</button>
                    <button type="button" class="btn btn-secondary range-btn" data-range="yesterday">Yesterday</button>
                    <button type="button" class="btn btn-success range-btn" data-range="this_week">This Week</button>
                    <button type="button" class="btn btn-info range-btn" data-range="this_month">This Month</button>
                    <button type="button" class="btn btn-warning range-btn" data-range="this_year">This Year</button>
                    <button type="button" class="btn btn-dark range-btn" data-range="custom">Custom Range</button>
                </div>

                <div class="form-group" id="custom-date-range" style="display: none;">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">

                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">

                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Calculate Total</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('range').addEventListener('change', function() {
        if (this.value === 'custom') {
            document.getElementById('custom-date-range').style.display = 'block';
        } else {
            document.getElementById('custom-date-range').style.display = 'none';
        }
    });
</script>


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
                <th> {{ __('showroompage.names') }}</th>
                <th> {{ __('showroompage.parts') }}</th>
                <th> {{ __('showroompage.kinds') }}</th>
                <th> {{ __('showroompage.price') }}</th>
                <th> {{ __('showroompage.action') }}</th>
            </tr>
        </thead>
        <tbody id="showroom-table-body">
            <!-- Populate the table with data from the controller -->
            @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->part }}</td>
                    <td>{{ $item->kind }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-car-part" 
                            data-id="{{ $item->id }}" data-part="{{ $item->part }}" 
                            data-kind="{{ $item->kind }}" data-price="{{ $item->price }}">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-car-part" 
                            data-id="{{ $item->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set "Today" as default selected range and fetch data
    fetchTotalAndUpdateTable('this_year');

    // Handle the range button clicks
    document.querySelectorAll('.range-btn').forEach(button => {
        button.addEventListener('click', function() {
            let range = this.getAttribute('data-range');
            let startDate = '';
            let endDate = '';

            // Remove active class from all buttons
            document.querySelectorAll('.range-btn').forEach(btn => btn.classList.remove('active'));

            // Add active class to the clicked button
            this.classList.add('active');

            if (range === 'custom') {
                document.getElementById('custom-date-range').style.display = 'block';
            } else {
                document.getElementById('custom-date-range').style.display = 'none';
                fetchTotalAndUpdateTable(range, startDate, endDate);
            }
        });
    });

    // Handle custom range form submission
    document.getElementById('totalForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let startDate = document.getElementById('start_date').value;
        let endDate = document.getElementById('end_date').value;
        fetchTotalAndUpdateTable('custom', startDate, endDate);
    });

    // Function to fetch total and update the table
    function fetchTotalAndUpdateTable(range = 'all', startDate = '', endDate = '') {
        fetch('{{ route("calculate-total") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                range: range,
                start_date: startDate,
                end_date: endDate,
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Update table body with the filtered data
            document.getElementById('totalAmount').textContent = data.total + " LYD";

            let tableBody = document.getElementById('showroom-table-body');
            tableBody.innerHTML = ''; // Clear the table

            if (data.records.length > 0) {
                data.records.forEach((item, index) => {
                    let row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.part}</td>
                        <td>${item.kind}</td>
                        <td>${item.price}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-car-part" 
                                data-id="${item.id}" data-part="${item.part}" 
                                data-kind="${item.kind}" data-price="${item.price}">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-car-part" 
                                data-id="${item.id}">Delete</a>
                        </td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            } else {
                tableBody.innerHTML = `<tr><td colspan="5" class="text-center text-danger">
                    <strong>No Data Available</strong></td></tr>`;
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>



                <div class="col-md-12">
                    <div class="row">


                    <div class="col-md-6 mt-3">
                        <h3 style="font-size: 20px;font-weight:bold;">Total:</h3>
                        <p id="totalAmount">0 LYD</p>
                    </div>

                        <div class="col-md-6">
                <h7> {{ __('showroompage.current_time_libya') }}</h7>
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
                    <label for="username">Name</label>
                    <select name="names" class="form-control" id="username">

                    </select>
                    </div>

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
                    <label for="username">Name</label>
                    <select name="names" class="form-control" id="editusername">

                    </select>
                    </div>

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

            
// Trigger this function when the modal opens to load names
$('#addNewModal').on('show.bs.modal', function () {
    fetch("{{ asset('partkinds/names.json') }}")
        .then(response => response.json())
        .then(data => {
            const usernameSelect = document.getElementById('username');
            usernameSelect.innerHTML = ''; // Clear any existing options

            // Populate select options with names from the "names" array
            data.names.forEach(name => {
                const option = document.createElement('option');
                option.value = name;
                option.text = name;
                usernameSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching names:', error));
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

    $('#addPartForm').submit(function (e) {
    e.preventDefault();

    let part = $('#partKind').val();
    let kind = $('#carModel').val();
    let price = parseFloat($('#price').val()); // Convert price to float
    let _token = $('meta[name="csrf-token"]').attr('content');
    let names = $('#username').val(); // Retrieve the selected name

    $.ajax({
        url: "{{ route('admin.store.card_part_kind_price') }}",
        type: "POST",
        data: {
            names: names, 
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
                    <td>${response.name}</td>
                    <td>${response.part}</td>
                    <td>${response.kind}</td>
                    <td>${response.price}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-car-part" data-id="${response.id}" data-part="${response.part}" data-kind="${response.kind}" data-price="${response.price}">Edit</a>
                        <a href="javascript:void(0)" data-id="${response.id}" class="btn btn-danger btn-sm delete-car-part">Delete</a>
                    </td>
                </tr>`;
                $('#showroom-table-body').append(newRow);

                // Update the total amount
                let currentTotal = parseFloat($('#totalAmount').text().replace(' LYD', '')) || 0;
                let newTotal = currentTotal + price;
                $('#totalAmount').text(newTotal + " LYD");

                // Close modal
                $('#addNewModal').hide();
$('.modal-backdrop').remove(); // Removes any lingering backdrop
$('body').removeClass('modal-open'); // Ensures body scroll is restored
$('body').css('overflow', ''); // Resets any overflow property set by Bootstrap

                // Reset form fields
                $('#addPartForm')[0].reset();

                // Display success message with SweetAlert
                Swal.fire({
                    title: 'Success!',
                    text: 'New part added successfully.',
                    icon: 'success',
                    // confirmButtonText: 'OK'
                    timer: 2000, // Set timer for 2 seconds
                    showConfirmButton: false // Hide confirm button

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
// Open edit modal and populate fields with row data
$(document).on('click', '.edit-car-part', function () {
    const id = $(this).data('id');
    const name = $(this).data('name'); // Fetch the name from data attribute
    const part = $(this).data('part');
    const kind = $(this).data('kind');
    const price = $(this).data('price');

    // Set the values for part, kind, and price fields
    $('#editPartId').val(id);
    $('#editPartKind').val(part);
    $('#editCarModel').val(kind);
    $('#editPrice').val(price);

    // Fetch and populate the names dropdown
    fetch("{{ asset('partkinds/names.json') }}")
        .then(response => response.json())
        .then(data => {
            const editUsernameSelect = $('#editusername');
            editUsernameSelect.empty(); // Clear any existing options

            // Populate names and set the selected one
            data.names.forEach(currentName => {
                const isSelected = currentName === name ? 'selected' : '';
                editUsernameSelect.append(`<option value="${currentName}" ${isSelected}>${currentName}</option>`);
            });

            // Debugging: Check if the name was selected correctly
            console.log(`Expected name: ${name}, Selected name: ${editUsernameSelect.find('option:selected').text()}`);
        })
        .catch(error => console.error('Error fetching names:', error));

    // Show the modal
    $('#editModal').modal('show');
});

// AJAX form submission for updating a part
$('#editPartForm').submit(function (e) {
    e.preventDefault();

    let id = $('#editPartId').val();
    let name = $('#editusername').val(); // Fetch selected name
    let part = $('#editPartKind').val();
    let kind = $('#editCarModel').val();
    let price = $('#editPrice').val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('admin.update.carparts', '') }}/" + id,
        type: "PUT",
        data: {
            name: name, // Include name in the data
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
                $('.modal-backdrop').remove();

                // Display success message with SweetAlert
                Swal.fire({
                    title: 'Updated!',
                    text: 'Part updated successfully.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
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

    $(document).on('click', '.delete-car-part', function () {
    const id = $(this).data('id');
    const row = $('#row-' + id);

    // Ensure the row is found before proceeding


    // Get the price of the part to update the total
    const priceToRemove = parseFloat(row.find('td:eq(3)').text()) || 0;

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
                        // Update total amount
                        let currentTotal = parseFloat($('#totalAmount').text().replace(' LYD', '')) || 0;
                        let newTotal = currentTotal - priceToRemove;
                        $('#totalAmount').text(newTotal.toFixed(2) + " LYD"); // Update displayed total

                        // Remove the row from the table
                        row.remove();

                        // Display success message with SweetAlert
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Part has been deleted.',
                            icon: 'success',
                            timer: 2000, // Set timer for 2 seconds
                            showConfirmButton: false // Hide confirm button
                        }).then(() => {
                            // Reload the page after the timer
                            location.reload();
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
    // Function to update the time and day
    function updateTime() {
        // Create a new Date object
        const now = new Date();

        // Format the time for Libya (EET time zone)
        const libyaTime = new Intl.DateTimeFormat('en-GB', {
            timeZone: 'Africa/Tripoli',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false // Use 24-hour format
        }).format(now);

        // Get the day of the week
        const dayOptions = { weekday: 'long', timeZone: 'Africa/Tripoli' };
        const libyaDay = new Intl.DateTimeFormat('en-GB', dayOptions).format(now);

        // Display the day and time in the designated div
        document.getElementById('time').textContent = ` ${libyaTime} - ${libyaDay}`;
    }

    // Update the time and day every second
    setInterval(updateTime, 1000);

    // Initial call to display the time and day immediately
    updateTime();
</script>


@endsection
