@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/addcompany.css') }}" />
@section('content')

<div class="container-fluid">
    <form id="addCompanyForm" action="{{ route('admin.postaddcompany') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3 addcompanypart">
                <div class="card">
                    <div class="card-body box-profile">
                        <div class="text-center" id="dropZone">
                            <img class="img-fluid img-rectangle" src="{{ url('/img/admin/userIcon.svg') }}" alt="">
                            <i class="fas fa-camera camera-icon" id="cameraIcon"></i>
                            <img
                                class="profile-user-img img-fluid d-none img-rectangle"
                                src="https://bit.ly/dan-abramov"
                                alt="User profile picture"
                                id="uploadPreview" />
                            <input
                                type="file"
                                id="fileInput"
                                accept="image/*"
                                name="profile_photo"
                                style="display: none" />
                        </div>
                        <p class="profile-username text-center">Upload Profile Photo</p>
                        <span id="uploadPhoto_error" class="form-text text-danger"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-9 addcompanypart">
                <div class="card">
                    <div class="card-header p-2">
                        <h3>Add Company</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="companyname" />
                                    <span id="companyname_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter ..." name="email" />
                                    <span id="email_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="number" class="form-control" placeholder="Enter ..." name="mobile" />
                                    <span id="mobile_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="address_line1" />
                                    <span id="address_line1_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="address_line2" />
                                    <span id="address_line2_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-select" name="city">
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
                                    <select class="form-select" name="country">
                                        <option value="" selected>Country</option>
                                        @foreach ($country as $val)
                                        <option value="{{ $val->id }}">{{ $val->countryname }}</option>
                                        @endforeach
                                    </select>
                                    <span id="country_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="postal_code" />
                                    <span id="postal_code_error" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <button
                                    type="button"
                                    id="submitForm"
                                    class="btn submit btn-success btn-sm">
                                    Submit
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{url('/admin/managecustomber')}}">
                                    <button
                                        type="button"
                                        class="btn  back btn-sm">
                                        Back
                                    </button>
                                </a>
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
    $(document).ready(function() {
        $('#submitForm').on('click', function() {
            const formData = new FormData($('#addCompanyForm')[0]);

            // AJAX call
            $.ajax({
                url: $('#addCompanyForm').attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // Clear previous error messages
                    $('.form-text.text-danger').text('');
                },
                success: function(response) {
                    if (response.success) {
                        sessionStorage.setItem('successMessage', response.message);
                        window.location.href = "{{ url('/admin/managecustomber') }}";
                    }
                },
                error: function(xhr) {
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
                    cameraIcon.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>
@endsection