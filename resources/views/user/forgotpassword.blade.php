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
    <a href="{{ url('/') }}">
      <img
        src="{{ url('img/vector.svg') }}"
        class="img-fluid "
        style="width: 6%; margin-bottom: 2rem"

        alt="" />
    </a>
    <img src="{{ url(config('app.asset_url').'img/image 2.svg') }}" class="img-fluid profit-img" alt="" />
    <div class="head-f">
      <h1>Frogot Password</h1>
      <p>Enter your register email address to continue</p>
    </div>
    <form id="forgotpassword" action="{{ url('/user/forgotpassword') }}" method="post">
      @csrf
      <span id="general_error" class="form-text text-danger mb-2"></span>
      <label for="email">Email Address</label>
      <input type="email" id="email" placeholder="Enter your email" name="email" />
      <span id="email_error" class="form-text text-danger mb-2"></span>
      <button type="submit">Submit</button>
    </form>

    <script>
      $(document).ready(function() {
        // Clear email error on input change
        $('#email').on('input', function() {
          $('#email_error').text('');
        });

        // Clear general error on input change
        $('#general_error').on('input', function() {
          $('#general_error').text('');
        });

        // Handle form submission
        $('#forgotpassword').on('submit', function(e) {
          e.preventDefault();

          // Reset error messages
          $('#email_error').text('');
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
                // window.location.reload();
              
                sessionStorage.setItem('successMessage', response.message);
                window.location.reload();

              } else {

                if (response.errors) {
                  if (response.errors.email) {
                    $('#email_error').text(response.errors.email[0]);
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

<script>
  function updateFlag() {
    var selectBox = document.getElementById("countryDropdown");
    var selectedFlag =
      selectBox.options[selectBox.selectedIndex].getAttribute("data-flag");
    selectBox.style.backgroundImage = `url(${selectedFlag})`;
  }

  // Initialize flag on page load
  window.onload = updateFlag;
</script>


@endsection