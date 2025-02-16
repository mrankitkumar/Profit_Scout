@extends('user.common')
@section('content')
  <div class="containerss">
    <div class="image-section position-relative">
      <img
        src="{{ url(config('app.asset_url').'img/image 1 (2).svg') }}"
        class="position-absolute"
        alt="Responsive image" />
    </div>

    <div class="form-section">
      <div class="country-selector">
        <select id="countryDropdown" onchange="updateFlag()">
          <option value="in" data-flag="https://flagcdn.com/in.svg">
            IN
          </option>
          <option value="de" data-flag="https://flagcdn.com/de.svg">
            DE
          </option>
          <option value="fr" data-flag="https://flagcdn.com/fr.svg">
            FR
          </option>
          <option value="us" data-flag="https://flagcdn.com/us.svg">
            US
          </option>
        </select>
      </div>
      <img src="{{ url('img/image 2.svg') }}" class="img-fluid profit-img" alt="" />
      <div class="head">
        <h1>Sign In</h1>
        <p>Enter your email address and password to access customer panel</p>
      </div>
      <form id="loginForm" action="{{ url('/user/login') }}" method="post">
        @csrf
        <span id="general_error" class="form-text text-danger"></span>

        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Enter your email" name="email" />
        <span id="email_error" class="form-text text-danger"></span>

        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          placeholder="Enter your password" name="password" />
        <span id="password_error" class="form-text text-danger"></span>


        <div class="options">
          <div class="d-flex">
            <input type="checkbox" id="remember" />
            <label for="remember" style="margin-top: 0.4rem" >Remember me</label>
          </div>
          <a href="{{url('/user/forgotpassword')}}" style="margin-top: 0.4rem">Forgot Password?</a>
        </div>

        <button type="submit">Sign In</button>
      </form>
      <div class="create-account">
        <a href="{{url('/signup')}}">Create Account</a>
      </div>
    </div>
  </div>


  <script>
    $('#email').on('input', function() {
      $('#email_error').text('');
    });

    $('#password').on('input', function() {
      $('#password_error').text('');
    });

    $('#general_error').on('input', function() {
      $('#general_error').text('');
    });


    $('#email, #password').on('input', function() {
      $('#general_error').text('');
    });

    $(document).ready(function() {

      $('#loginForm').on('submit', function(e) {
        e.preventDefault();


        $('#email_error').text('');
        $('#password_error').text('');
        $('#general_error').text('');


        var form = $(this);
        var formData = form.serialize();

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
                if (response.errors.email) {
                  $('#email_error').text(response.errors.email[0]);
                }
                if (response.errors.password) {
                  $('#password_error').text(response.errors.password[0]);
                }
              } else {

                $('#general_error').text(response.message);
              }
            }
          },
          error: function(xhr) {

            if (xhr.status === 422) {

              var errors = xhr.responseJSON.errors;
              if (errors) {
                if (errors.email) {
                  $('#email_error').text(errors.email[0]);
                }
                if (errors.password) {
                  $('#password_error').text(errors.password[0]);
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





@endsection