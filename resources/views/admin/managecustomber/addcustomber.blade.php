@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/addcustomer.css') }}" />
@section('content')

<div class="container-fluid">
    <form id="addCustomberForm" action="{{ route('admin.postaddcustomber') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3 addcustomerpart">
                <div class="card">
                    <div class="card-body box-profile">
                        <div class="text-center" id="dropZone">
                            <img class="img-fluid img-rectangle" src="{{ url('/img/admin/userIcon.svg') }}" alt="">
                            <i class="fas fa-camera camera-icon" id="cameraIcon"></i>
                            <img class="profile-user-img img-fluid d-none img-rectangle" src="https://bit.ly/dan-abramov" alt="User profile picture" id="uploadPreview" />
                            <input type="file" id="fileInput" name="profile_photo" accept="image/*" style="display: none" />
                        </div>
                        <p class="profile-username text-center">Upload Profile Photo</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9 addcustomerpart">
                <div class="card">
                    <div class="card-header p-2">
                        <h3>Add Customer</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="Enter ..." />
                                    <span id="first_name_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Enter ..." />
                                    <span id="last_name_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-select smallwidth" name="gender" aria-label="Gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <span id="gender_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter ..." />
                                    <span id="email_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="number" class="form-control" name="mobile_number" placeholder="Enter ..." />
                                    <span id="mobile_number_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <input type="text" class="form-control" name="address_line_1" placeholder="Enter ..." />
                                    <span id="address_line_1_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input type="text" class="form-control" name="address_line_2" placeholder="Enter ..." />
                                    <span id="address_line_2_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-select smallwidth" name="city" aria-label="City">
                                        <option value="">Select City</option>
                                       
                                        @foreach ($city as $val)
                                        <option value="{{ $val->id }}">{{ $val->cityname }}</option>
                                        @endforeach
                                    </select>
                                    <span id="city_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-select smallwidth" name="country" aria-label="Country">
                                        <option value="">Select Country</option>
                                        @foreach ($country as $val)
                                        <option value="{{ $val->id }}" >{{ $val->countryname }}</option>
                                        @endforeach
                                    </select>
                                    <span id="country_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" placeholder="Enter ..." />
                                    <span id="postal_code_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" class="btn submit btn-sm">Submit</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('/admin/managecustomber') }}" class="btn back btn-sm">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#addCustomberForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
            const formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.form-text.text-danger').text('');
                },
                success: function (response) {
                    if (response.success) {
                        sessionStorage.setItem('successMessage', response.message);
                        window.location.href = "{{ url('/admin/managecustomber') }}";
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            $(`#${key}_error`).text(errors[key][0]);
                        }
                    } else {
                        sessionStorage.setItem('errorMessage', 'Something went wrong. Please try again.');
                    }
                },
            });
        });
    });
</script>



<script>
    const dropZone = document.getElementById("dropZone");
    const fileInput = document.getElementById("fileInput");
    const uploadPreview = document.getElementById("uploadPreview");
    const cameraIcon = document.getElementById("cameraIcon");

    // Open file selector on click
    dropZone.addEventListener("click", () => {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener("change", (event) => {
        const files = event.target.files;
        handleFiles(files);
    });

    // Process files
    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    uploadPreview.src = e.target.result;
                    uploadPreview.classList.remove("d-none"); // Show the uploaded image
                    cameraIcon.style.display = "block"; // Hide the camera icon
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>

@endsection