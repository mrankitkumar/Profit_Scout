@extends('user.master')
@section('title', 'test')
@section('content')
<link rel="stylesheet" href="{{ url("css/edit.css")}}" />
<div class="content-header bcolor">
    <div class="container-fluid">
        <h1 class="pro-file  "> My Profile</h1>
        <form id="editProfileForm" action="{{ url('/user/editprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="respon d-flex">
                <div class="box-profile">
                    <div class="profile-photo-container">
                        <div class="profile-photo">

                            <img
                                class="img-fluid"
                                src="{{ Auth::user()->profile_picture ? url(Auth::user()->profile_picture) : url('/img/admin/userIcon.svg') }}"
                                alt="Profile Photo"
                                id="profilePreview" />

                            <img
                                class="img-fluid camimg"
                                src="{{ url('img/user/cam.svg') }}"
                                alt="Profile Photo" />
                            <input type="file" id="uploadPhoto" name="profile_photo" accept="image/*" hidden />
                            <label for="uploadPhoto">Upload Profile Photo</label>
                            <span id="uploadPhoto_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first_name" placeholder="Enter" value="{{ Auth::user()->first_name }}" />
                            <span id="first_name_error" class="form-text text-danger"></span>
                        </div>
                        <div class="col-lg-3">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last_name" placeholder="Enter" value="{{ Auth::user()->last_name }}" />
                            <span id="last_name_error" class="form-text text-danger"></span>
                        </div>
                        <div class="col-lg-3">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender">
                                <option value="">Select</option>
                                <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ Auth::user()->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <span id="gender_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter" value="{{ Auth::user()->email }}" />
                            <span id="email_error" class="form-text text-danger"></span>
                        </div>
                        <div class="col-lg-3">
                            <label for="mobile">Mobile Number</label>
                            <input type="text" id="mobile" name="mobile_number" placeholder="Enter" value="{{ Auth::user()->mobile_number }}" />
                            <span id="mobile_number_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="address-line-1">Address Line 1</label>
                            <input type="text" id="address-line-1" name="address_line_1" placeholder="Enter" value="{{ Auth::user()->address_line_1 }}" />
                            <span id="address_line_1_error" class="form-text text-danger"></span>
                        </div>
                        <div class="col-lg-3">
                            <label for="address-line-2">Address Line 2</label>
                            <input type="text" id="address-line-2" name="address_line_2" placeholder="Enter" value="{{ Auth::user()->address_line_2 }}" />
                            <span id="address_line_2_error" class="form-text text-danger"></span>
                        </div>
                        <div class="col-lg-3">
                            <label for="city">City</label>
                            <select id="city" name="city">
                                <option value="">Select</option>
                                @foreach ($city as $val)
                                <option value="{{ $val->id }}" {{ $val->id ==  Auth::user()->city ? 'selected' : '' }}>
                                    {{ $val->cityname }}
                                </option>
                                @endforeach
                            </select>
                            <span id="city_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="country">Country</label>
                            <select id="country" name="country">
                                <option value="">Select</option>
                                @foreach ($country as $val)
                                <option value="{{ $val->id }}" {{ $val->id ==  Auth::user()->country ? 'selected' : '' }}>
                                    {{ $val->countryname }}
                                </option>
                                @endforeach
                            </select>
                            <span id="country_error" class="form-text text-danger"></span>
                        </div>
                        <div class="col-lg-3">
                            <label for="postal-code">Postal Code</label>
                            <input type="text" id="postal-code" name="postal_code" placeholder="Enter" value="{{ Auth::user()->postal_code }}" />
                            <span id="postal_code_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <button type="button" id="saveProfile">Save</button>
                </div>
            </div>
        </form>

        <script>
            const uploadPhotoInput = document.getElementById('uploadPhoto');
            const profilePreview = document.getElementById('profilePreview');

            uploadPhotoInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        profilePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#saveProfile').on('click', function() {
                    const formData = new FormData($('#editProfileForm')[0]);
                    console.log(formData);
                    $.ajax({
                        url: $('#editProfileForm').attr('action'),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {

                            $('.form-text.text-danger').text('');
                        },
                        success: function(response) {
                            if (response.success) {
                                sessionStorage.setItem('successMessage', 'Profile updated successfully!');
                                window.location.reload();
                            }

                        },
                        error: function(xhr) {

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
</div>
@endsection