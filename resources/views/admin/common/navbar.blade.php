<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navbar</title>
    
    <link rel="stylesheet" href="{{ url('css/navbar.css') }}" />
  </head>
  <body >
    <nav class="main-header navbar navbar-expand  container-fluid" >
      <ul class="navbar-nav ">
        <li class="nav-item d-flex">
          <a
            class="nav-link anchor1"
            data-widget="pushmenu"
            href="#"
            role="button"
          >
           <i class="fas fa-bars"></i>
            Welcome
           
          </a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li> -->
      </ul>

      <ul
        class="navbar-nav ml-auto d-flex align-items-center justify-content-center"
      >
        <li class="nav-item">
          <!-- <div class="d-flex justify-content-center align-items-center position-relative  h-100">
            <div class="custom-select-wrapper">
            
              <select
                id="countryDropdown"
                class="form-select"
                onchange="updateFlag()"
                style="border: 1px solid green"
              >
                <option value="IN"  data-flag="https://flagcdn.com/in.svg">
                  IN
                </option>
                <option value="DE" data-flag="https://flagcdn.com/de.svg">
                  DE
                </option>
                <option value="FR" data-flag="https://flagcdn.com/fr.svg">
                  FR
                </option>
                <option value="US" data-flag="https://flagcdn.com/us.svg">
                  US
                </option>
              </select>
            </div>
          </div> -->

          <div class="dropdown me-3">
            <button
              class="btn dropdown-toggle coun-dropdowns"
              type="button"
              id="countryDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <img
                src="https://flagcdn.com/in.svg"
                alt="India Flag"
                width="20"
              />
              IN
            </button>

            <div class="dropdown-menu" aria-labelledby="countryDropdown">
              <a class="dropdown-item" href="#" onclick="changeCountry('IN')">
                <img
                  src="https://flagcdn.com/in.svg"
                  alt="India Flag"
                  width="20"
                />
                IN
              </a>
              <a class="dropdown-item" href="#" onclick="changeCountry('DE')">
                <img
                  src="https://flagcdn.com/de.svg"
                  alt="Germany Flag"
                  width="20"
                />
                DE
              </a>
              <a class="dropdown-item" href="#" onclick="changeCountry('FR')">
                <img
                  src="https://flagcdn.com/fr.svg"
                  alt="France Flag"
                  width="20"
                />
                FR
              </a>
            </div>
          </div>
        </li>
        <!-- User Profile Icon -->
        <li class="nav-item font-larger">
          <a
            class="nav-link"
            data-widget="navbar-search"
            href="#"
            role="button"
          >
            <img src="{{ url('/img/admin/Ellipse 6.png') }}" alt="User" class="userimage" />
          </a>
        </li>

        <!-- Administrator Text -->
        <li class="nav-item">
          <p class="text-sm mt-2 admintext">Admin</p>
        </li>

        <!-- Settings Icon -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img
              src="{{ url('/img/admin/ico_settings.png') }}"
              alt="setting"
              class="setting"
            />
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <!-- Message 1 -->
            <a href="{{ url('/admin/editprofile') }}" class="dropdown-item">
              <div class="media d-flex align-items-center">
                <img
                  src="{{ url('/img/admin/edit-profile.svg') }}"
                  alt="edit"
                  class="mr-2 editprofile"
                />

                <p class="dropdown-item-title mb-0">Edit Profile</p>
              </div>
            </a>

            <!-- <div class="dropdown-divider"></div> -->
            <!-- Message 2 -->
            <a href="{{ url('/admin/changepassword') }}" class="dropdown-item">
              <div class="media d-flex align-items-center">
                <div class="media-body d-flex align-items-center">
                  <!-- <a href="changepassword.html"> -->
                  <img
                    src="{{ url('/img/admin/lock.svg') }}"
                    alt="changepassword"
                    class="mr-2 changepassword"
                  />
                  <h3 class="dropdown-item-title mb-0 cph3">Change Password</h3>
                  <!-- </a> -->
                </div>
              </div>
            </a>

            <div class="dropdown-divider"></div>
            <!-- Message 3 -->
            <a href="#" class="dropdown-item"     data-toggle="modal"
                  data-target="#logoutModal" >
              <div class="media d-flex align-items-center">
                <div
                  class="media-body d-flex align-items-center"
              
                >
                  <img src="{{ url('/img/admin/logout.svg') }}" alt="" class="mr-2 logout" />
                  <h3 class="dropdown-item-title mb-0 lh3">Logout</h3>
                </div>
              </div>
            </a>
          </div>
        </li>
      </ul>
    </nav>

  
   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
