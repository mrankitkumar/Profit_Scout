<?php
$curr_route = Route::currentRouteName();
//dd($curr_route);exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark nav-bg-color container-fluid">
    <div class="nav-full">
      <div class="d-flex align-items-center nav-dash-faa">
        <a class="navbar-brand" href="#">
          <img
            src="{{ url('img/image 2.svg') }}"
            alt="ProfitScout Logo"
            class="d-inline-block img-fluid align-text-top nav-logo" />
        </a>

        <div class="nav-cont-drop d-flex">
          <div class="dropdown d-dash-nev me-3">
            <button
              class="btn dropdown-toggle coun-dropdown"
              type="button"
              id="countryDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              @if($curr_route == 'userdashboard')
              <img src="{{ url('/img/user/Frame (4).svg') }}" alt="">
              @else
              <img src="{{ url('/img/user/Frame (11).svg') }}" alt="">
              @endif Dashboard
            </button>

            <div class="dropdown-menu" aria-labelledby="countryDropdown">
              <a
                class="dropdown-item {{$curr_route == 'userdashboard' ? 'active' : ''}}"
                href="{{ url('/userdashboard') }}"
                data-id="dashboard"
                onclick="highlightMenuItem(this)">


                @if($curr_route == 'userdashboard')
                <img src="{{ url('/img/user/Frame (4).svg') }}" alt="">
                @else
                <img src="{{ url('/img/user/Frame (11).svg') }}" alt="">
                @endif

                Dashboard

              </a>
              <a
                class="dropdown-item"
                href="{{ url('/user/myproduct') }}"
                data-id="product-list"
                onclick="highlightMenuItem(this)">

                @if(in_array($curr_route, ['myproduct', 'viewmyproduct', 'viewdetailproduct']))
                <img src="{{ url('/img/user/Frame.svg') }}" alt="">
                @else
                <img src="{{ url('/img/user/Frame (5).svg') }}" alt="">
                @endif


                My Product Lists</a>
              <a
                class="dropdown-item"
                href="{{ url('/user/mysubscription') }}"
                data-id="subscription"
                onclick="highlightMenuItem(this)">
                @if($curr_route == 'mysubscription')
                <img src="{{ url('/img/user/Frame (10).svg') }}" alt="">
                @else
                <img src="{{ url('/img/user/Frame (6).svg') }}" alt="">
                @endif
                My Subscription</a>
              <a
                class="dropdown-item"
                href="{{ url('/user/faq') }}"
                data-id="faqs"
                onclick="highlightMenuItem(this)">
                @if($curr_route == 'userfaq')
                <img src="{{ url('/img/user/Frame (9).svg') }}" alt="">
                @else
                <img src="{{ url('/img/user/Frame (7).svg') }}" alt="">
                @endif
                FAQs
              </a>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link {{$curr_route == 'userdashboard' ? 'active' : ''}}"
                  href="{{ url('/userdashboard') }}"
                  data-id="dashboard"
                  onclick="highlightMenuItem(this)">

                  @if($curr_route == 'userdashboard')
                  <img src="{{ url('/img/user/Frame (4).svg') }}" alt="">
                  @else
                  <img src="{{ url('/img/user/Frame (11).svg') }}" alt="">
                  @endif

                  Dashboard



                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link {{ in_array($curr_route, ['myproduct', 'viewmyproduct', 'viewdetailproduct']) ? 'active' : '' }}"
                  href="{{ url('/user/myproduct') }}"
                  data-id="product-list"
                  onclick="highlightMenuItem(this)">

                  @if(in_array($curr_route, ['myproduct', 'viewmyproduct', 'viewdetailproduct']))
                  <img src="{{ url('/img/user/Frame.svg') }}" alt="">
                  @else
                  <img src="{{ url('/img/user/Frame (5).svg') }}" alt="">
                  @endif



                  My Product Lists


                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link {{$curr_route == 'mysubscription' ? 'active' : ''}}"
                  href="{{ url('/user/mysubscription') }}"
                  data-id="subscription"
                  onclick="highlightMenuItem(this)">
                  @if($curr_route == 'mysubscription')
                  <img src="{{ url('/img/user/Frame (10).svg') }}" alt="">
                  @else
                  <img src="{{ url('/img/user/Frame (6).svg') }}" alt="">
                  @endif



                  My Subscription</a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link {{$curr_route == 'userfaq' ? 'active' : ''}}"
                  href="{{ url('/user/faq') }}"
                  data-id="faqs"
                  onclick="highlightMenuItem(this)">
                  @if($curr_route == 'userfaq')
                  <img src="{{ url('/img/user/Frame (9).svg') }}" alt="">
                  @else
                  <img src="{{ url('/img/user/Frame (7).svg') }}" alt="">
                  @endif



                  FAQs</a>
              </li>
            </ul>
          </div>

          <div class="dropdown me-3">
            <button
              class="btn dropdown-toggle coun-dropdowns"
              type="button"
              id="countryDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              <img
                src="https://flagcdn.com/in.svg"
                alt="India Flag"
                width="20" />
              IN
            </button>

            <div class="dropdown-menu" aria-labelledby="countryDropdown">
              <a class="dropdown-item" href="#" onclick="changeCountry('IN')">
                <img
                  src="https://flagcdn.com/in.svg"
                  alt="India Flag"
                  width="20" />
                IN
              </a>
              <a class="dropdown-item" href="#" onclick="changeCountry('DE')">
                <img
                  src="https://flagcdn.com/de.svg"
                  alt="Germany Flag"
                  width="20" />
                DE
              </a>
              <a class="dropdown-item" href="#" onclick="changeCountry('FR')">
                <img
                  src="https://flagcdn.com/fr.svg"
                  alt="France Flag"
                  width="20" />
                FR
              </a>
            </div>
          </div>

          <div class="dropdown user-d-down">
            <button
              class="btn btn-secondary dropdown-toggles d-flex align-items-center"
              type="button"
              id="userDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              <img
                src="{{ Auth::user()->profile_picture ? url(Auth::user()->profile_picture) : url('/img/Ellipse 6.png') }}"
                alt="User"
                width="30"
                height="30"
                class="rounded-circle me-2" />
              {{Auth::user()->first_name}}
              <img
                src="{{ url('/img/ico_settings.png') }}"
                alt="User"
                width="30"
                height="30"
                class="rounded-circle me-2" />
            </button>
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="{{ url('/user/editprofile') }}">
                  <img
                    src="{{ url('/img/edit-profile.svg') }} "
                    class="img-fluid"
                    alt="" />
                  Profile</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url('/user/changepassword') }}">
                  <img src="{{ url('/img/lock.svg') }} " class="img-fluid" alt="" />
                  Change Password</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url('/user/termsandconditions') }}">
                  <img
                    src="{{ url('/img/edit-profile.svg') }} "
                    class="img-fluid"
                    alt="" />
                    Terms and Services</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url('/user/privacy') }}">
                  <img src="{{ url('/img/lock.svg') }} " class="img-fluid" alt="" />
                  Privacy Policy</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url('/user/kycpolicy') }}">
                  <img src="{{ url('/img/lock.svg') }} " class="img-fluid" alt="" />
                  AML Policy</a>
              </li>

              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item"

                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal">
                  <img
                    src="{{ url('img/logout.svg') }} "
                    class="img-fluid"
                    alt="" />
                  Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <script>
    const countries = [{
        name: "US",
        code: "US",
        flag: "https://flagcdn.com/w40/us.png",
      },
      {
        name: "IN",
        code: "IN",
        flag: "https://flagcdn.com/w40/in.png",
      },
      {
        name: "UK",
        code: "GB",
        flag: "https://flagcdn.com/w40/gb.png",
      },
      {
        name: "CA",
        code: "CA",
        flag: "https://flagcdn.com/w40/ca.png",
      },
      {
        name: "AU",
        code: "AU",
        flag: "https://flagcdn.com/w40/au.png",
      },
    ];

    const countryList = document.getElementById("countryList");
    const selectedCountry = document.getElementById("selected-country");

    // Populate the dropdown with country names
    countries.forEach((country) => {
      const listItem = document.createElement("li");
      listItem.innerHTML = `
                <a class="dropdown-item" href="#" onclick="selectCountry('${country.name}', '${country.flag}')">
                    <img src="${country.flag}" alt="${country.name} Flag" class="me-2" width="20" height="15">
                    ${country.name}
                </a>
            `;
      countryList.appendChild(listItem);
    });

    // Function to update the selected country
    function selectCountry(countryName, flagUrl) {
      selectedCountry.innerHTML = `
                <img src="${flagUrl}" alt="Selected Flag" class="me-2" width="20" height="15">
                ${countryName}
            `;
    }
  </script>
</body>

</html>