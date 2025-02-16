@extends('user.common')
@section('content')

<div class="container">
  <div class="image-section position-relative">
    <img
      src="{{ url('img/image 1 (2).svg') }}"
      class="position-absolute"
      alt="Responsive image" />
  </div>

  <div class="form-section falax-box">
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

    <img src="{{ url(config('app.asset_url').'img/image 2.svg') }}" class="img-fluid profit-img" alt="" />

    <div class="head">
      <h1>Sign Up</h1>
      <p>New to our platform? Sign up now! it only take a minute</p>
    </div>
    <div class="form-container">
      <div class="user-type">
        <button class="active" id="user"> <img src="{{ url('/img/user/check_circle11.svg') }}" alt="">I am an individual user</button>
        <button id="comp"> <img src="{{ url('/img/user/check_circle.svg') }}" alt=""> We're a company</button>
      </div>
      <div id="customer">
        <form id="customer-form" action="{{ url('/userregister') }}">
          @csrf
          <div class="form-groupss">
            <div class="pholder">
              <label for="firstname">First Name</label>
              <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" />
              <span id="firstname_error" class="form-text text-danger"></span>
            </div>
            <div class="pholder">
              <label for="lastname">Last Name</label>
              <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" />
              <span id="lastname_error" class="form-text text-danger"></span>
            </div>
          </div>

          <div class="form-groupss">
            <div class="pholder">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" />
              <span id="emaillogin_error" class="form-text text-danger"></span>
            </div>
            <div class="pholder">
              <label for="mobile_number">Mobile Number</label>
              <input type="tel" id="mobile_number" name="mobile_number" class="form-control" placeholder="Mobile Number" />
              <span id="mobile_number_error" class="form-text text-danger"></span>
            </div>
          </div>

          <div class="form-groupss">
            <div class="pholder">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
              <span id="password_error" class="form-text text-danger"></span>
            </div>
            <div class="pholder">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
              <span id="password_confirmation_error" class="form-text text-danger"></span>
            </div>
          </div>


          <div class="terms">
            <input type="checkbox" id="terms" name="terms" />
            <label for="terms" id="terms-cond">I have read & accept ProfitScout's
            <a href="{{ url('/user/termsandconditions') }}">terms and conditions</a> &
            <a href="{{ url('/user/privacy') }}">privacy policy</a>.</label>


          </div>
          <span id="terms_error" class="form-text text-danger mb-2"></span>
          <button type="submit" class="signup-btn">Sign up</button>
        </form>


        <script>
          $('#email').on('input', function() {
            $('#emaillogin_error').text('');
          });

          $('#firstname').on('input', function() {
            $('#firstname_error').text('');
          });

          $('#lastname').on('input', function() {
            $('#lastname_error').text('');
          });

          $('#password').on('input', function() {
            $('#password_error').text('');
          });

          $('#password_confirmation').on('input', function() {
            $('#password_confirmation_error').text('');
          });

          $('#terms').on('input', function() {
            $('#terms_error').text('');
          });

          $('#mobile_number').on('input', function() {
            $('#mobile_number_error').text('');
          });

          $(document).ready(function() {
            $('#customer-form').on('submit', function(e) {
              e.preventDefault();


              $('.form-text.text-danger').text('');

              var form = $(this);
              var formData = form.serialize();


              $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                  if (response.success) {
                    sessionStorage.setItem('successMessage', response.message);
                    window.location.href = '/userdashboard';


                  } else {
                    sessionStorage.setItem('errorMessage', response.message);
                    window.location.href = '/signup';

                  }
                },
                error: function(xhr, status, error) {
                  var errors = xhr.responseJSON.errors;


                  $.each(errors, function(key, value) {

                    if (key == 'email') {
                      $('#emaillogin_error').text(value);
                    }
                    if (key == 'firstname') {
                      $('#firstname_error').text(value);
                    }
                    if (key == 'lastname') {
                      $('#lastname_error').text(value);
                    }
                    if (key == 'password') {
                      $('#password_error').text(value);
                    }
                    if (key == 'password_confirmation') {
                      $('#password_confirmation_error').text(value);
                    }
                    if (key == 'terms') {
                      $('#terms_error').text(value);
                    }
                    if (key == 'mobile_number') {
                      $('#mobile_number_error').text(value);
                    }
                  });
                }
              });
            });
          });
        </script>

      </div>

      <div id="company" class="d-none">
        <form id="companyForm" action="{{ url('/companyregister') }}" method="POST">
          @csrf
          <span id="general_error" class="form-text text-danger"></span>
          <div class="form-groupss">
            <div class="pholder">
              <label for="name">Company Name</label>
              <input type="text" class="form-control" placeholder="Company Name" name="name" id="name" />
              <span id="name_error" class="form-text text-danger"></span>
            </div>
            <div class="pholder">
              <label for="website">Company Website</label>
              <input type="text" class="form-control" placeholder="Company Website" name="website" id="website" />
              <span id="website_error" class="form-text text-danger"></span>
            </div>
          </div>
          <div class="form-groupss">
            <div class="pholder">
              <label for="email">Company Email Address</label>
              <input type="email" class="form-control" placeholder="Company Email Address" name="companyemail" id="companyemail" />
              <span id="companyemail_error" class="form-text text-danger"></span>
            </div>
            <div class="pholder">
              <label for="mobile_number">Company Mobile Number</label>
              <input type="number" class="form-control" placeholder="Company Mobile Number" name="companymobile_number" id="companymobile_number" />
              <span id="companymobile_number_error" class="form-text text-danger"></span>
            </div>
          </div>
          <div class="form-groupss">
            <div class="pholder">
              <label for="password">Password</label>
              <input type="password" class="form-control" placeholder="Password" name="companypassword" id="companypassword" />
              <span id="companypassword_error" class="form-text text-danger"></span>
            </div>
            <div class="pholder">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" class="form-control" placeholder="Confirm Password" name="companyconfirm_password" id="companyconfirm_password" />
              <span id="companyconfirm_password_error" class="form-text text-danger"></span>
            </div>
          </div>
          <div class="terms">
            <input type="checkbox" id="companyterms" name="companyterms" />
            <label for="terms" id="terms-cond">I have read & accept ProfitScout's
              <a href="{{ url('/user/termsandconditions') }}">terms and conditions</a> &
              <a href="{{ url('/user/privacy') }}">privacy policy</a>.</label>

          </div>
          <span id="companyterms_error" class="form-text text-danger"></span>
          <button type="submit" class="signup-btn">Sign up</button>
        </form>

        <script>
          $('#name').on('input', function() {
            $('#name_error').text('');
          });

          $('#website').on('input', function() {
            $('#website_error').text('');
          });

          $('#companyemail').on('input', function() {
            $('#companyemail_error').text('');
          });

          $('#companymobile_number').on('input', function() {
            $('#companymobile_number_error').text('');
          });

          $('#companypassword').on('input', function() {
            $('#companypassword_error').text('');
          });

          $('#companyconfirm_password').on('input', function() {
            $('#companyconfirm_password_error').text('');
          });

          $('#companyterms').on('input', function() {
            $('#companyterms_error').text('');
          });

          $('#general_error').on('input', function() {
            $('#general_error').text('');
          });
          $(document).ready(function() {

            $('#companyForm').on('submit', function(e) {
              e.preventDefault();


              $('#name_error').text('');
              $('#website_error').text('');
              $('#companyemail_error').text('');
              $('#companymobile_number_error').text('');
              $('#companypassword_error').text('');
              $('#companyconfirm_password_error').text('');
              $('#companyterms_error').text('');
              $('#general_error').text('');



              const form = $(this);
              const formData = form.serialize();


              $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                  if (response.success) {
                    sessionStorage.setItem('successMessage', response.message);
                    window.location.href = '/userdashboard';
                  } else {
                    if (response.errors) {
                      if (response.errors.name) $('#name_error').text(response.errors.name[0]);
                      if (response.errors.website) $('#website_error').text(response.errors.website[0]);
                      if (response.errors.companyemail) $('#companyemail_error').text(response.errors.companyemail[0]);
                      if (response.errors.companymobile_number) $('#companymobile_number_error').text(response.errors.companymobile_number[0]);
                      if (response.errors.companypassword) $('#companypassword_error').text(response.errors.companypassword[0]);
                      if (response.errors.companyconfirm_password) $('#companyconfirm_password_error').text(response.errors.companyconfirm_password[0]);
                      if (response.errors.companyterms) $('#companyterms_error').text(response.errors.companyterms[0]);
                    } else {
                      $('#general_error').text(response.message || 'An error occurred. Please try again.');
                    }
                  }
                },
                error: function(xhr) {
                  if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                      if (errors.name) $('#name_error').text(errors.name[0]);
                      if (errors.website) $('#website_error').text(errors.website[0]);
                      if (errors.companyemail) $('#companyemail_error').text(errors.companyemail[0]);
                      if (errors.companymobile_number) $('#companymobile_number_error').text(errors.companymobile_number[0]);
                      if (errors.companypassword) $('#companypassword_error').text(errors.companypassword[0]);
                      if (errors.companyconfirm_password) $('#companyconfirm_password_error').text(errors.companyconfirm_password[0]);
                      if (errors.companyterms) $('#companyterms_error').text(errors.companyterms[0]);
                    }
                  } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    $('#general_error').text(xhr.responseJSON.message);
                  } else {
                    $('#general_error').text('An unexpected error occurred. Please try again.');
                  }
                },
              });
            });
          });
        </script>

      </div>
      <div class="sign-in-create">
        <p class="signin-link">
          <a href="{{url('/')}}">I already have an account. Sign In</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
  const btn1 = document.getElementById("user");
  const btn2 = document.getElementById("comp");
  const div1 = document.getElementById("customer");
  const div2 = document.getElementById("company");
  const userImageActive = "{{ url('/img/user/check_circle11.svg') }}"; // Active user image
  const userImageInactive = "{{ url('/img/user/check_circle.svg') }}"; // Inactive user image
  const companyImageActive = "{{ url('/img/user/check_circle11.svg') }}"; // Active company image
  const companyImageInactive = "{{ url('/img/user/check_circle.svg') }}"; // Inactive company image

  // Function to reset button borders and images
  function resetButtonBorders() {
    btn1.style.border = "2px solid gray";
    btn2.style.border = "2px solid gray";

    // Set images for inactive buttons
    btn1.querySelector("img").src = userImageInactive;
    btn2.querySelector("img").src = companyImageInactive;
  }

  // Function to load the selected tab from session storage
  function loadSelectedTab() {
    const selectedTab = sessionStorage.getItem('selectedTab');
    if (selectedTab === 'user') {
      div1.classList.remove("d-none");
      div2.classList.add("d-none");
      resetButtonBorders();
      btn1.style.border = "2px solid green";
      btn1.querySelector("img").src = userImageActive; // Change image for active tab
    } else if (selectedTab === 'company') {
      div2.classList.remove("d-none");
      div1.classList.add("d-none");
      resetButtonBorders();
      btn2.style.border = "2px solid green";
      btn2.querySelector("img").src = companyImageActive; // Change image for active tab
    } else {
      // Default state if no tab is selected
      div1.classList.remove("d-none");
      div2.classList.add("d-none");
      resetButtonBorders();
      btn1.style.border = "2px solid green";
      btn1.querySelector("img").src = userImageActive; // Default image for active tab
    }
  }

  // Event listener for btn1 (User)
  btn1.addEventListener("click", function() {
    div1.classList.remove("d-none");
    div2.classList.add("d-none");
    resetButtonBorders();
    btn1.style.border = "2px solid green";
    btn1.querySelector("img").src = userImageActive; // Change image for active tab
    sessionStorage.setItem('selectedTab', 'user');
  });

  // Event listener for btn2 (Company)
  btn2.addEventListener("click", function() {
    div2.classList.remove("d-none");
    div1.classList.add("d-none");
    resetButtonBorders();
    btn2.style.border = "2px solid green";
    btn2.querySelector("img").src = companyImageActive; // Change image for active tab
    sessionStorage.setItem('selectedTab', 'company');
  });

  // Load the selected tab on page load
  loadSelectedTab();
</script>


<script>
  function updateFlag() {
    var selectBox = document.getElementById("countryDropdown");
    var selectedFlag =
      selectBox.options[selectBox.selectedIndex].getAttribute("data-flag");
    selectBox.style.backgroundImage = `url(${selectedFlag})`;
  }


  window.onload = updateFlag;
</script>



@endsection