@extends('admin.admin_master')

@section('admin_content')
<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800 mb-3">
<i class="fas fa-dumbbell text-dark"></i>    
Exercises

<a href="#" class="btn btn-success btn-sm btn-sm"  id="btn-add"><i class="fa-solid fa-square-plus text-light"></i> Add New</a>
<a href="" class="btn btn-danger btn-sm btn-sm"><i class="fa-solid fa-trash text-light"></i> Bulk Delete</a>
</h1>


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Exercise Records


                            </h6>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered users-table"  id="dataTable"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>ExerciseImage</th>
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
                <h5 class="modal-title" id="userModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                 
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img id="preview-image" src="#" alt="Preview Image" class="img-thumbnail mt-2" style="display: none; width: 150px;">
                    </div>
                    <input type="hidden" id="user-id" name="user_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<script>
    $(document).ready(function() {
        var table = $('.users-table tbody');
        var modal = new bootstrap.Modal(document.getElementById('userModal'));
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        // Fetch and display users
        function fetchUsers() {
            $.ajax({
                url: '{{url("admin/getexercisedata")}}',
                method: 'GET',
                success: function(response) {
                    table.html('');
                    $.each(response, function(index, user) {
                        // var image = user.exercise_image ? `<img src="/storage/${user.exercise_image}" class="img-thumbnail" width="100" height="100px">` : '';
                        var imageUrl = user.exercise_image.startsWith('public/') ? `/storage/${user.exercise_image.substr(7)}` : `/storage/${user.exercise_image}`;
                
                var image = user.exercise_image ? `<img src="${imageUrl}" class="img-thumbnail" width="100" height="100px">` : '';
                        table.append(`
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.title}</td>
                                <td>
                                <center>
                                ${image}
                                </center>
                                </td>

                                <td>${user.created_at}</td>
                                <td>
                                    <button class="btn btn-primary btn-edit" data-id="${user.id}">Edit</button>
                                    <button class="btn btn-danger btn-delete" data-id="${user.id}">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }
        fetchUsers();

        // Open modal for adding user
        $('#btn-add').click(function() {
            $('#userForm')[0].reset();
            $('#userModalLabel').text('Add User');
            $('#preview-image').hide();
            $('#user-id').val('');
            modal.show();
        });

        // Open modal for editing user
        table.on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: `{{ route("admin.exercise.edit", ['user' => ':id']) }}`.replace(':id', id),
                method: 'GET',
                success: function(response) {
                    $('#userModalLabel').text('Edit User');
                    $('#name').val(response.title);
                    // $('#email').val(response.email);
                    $('#user-id').val(response.id);

                    function getImageUrl(imagePath) {
                if (!imagePath) return ''; // Return empty string if imagePath is falsy

                if (imagePath.startsWith('public/')) {
                    return `/storage/${imagePath.substr(7)}`;
                } else {
                    return `/storage/${imagePath}`;
                }
            }

            var imageUrl = getImageUrl(response.exercise_image);
                    if (response.exercise_image) {
               
                        $('#preview-image').attr('src', imageUrl).show();
                    } else {
                        $('#preview-image').hide();
                    }
                    modal.show();
                }
            });
        });

        // Save user (add/update)
        $('#btn-save').click(function() {
            var formData = new FormData($('#userForm')[0]);
            // console.error('formdata' .$formData);
            console.error('hello');
            console.error(formData);
            var id = $('#user-id').val();
            var method = id ? 'PUT' : 'POST';
            var url = id ? `{{ route("admin.exercise.update", ['user' => ':id']) }}`.replace(':id', id) : '{{ route("admin.exercise.store") }}';
            $.ajax({
                url: url,
                method: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    modal.hide();
                    fetchUsers();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        });

        // Delete user
        table.on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: `{{url('admin/exercise-delete/${id}')}}`,
                    method: 'DELETE',
                    success: function(response) {
                        fetchUsers();
                    }
                });
            }
        });
    });
</script>
@endsection