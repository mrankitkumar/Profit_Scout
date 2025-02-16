@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/editcustomer.css') }}" />
@section('content')
<div class="container-fluid">
<form id="editProfileForm" action="{{ url('/admin/editcustomber') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3 editcustomerpart">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center" id="dropZone">
                        <img
                            class="userimage1 img-fluid img-rectangle"
                            src="{{ $customber->profile_picture ? url($customber->profile_picture) : url('img/admin/imageexample.png') }}"
                            alt="User profile picture"
                            id="uploadPreview" />
                        <i class="fas fa-camera camera-icon d-block" id="cameraIcon"></i>
                        <input type="file" id="fileInput" name="profile_picture" accept="image/*" style="display: none" />
                    </div>
                    <p class="profile-username text-center">Upload Profile Photo</p>
                    <span id="profile_picture_error" class="form-text text-danger"></span>
                </div>
                <input type="hidden" name="customberid" value="{{ $customber->id }}">
            </div>
        </div>

        <div class="col-md-9 editcustomerpart">
            <div class="card">
                <div class="card-header p-2">
                    <h3>Edit Customer</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="first_name"
                                    placeholder="Enter ..."
                                    value="{{ $customber->first_name }}" />
                                <span id="first_name_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="last_name"
                                    placeholder="Enter ..."
                                    value="{{ $customber->last_name }}" />
                                <span id="last_name_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <select
                                    class="form-select smallwidth"
                                    name="gender"
                                    aria-label="Gender">
                                    <option>Gender</option>
                                    <option value="Male" {{ $customber->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $customber->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $customber->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <span id="gender_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    placeholder="Enter ..."
                                    value="{{ $customber->email }}" />
                                <span id="email_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="mobile_number"
                                    placeholder="Enter ..."
                                    value="{{ $customber->mobile_number }}" />
                                <span id="mobile_number_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Address Line 1</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="address_line_1"
                                    placeholder="Enter ..."
                                    value="{{ $customber->address_line_1 }}" />
                                <span id="address_line_1_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Address Line 2</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="address_line_2"
                                    placeholder="Enter ..."
                                    value="{{ $customber->address_line_2 }}" />
                                <span id="address_line_2_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>City</label>
                                <select class="form-select smallwidth" name="city" aria-label="City">
                                    <option selected>City</option>
                                    @foreach ($city as $val)
                                        <option value="{{ $val->id }}" {{ $val->id == $customber->city ? 'selected' : '' }}>
                                            {{ $val->cityname }}
                                        </option>
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
                                    <option>Country</option>
                                    @foreach ($country as $val)
                                        <option value="{{ $val->id }}" {{ $val->id == $customber->country ? 'selected' : '' }}>
                                            {{ $val->countryname }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="country_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="postal_code"
                                    placeholder="Enter ..."
                                    value="{{ $customber->postal_code }}" />
                                <span id="postal_code_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @livewire('admin-user-subscription', ['id' => $customber->id])
            <div class="row mt-3">
                <div class="col-md-3">
                    <button type="submit" class="btn Save btn-success btn-sm">Save</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('/admin/managecustomber') }}" class="btn btn-block back btn-sm">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#editProfileForm').on('submit', function (event) {
            event.preventDefault();
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
                        sessionStorage.setItem('successMessage', 'Profile updated successfully!');
                        window.location.reload();
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            $(`#${key}_error`).text(errors[key][0]);
                        }
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                }
            });
        });
    });
</script>

</div>

<script>
    const dropZone = document.getElementById("dropZone");
    const fileInput = document.getElementById("fileInput");
    const uploadPreview = document.getElementById("uploadPreview");
    const cameraIcon = document.getElementById("cameraIcon");
    const changeprofile = document.getElementById("changeprofile")

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
                    cameraIcon.style.display = "none"; // Hide the camera icon
                    changeprofile.textContent = "Change Profile Photo";
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".statusButton");

        // Function to update button styles based on text content
        function updateButtonStyles() {
            buttons.forEach((button) => {
                if (button.textContent === "Active") {
                    button.style.backgroundColor = "#D3F3DF"; // Green background
                    button.style.color = "#30C37C";
                } else if (button.textContent === "Inactive") {
                    button.style.backgroundColor = "#FFE2D5"; // yellow background
                    button.style.color = "#FF6C2F";
                } else if (button.textContent == "Cancelled") {
                    button.style.backgroundColor = "#EBEBEB"; // blue
                    button.style.color = "#8C8C8C";
                }
                // Common button styles
                button.style.width = "98px";
                button.style.height = "36px";
                button.style.borderRadius = "5px";
                button.style.border = "none";
                button.style.fontSize = "14px";
                button.style.fontFamily = "Inter";
                button.style.lineHeight = "21px";
            });
        }

        // Initial call to set the button styles
        updateButtonStyles();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the query parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const customerId = urlParams.get("id");

        if (customerId) {
            // Display the customer ID (for testing)
            console.log("Customer ID:", customerId);
            document.querySelector("span").textContent = `#${customerId}`;
            // Fetch and display customer data based on the ID
            fetchCustomerData(customerId);
        }
    });

    // Function to fetch customer data (replace with your API endpoint)
    function fetchCustomerData(customerId) {
        // Simulate an API call to fetch data
        const mockData = {
            id: "CST1234",
            firstName: "Michael",
            lastName: "Kane",
            gender: "male",
            email: "name@example.com",
            phone: "0987654321",
            address1: "marathalli",
            address2: "manjunathlayout",
            city: "bangalore",
            country: "India",
            postal: "232323"
        };

        // Populate form fields with mock data
        if (mockData.id === customerId) {
            document.querySelector("#firstName").value = mockData.firstName;
            document.querySelector("#lastName").value = mockData.lastName;
            document.querySelector("#email").value = mockData.email;
            document.querySelector("#phone").value = mockData.phone;
            document.querySelector("#gender").value = mockData.gender;
            document.querySelector("#address1").value = mockData.address1;
            document.querySelector("#address2").value = mockData.address2;
            document.querySelector("#city").value = mockData.city;
            document.querySelector("#country").value = mockData.country;
            document.querySelector("#postal").value = mockData.postal;
        }
    }
</script>

@endsection