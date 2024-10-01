@extends('admin.admin_master')

@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">

    <!-- <h1 class="h3 mb-2 text-gray-800 mb-3">
    <i class="fas fa-id-badge text-dark"></i>    
    Add Faculty Records

    
    </h1> -->


      <div class="row mt-5">
        <div class="col-md-12 m-auto">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-id-badge text-dark"></i>    
                            Add Faculty Records
                            <a href="{{route('admin.faculty.index')}}" class="btn btn-warning btn-sm float-right">Return to List</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">
                        
                        <!-- =============================== start of form ================================ -->



                        <form  action="{{ route('admin.faculty.store') }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="" class="form-control" required>
                            @error ('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="" class="form-control" required>
                            @error ('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Position <span class="text-danger">*</span></label>
                            <input type="text" name="position" id="" class="form-control" required>
                            @error ('position')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Nationality</label>
                            <input type="text" name="nationality"  class="form-control">
                            @error ('nationality')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Gender <span class="text-danger">*</span></label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>

                            @error ('gender')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="age">Date Of Birth <span class="text-danger">*</span></label>
                        <input type="date" name="age" id="age" class="form-control" max="{{ date('Y-m-d') }}">
                        @error('age')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="number" name="phone_number" id="" class="form-control" placeholder="97150xx,97156xx,97152xx">
                            @error ('phone_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" id="" cols="30" rows="2" class="form-control"></textarea>
                            @error ('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Weight (kg)</label>
                            <input type="number" name="weight" id="" class="form-control" placeholder="">
                            @error ('weight')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="">Height (cm)</label>
                            <input type="number" name="height" id="" class="form-control" placeholder="">
                            @error ('height')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">T-Shirt Size</label>
                            <input type="text" name="t_shirt" id="" class="form-control" placeholder="">
                            @error ('t_shirt')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Password <span class="text-danger">*</span></label>
                            <input type="text" name="password" id="" class="form-control" value="TaurusSports@321">
                            @error ('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Confirm Password <span class="text-danger">*</span></label>
                            <input type="text" name="password_confirmation" id="" class="form-control" value="TaurusSports@321">
                            @error ('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="p_image">Profile Picture</label>
                        <input type="file" name="p_image" id="p_image" class="form-control">
                        @error ('p_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <!-- Button to trigger image cropping modal -->
                        <!-- <button type="button" id="cropImageModalBtn" class="btn btn-primary">Crop Image</button> -->
                        <div id="croppedImageContainer" ></div>
                        <!-- Modal for image cropping -->
                        <div class="modal fade" id="imageCropModal" tabindex="-1" aria-labelledby="imageCropModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="imageCropModalLabel">Crop Image</h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                        <img id="cropperImage" src="#" alt="Crop Image" />
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="cropImageButton" class="btn btn-primary">Crop</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        <script>
                        $(document).ready(function() {
                        // Attach click event listener to the close button
                        $('.modal-footer .btn-danger').click(function() {
                        // Hide the modal when close button is clicked
                        $('#imageCropModal').modal('hide');
                        });
                        });
                        </script>
                        <!-- Hidden input field to store the cropped image data -->
                        <input type="hidden" name="cropped_image_data" id="cropped_image_data">

                        <div id="croppedImageContainer" style="width:150px; height:150px;"></div>


                        <script>
                        document.addEventListener('DOMContentLoaded', function () {
                        var cropper;

                        // Function to handle file input change event and show modal with image
                        function handleFileSelect(evt) {
                        var file = evt.target.files[0];
                        var reader = new FileReader();

                        reader.onload = function (e) {
                        // Reset Cropper instance if it exists
                        if (cropper) {
                        cropper.destroy();
                        }

                        // Update image source
                        $('#cropperImage').attr('src', e.target.result);

                        // Show modal
                        $('#imageCropModal').modal('show');

                        // Initialize Cropper once the modal is shown
                        var image = document.getElementById('cropperImage');
                        cropper = new Cropper(image, {
                        // aspectRatio: 1, // Aspect ratio 1:1 for square crop
                        // viewMode: 1,
                        // maxCropBoxWidth: 150,
                        // maxCropBoxHeight: 150,
                        crop: function (event) {
                        // You can access cropped canvas with cropper.getCroppedCanvas()
                        }
                        });
                        };

                        reader.readAsDataURL(file);
                        }

                        // Add event listener for file input change
                        document.getElementById('p_image').addEventListener('change', handleFileSelect);

                        // Handle click event on Crop button inside modal
                        $('#cropImageButton').click(function () {
                        if (cropper) {
                        // Get cropped canvas with specified width and height
                        var scale = window.devicePixelRatio || 1;

                        var canvas = cropper.getCroppedCanvas({
                        width: 300 * scale, // To ensure high quality, scale by the device pixel ratio
                        height: 300 * scale,
                        imageSmoothingQuality: 'high', // Ensures smooth rendering
                        });

                        // Set the cropped image data to the hidden input field
                        document.getElementById('cropped_image_data').value = canvas.toDataURL();

                        // Display the cropped image
                        var croppedImageContainer = document.getElementById('croppedImageContainer');
                        croppedImageContainer.innerHTML = '';
                        croppedImageContainer.appendChild(canvas);

                        // Hide the modal
                        $('#imageCropModal').modal('hide');
                        } else {
                        alert('Cropper is not initialized properly.');
                        }
                        });
                        });
                        </script>



                        <div class="form-group">
                            <input type="submit" value="Add Faculty" class="form-control btn btn-success">
                        </div>
                        </form>



                        <!-- ==================================== end of form ====================================== -->


                        </div>
                    </div>
        </div>
      </div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select User",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select3').select2({
            placeholder: "Select Package",
            allowClear: true
        });
    });
</script>

@endsection
