@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-gift text-dark"></i>    
Coupouns

    <a href="#" class="btn btn-success btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New</a>
    <a href="#" class="btn btn-danger btn-sm" id="btn-bulk-delete"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a>

</h1>


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Coupouns Records


                            </h6>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered users-table"  id="dataTable"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>#</th> -->
                                            <th><input type="checkbox" id="select-all"></th>
                                        <th>Sno</th>
                                            <th>Code</th>
                                            <th>DiscountPercentage</th>
                                            <th>CreatedAt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                     

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

</div>



<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add Coupoun</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="userForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Code</label>
                        <input type="text" class="form-control" id="name" name="code" required>
                    </div>
                 
                    <div class="mb-3">
                        <label for="" class="form-label">Discount Percentage</label>
                        <input type="number" class="form-control" id="image" name="discount_percentage" min="0" max="100"> 
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> -->

<!-- Edit Exercise Modal -->
<div class="modal fade" id="editExerciseModal" tabindex="-1" aria-labelledby="editExerciseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExerciseModalLabel">Edit Coupouns</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="editExerciseForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Code</label>
                        <input type="text" class="form-control" id="edit-name" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Discount Percentage</label>
                        <input type="number" class="form-control" id="edit-image" name="discount_percentage">
                    </div>
                    <input type="hidden" id="edit-user-id" name="user_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save-edit">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
// $(document).ready(function() {
//     var table = $('.users-table tbody');
    
//     var addModal = new bootstrap.Modal(document.getElementById('userModal'));
//     var editModal = new bootstrap.Modal(document.getElementById('editExerciseModal'));

//     // Initialize DataTable
//     $('#dataTable').DataTable();

//     // Setup CSRF token for AJAX requests
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     // Fetch and display exercises
//     function fetchExercises() {
//         $.ajax({
//             url: '{{ url("admin/getexercisedata") }}',
//             method: 'GET',
//             success: function(response) {
//                 var table = $('#dataTable').DataTable();
//                 table.clear();
//                 $.each(response, function(index, exercise) {
//                     var imageUrl = exercise.exercise_image.startsWith('public/') ? `/storage/${exercise.exercise_image.substr(7)}` : `/storage/${exercise.exercise_image}`;
//                     var image = exercise.exercise_image ? `<img src="${imageUrl}" class="img-thumbnail" width="100" height="100px">` : '';
//                     table.row.add([
//                         exercise.id,
//                         exercise.title,
//                         `<center>${image}</center>`,
//                         exercise.created_at,
//                         `<button class="btn btn-primary btn-edit" data-id="${exercise.id}">Edit</button>
//                          <button class="btn btn-danger btn-delete" data-id="${exercise.id}">Delete</button>`
//                     ]).draw(false);
//                 });
//             }
//         });
//     }
//     fetchExercises();

//     // Open modal for adding exercise
//     $('#btn-add').click(function() {
//         $('#userForm')[0].reset();
//         $('#userModalLabel').text('Add Exercise');
//         $('#preview-image').hide();
//         $('#user-id').val('');
//         addModal.show();
//     });

//     // Open modal for editing exercise
//     table.on('click', '.btn-edit', function() {
//         var id = $(this).data('id');
//         $.ajax({
//             url: `{{ route("admin.exercise.edit", ['user' => ':id']) }}`.replace(':id', id),
//             method: 'GET',
//             success: function(response) {
//                 $('#editExerciseModalLabel').text('Edit Exercise');
//                 $('#edit-name').val(response.title);
//                 $('#edit-user-id').val(response.id);

//                 var imageUrl = response.exercise_image ? `/storage/${response.exercise_image.replace('/public', '')}` : '';
//                 if (response.exercise_image) {
//                     $('#edit-preview-image').attr('src', imageUrl).show();
//                 } else {
//                     $('#edit-preview-image').hide();
//                 }

//                 editModal.show();
//             }
//         });
//     });

//     // Save new exercise or update existing exercise
//     $('#btn-save').click(function() {
//         var formData = new FormData($('#userForm')[0]);
//         saveExercise(formData, addModal);
//     });

//     $('#btn-save-edit').click(function() {
//         var formData = new FormData($('#editExerciseForm')[0]);
//         saveExercise(formData, editModal);
//     });

//     function saveExercise(formData, modal) {
//         var id = $('#user-id').val();
//         var method = id ? 'PUT' : 'POST';
//         var url = id ? `{{ route("admin.exercise.update", ['user' => ':id']) }}`.replace(':id', id) : '{{ route("admin.exercise.store") }}';
//         $.ajax({
//             url: url,
//             method: method,
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function(response) {
//                 modal.hide();
//                 fetchExercises();
//             },
//             error: function(xhr) {
//                 alert(xhr.responseJSON.message);
//             }
//         });
//     }

//     // Delete exercise
//     table.on('click', '.btn-delete', function() {
//         var id = $(this).data('id');
//         if (confirm('Are you sure you want to delete this exercise?')) {
//             $.ajax({
//                 url: `{{ url('admin/exercise-delete/${id}') }}`,
//                 method: 'DELETE',
//                 success: function(response) {
//                     fetchExercises();
//                 }
//             });
//         }
//     });
// });


// $(document).ready(function() {
//     var table = $('.users-table tbody');
    
//     var addModal = new bootstrap.Modal(document.getElementById('userModal'));
//     var editModal = new bootstrap.Modal(document.getElementById('editExerciseModal'));

//     // Initialize DataTable
//     var dataTable = $('#dataTable').DataTable();

//     // Setup CSRF token for AJAX requests
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     // Fetch and display exercises
//     function fetchExercises() {
//         $.ajax({
//             url: '{{ url("admin/getexercisedata") }}',
//             method: 'GET',
//             success: function(response) {
//                 dataTable.clear();
//                 $.each(response, function(index, exercise) {
//                     var imageUrl = exercise.exercise_image.startsWith('public/') ? `/storage/${exercise.exercise_image.substr(7)}` : `/storage/${exercise.exercise_image}`;
//                     var image = exercise.exercise_image ? `<img src="${imageUrl}" class="img-thumbnail" width="100" height="100px">` : '';
//                     dataTable.row.add([
//                         `<input type="checkbox" class="row-checkbox" data-id="${exercise.id}">`,
//                         exercise.id,
//                         exercise.title,
//                         `<center>${image}</center>`,
//                         exercise.created_at,
//                         `<button class="btn btn-primary btn-edit" data-id="${exercise.id}">Edit</button>
//                          <button class="btn btn-danger btn-delete" data-id="${exercise.id}">Delete</button>`
//                     ]).draw(false);
//                 });
//             }
//         });
//     }
//     fetchExercises();

//     // Select/Deselect all checkboxes
//     $('#select-all').click(function() {
//         $('.row-checkbox').prop('checked', this.checked);
//     });

//     // Open modal for adding exercise
//     $('#btn-add').click(function() {
//         $('#userForm')[0].reset();
//         $('#userModalLabel').text('Add Exercise');
//         $('#preview-image').hide();
//         $('#user-id').val('');
//         addModal.show();
//     });

//     // Open modal for editing exercise
//     table.on('click', '.btn-edit', function() {
//         var id = $(this).data('id');
//         $.ajax({
//             url: `{{ route("admin.exercise.edit", ['user' => ':id']) }}`.replace(':id', id),
//             method: 'GET',
//             success: function(response) {
//                 $('#editExerciseModalLabel').text('Edit Exercise');
//                 $('#edit-name').val(response.title);
//                 $('#edit-user-id').val(response.id);

//                 var imageUrl = response.exercise_image ? `/storage/${response.exercise_image.replace('/public', '')}` : '';
//                 if (response.exercise_image) {
//                     $('#edit-preview-image').attr('src', imageUrl).show();
//                 } else {
//                     $('#edit-preview-image').hide();
//                 }

//                 editModal.show();
//             }
//         });
//     });

//     // Save new exercise or update existing exercise
//     $('#btn-save').click(function() {
//         var formData = new FormData($('#userForm')[0]);
//         saveExercise(formData, addModal);
//     });

//     $('#btn-save-edit').click(function() {
//         var formData = new FormData($('#editExerciseForm')[0]);
//         saveExercise(formData, editModal);
//     });

//     function saveExercise(formData, modal) {
//         var id = $('#user-id').val();
//         var method = id ? 'PUT' : 'POST';
//         var url = id ? `{{ route("admin.exercise.update", ['user' => ':id']) }}`.replace(':id', id) : '{{ route("admin.exercise.store") }}';
//         $.ajax({
//             url: url,
//             method: method,
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function(response) {
//                 modal.hide();
//                 fetchExercises();
//             },
//             error: function(xhr) {
//                 alert(xhr.responseJSON.message);
//             }
//         });
//     }


//     // Delete exercise
//     table.on('click', '.btn-delete', function() {
//         var id = $(this).data('id');
//         if (confirm('Are you sure you want to delete this exercise?')) {
//             $.ajax({
//                 url: `{{ url('admin/exercise-delete/${id}') }}`,
//                 method: 'DELETE',
//                 success: function(response) {
//                     fetchExercises();
//                 }
//             });
//         }
//     });

//     // Bulk delete exercises
//     $('#btn-bulk-delete').click(function() {
//         var selectedIds = [];
//         $('.row-checkbox:checked').each(function() {
//             selectedIds.push($(this).data('id'));
//         });
//         if (selectedIds.length === 0) {
//             alert('Please select at least one exercise to delete.');
//             return;
//         }
//         if (confirm('Are you sure you want to delete the selected exercises?')) {
//             $.ajax({
//                 url: '{{ route("admin.exercise.bulkdelete") }}',
//                 method: 'DELETE',
//                 data: {
//                     ids: selectedIds
//                 },
//                 success: function(response) {
//                     fetchExercises();
//                 },
//                 error: function(xhr) {
//                     alert(xhr.responseJSON.message);
//                 }
//             });
//         }
//     });
// });


$(document).ready(function() {
    var table = $('.users-table tbody');
    
    var addModal = new bootstrap.Modal(document.getElementById('userModal'));
    var editModal = new bootstrap.Modal(document.getElementById('editExerciseModal'));

    // Initialize DataTable
    var dataTable = $('#dataTable').DataTable();

    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Fetch and display exercises
    function fetchExercises() {
        $.ajax({
            url: '{{ url("admin/getcoupounsdata") }}',
            method: 'GET',
            success: function(response) {
                dataTable.clear();
                $.each(response, function(index, exercise) {
                    // var imageUrl = exercise.exercise_image.startsWith('public/') ? `/storage/${exercise.exercise_image.substr(7)}` : `/storage/${exercise.exercise_image}`;
                    // var image = exercise.exercise_image ? `<img src="${imageUrl}" class="img-thumbnail" width="100" height="100px">` : '';
                    dataTable.row.add([
                        `<input type="checkbox" class="row-checkbox" data-id="${exercise.id}">`,
                        exercise.id,
                        exercise.code,
                        exercise.discount_percentage,

                        exercise.created_at,
                        `<button class="btn btn-primary btn-edit" data-id="${exercise.id}">Edit</button>
                         <button class="btn btn-danger btn-delete" data-id="${exercise.id}">Delete</button>`
                    ]).draw(false);
                });
            }
        });
    }
    fetchExercises();

    // Select/Deselect all checkboxes
    $('#select-all').click(function() {
        $('.row-checkbox').prop('checked', this.checked);
    });

    // Open modal for adding exercise
    $('#btn-add').click(function() {
        $('#userForm')[0].reset();
        $('#userModalLabel').text('Add Coupouns');
        $('#preview-image').hide();
        $('#user-id').val('');
        addModal.show();
    });

    // Open modal for editing exercise
    table.on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url: `{{ route("admin.coupouns.edit", ['user' => ':id']) }}`.replace(':id', id),
            method: 'GET',
            success: function(response) {
                $('#editExerciseModalLabel').text('Edit Coupouns');
                $('#edit-name').val(response.code);
                $('#edit-user-id').val(response.id);
                $('#edit-image').val(response.discount_percentage);
                
              
                editModal.show();
            }
        });
    });

    // Save new exercise or update existing exercise
    $('#btn-save').click(function() {
        var formData = new FormData($('#userForm')[0]);
        var id = $('#user-id').val();
        saveExercise(formData, addModal, id);
    });

    $('#btn-save-edit').click(function() {
        var formData = new FormData($('#editExerciseForm')[0]);
        var id = $('#edit-user-id').val();
        saveExercise(formData, editModal, id);
    });

    function saveExercise(formData, modal, id) {
        var method = id ? 'POST' : 'POST';
        var url = id ? `{{ route("admin.coupouns.update", ['user' => ':id']) }}`.replace(':id', id) : '{{ route("admin.coupouns.store") }}';
        if (id) {
            formData.append('_method', 'PUT'); // Laravel requires this to spoof the PUT method
        }
        $.ajax({
            url: url,
            method: method,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                modal.hide();
                fetchExercises();
                Swal.fire(
                    'Success!',
                    id ? 'Coupouns updated successfully.' : 'Coupouns created successfully.',
                    'success'
                );
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    }

    // Delete exercise
    table.on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this Coupoun?')) {
            $.ajax({
                url: `{{ url('admin/coupouns-delete/${id}') }}`,
                method: 'DELETE',
                success: function(response) {
                    fetchExercises();
                    Swal.fire(
                        'Deleted!',
                        'Record have been deleted Successfully.',
                        'success'
                    );
                }
            });
        }
    });

    // Bulk delete exercises
    $('#btn-bulk-delete').click(function() {
        var selectedIds = [];
        $('.row-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });
        if (selectedIds.length === 0) {
            alert('Please select at least one exercise to delete.');
            return;
        }
        if (confirm('Are you sure you want to delete the selected exercises?')) {
            $.ajax({
                url: '{{ route("admin.coupouns.bulkdelete") }}',
                method: 'DELETE',
                data: {
                    ids: selectedIds
                },
                success: function(response) {
                    fetchExercises();
                    Swal.fire(
                        'Deleted!',
                        'Selected exercises have been deleted.',
                        'success'
                    );
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    });
});


</script>


@endsection
