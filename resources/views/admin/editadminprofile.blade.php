@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/editprofile.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')



<div class="container-fluid">
  
    <form id="editProfileForm" method="POST" action="{{ route('editadminprofilepost') }}">
    @csrf
    <!-- Your form fields -->


        <div class="card myprofile">
            <div class="card-header settingpart">
                <h3>My Profile</h3>
            </div>
            <div class="card-body">
            <input type="hidden" name="key" value="{{ Auth::user()->id }}">

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>First Name</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter ..."
                                value="{{ Auth::user()->first_name }}"
                                name="first_name" />
                            <span id="first_name_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter ..."
                                name="last_name"
                                value="{{ Auth::user()->last_name }}" />
                            <span id="last_name_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="Enter"
                                name="email"
                                value="{{ Auth::user()->email }}" />
                            <span id="email_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="Enter ..."
                                name="mobile_number"
                                value="{{ Auth::user()->mobile_number }}" />
                            <span id="mobile_number_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <button
                            type="button"
                            id="saveProfile"
                            class="btn btn-block submitbutton btn-sm">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#saveProfile').on('click', function() {
            const formData = new FormData($('#editProfileForm')[0]);
           // console.log(formData);
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
                        sessionStorage.setItem('errorMessage', 'Something went wrong. Please try again.');
                      //  window.location.reload();
                    }
                }
            });
        });
    });
</script>

@endsection