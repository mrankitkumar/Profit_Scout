@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/changepasswordadmin.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')


<div class="container-fluid">
    <form id="changepassword-form" method="POST" action="{{ route('adminchangepasswordpost') }}">
        @csrf
        
        <div class="card adminchangepassword">
            <div class="card-header changepasswordpart">
                <h3 class="heading">Change Password</h3>
            </div>
            <span id="general1_error" class="form-text text-danger mb-2 ml-3"></span>

            <div class="card-body">
                <div class="col">
                    <div class="col-sm-7 col-md-6">
                        <div class="form-group">
                            <label>Current Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Enter"
                                    name="current-password"
                                    id="current-password" />
                                <span class="input-group-text togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <span id="current-password_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-7 col-md-6">
                        <div class="form-group">
                            <label>New Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Enter ..."
                                    name="new-password"
                                    id="new-password" />
                                <span class="input-group-text togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <span id="new-password_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-7 col-md-6">
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Enter ..."
                                    name="confirm-password"
                                    id="confirm-password" />
                                <span class="input-group-text togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <span id="confirm-password_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class=" col-sm-7 col-md-6 ">
                        <button
                            type="submit"
                            class="btn btn-block submitbutton btn-sm">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.togglePassword').forEach(item => {
            item.addEventListener('click', function() {
                const field = this.previousElementSibling;
                field.type = field.type === 'password' ? 'text' : 'password';
            });
        });

       
        $('#current-password, #new-password, #confirm-password').on('input', function() {
            $('#' + this.name + '_error').text('');
            $('#general1_error').text('');
        });

        $(document).ready(function() {
            $('#changepassword-form').on('submit', function(e) {
                e.preventDefault();

                $('#general1_error').text('');
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
                            window.location.reload();
                        }

                    },
                    error: function(xhr) {
                       // console.log(xhr);
                       
                            
                       //alert();
                       $('#general1_error').text(xhr.responseJSON.message);
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

                        } else if (xhr.responseJSON.message) {
                           
                            $('#general1_error').text(xhr.responseJSON.message);
                        } else {

                            $('#general1_error').text('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    });
</script>
@endsection