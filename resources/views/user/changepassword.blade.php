@extends('user.master')
@section('title', 'test')
@section('content')
<link rel="stylesheet" href="{{ url("css/changepasword.css")}}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="content-header">
    <div class="container-fluid">
        <div class="change-cont">
            <h1>Change Password</h1>
            <div class="containerss-fluid body-bgound">
                <form id="changepassword-form" action="{{ url('/user/changepassword') }}" method="post">
                    @csrf
                    <span id="general_error" class="form-text text-danger mb-2"></span>
                    <div class="form-groupss">
                        <label for="current-password">Current Password</label>
                        <div class="password-wrapperss">
                            <input
                                type="password"
                                id="current-password"
                                placeholder="Enter"
                                name="current-password" />
                            <span
                                class="toggle-passwordss"
                                onclick="togglePassword('current-password')"><img src="{{ url('/img/user/eyespas.svg') }}" alt="" /></span>
                        </div>
                        <span id="current-password_error" class="form-text text-danger"></span>
                    </div>
                    <div class="form-groupss">
                        <label for="new-password">New Password</label>
                        <div class="password-wrapperss">
                            <input
                                type="password"
                                id="new-password"
                                placeholder="Enter"
                                name="new-password" />
                            <span
                                class="toggle-passwordss"
                                onclick="togglePassword('new-password')"><img src="{{ url('/img/user/eyespas.svg') }}" alt="" /></span>
                        </div>
                        <span id="new-password_error" class="form-text text-danger"></span>
                    </div>
                    <div class="form-groupss">
                        <label for="confirm-password">Confirm New Password</label>
                        <div class="password-wrapperss">
                            <input
                                type="password"
                                id="confirm-password"
                                placeholder="Enter"
                                name="confirm-password" />
                            <span
                                class="toggle-passwordss"
                                onclick="togglePassword('confirm-password')"><img src="{{ url('/img/user/eyespas.svg') }}" alt="" /></span>
                        </div>
                        <span id="confirm-password_error" class="form-text text-danger text-wrap"></span>
                    </div>
                    <button type="submit" class="btn-submitss">Submit</button>
                </form>

                <script>
                    function togglePassword(fieldId) {
                        const field = document.getElementById(fieldId);
                        field.type = field.type === 'password' ? 'text' : 'password';
                    }
                    // Clear the general and field-specific error messages when the user starts typing
                    $('#current-password').on('input', function() {
                        $('#current-password_error').text('');
                    });

                    $('#new-password').on('input', function() {
                        $('#new-password_error').text('');
                    });

                    $('#confirm-password').on('input', function() {
                        $('#confirm-password_error').text('');
                    });

                    
                    $('#current-password, #new-password, #confirm-password').on('input', function() {
                        $('#general_error').text('');
                    });


                    $(document).ready(function() {
                        $('#changepassword-form').on('submit', function(e) {
                            e.preventDefault();

                            
                            $('#general_error').text('');
                            $('#current-password_error').text('');
                            $('#new-password_error').text('');
                            $('#confirm-password_error').text('');

                            const form = $(this);
                            const formData = form.serialize();

                            $.ajax({
                                url: form.attr('action'),
                                type: "POST",
                                data: formData,
                                dataType: "json",
                                success: function(response) {
                                    if (response.success) {
                                        sessionStorage.setItem('successMessage', response.message);
                                        window.location.href = "/userdashboard";
                                    } else {
                                        if (response.errors) {
                                            if (response.errors['current-password']) {
                                                $('#current-password_error').text(response.errors['current-password'][0]);
                                            }
                                            if (response.errors['new-password']) {
                                                $('#new-password_error').text(response.errors['new-password'][0]);
                                            }
                                            if (response.errors['confirm-password']) {
                                                $('#confirm-password_error').text(response.errors['confirm-password'][0]);
                                            }
                                        } else {
                                            $('#general_error').text(response.message);
                                        }
                                    }
                                },
                                error: function(xhr) {
                                    if (xhr.status === 422) {
                                        const errors = xhr.responseJSON.errors;
                                        if (errors) {
                                            if (errors['current-password']) {
                                                $('#current-password_error').text(errors['current-password'][0]);
                                            }
                                            if (errors['new-password']) {
                                                $('#new-password_error').text(errors['new-password'][0]);
                                            }
                                            if (errors['confirm-password']) {
                                                $('#confirm-password_error').text(errors['confirm-password'][0]);
                                            }
                                        }
                                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                        $('#general_error').text(xhr.responseJSON.message);
                                    } else {
                                        $('#general_error').text('An unexpected error occurred. Please try again.');
                                    }
                                }
                            });
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>

@endsection