
<?php
$curr_route = Route::currentRouteName();
//dd($curr_route);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
   
</head>
<body>
    <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
            <a href="#" class="brand-link">
          <img
            src="{{ url('img/admin/Half Logo.svg') }}"
            alt="ProfitScout"
            class="brand-image img-fluid elevation-3"
            style="opacity: 0.8"
          />
          <span class="brand-text font-weight-light">Profit <strong class="strong">Scout </strong> </span>
        </a>  
        <div class="sidebar">
          <nav class="mt-2">
               <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li class="nav-item onclick">
              <a href="{{ url('/admin/dashboard') }}" class="nav-link d-flex navlink">
                <div class="icon-container">

                @if($curr_route == "admin.dashboard")
             <img
             src="{{ url('img/admin/dashboard.svg') }}" 
                alt="dashboard img"
              />
            @else
               <img
             src="{{ url('img/admin/whitedashboard.svg') }}" 
                alt="dashboard img"
             />
             @endif

                </div>
                <p class="ml-1">
                  
                Dashboard</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/admin/managecustomber') }}" class="nav-link d-flex navlink ">
                <div class="icon-container">
                      @if($curr_route == "admin.managecustomber")
             <img
             src="{{ url('img/admin/customergreen.svg') }}" 
                alt="dashboard img"
              />
            @else
               <img
             src="{{ url('img/admin/customerSidebar.svg') }}" 
                alt="dashboard img"
             />
             @endif

                </div>
                <p class="ml-1">Manage Customers</p>
              </a>
            </li>


            <li class="nav-item">
              <a href="{{ url('/admin/managesubscriptions') }}" class="nav-link d-flex navlink">
                <div class="icon-container">

                          @if($curr_route == "admin.managesubscriptions")
             <img
             src="{{ url('img/admin/subscriptiongreen.svg') }}" 
                alt="dashboard img"
              />
            @else
               <img
             src="{{ url('img/admin/subscription.svg') }}" 
                alt="dashboard img"
             />
             @endif

                </div>
                <p class="ml-1" >Manage Subscriptions</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/admin/managepayment') }}" class="nav-link d-flex navlink">
                <div class="icon-container">
                

                                  @if($curr_route == "admin.managepayment")
             <img
             src="{{ url('img/admin/Paymentgreen.svg') }}" 
                alt="Paymentgreen img"
              />
            @else
                <img
                    src="{{ url('img/admin/Payment.svg') }}"
                    alt="Manage Sale img"
                  />
             @endif

                </div>
                <p class="ml-1">Manage Payments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/manageroleandpermissions') }}" class="nav-link d-flex navlink">
                <div class="icon-container">
                

                                  @if($curr_route == "admin.manageroleandpermissions")
             <img
             src="{{ url('img/admin/Rolesgreen.svg') }}" 
                alt="Rolesgreen img"
              />
            @else
                <img
                    src="{{ url('img/admin/Roles.svg') }}"
                    alt="Manage Roles img"
                  />
             @endif

                </div>
                <p class="ml-1">Manage Roles & Permissions</p>
              </a>
            </li>

          

            <li class="nav-item">
              <a href="{{ url('/admin/pages') }}" class="nav-link d-flex navlink">
                <div class="icon-container">
                 

                                  @if($curr_route == "admin.pages")
             <img
             src="{{ url('img/admin/pagesgreen.svg') }}" 
                alt="pagesgreen img"
              />
            @else
               <img
                    src="{{ url('img/admin/page.svg') }}"
                    alt="Pages img"
                  />
             @endif

                </div>
                <p class="ml-1">Pages</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/admin/masters') }}" class="nav-link d-flex navlink">
                <div class="icon-container">
                 

                                  @if($curr_route == "admin.masters")
             <img
             src="{{ url('img/admin/mastergreen.svg') }}" 
                alt="mastergreen img"
              />
            @else
               <img src="{{ url('img/admin/Master.svg') }}" alt="Masters img" />
             @endif

                </div>
                <p class="ml-1">Masters</p>
              </a>
            </li>
              <li class="nav-item">
              <a href="{{ url('/admin/reports') }}" class="nav-link d-flex navlink">
                <div class="icon-container">
                

                                  @if($curr_route == "admin.reports")
             <img
             src="{{ url('img/admin/reportgreen.svg') }}" 
                alt="reportgreen img"
              />
            @else
                <img
                    src="{{ url('img/admin/Reports.svg') }}"
                    alt="Manage Reports img"
                  />
             @endif

                </div>
                <p class="ml-1">Reports</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/admin/myscans') }}" class="nav-link d-flex navlink">
                <div class="icon-container">
                 
         @if(in_array($curr_route, ['admin.myscans', 'admin.viewmyscans', 'admin.viewdetailmyscans']))
  <img
    src="{{ url('img/admin/myscangreen.svg') }}" 
    alt="myscangreen img"
  />
@else
  <img
    src="{{ url('img/admin/myscan.svg') }}" 
    alt="Pages img"
  />
@endif


                </div>
                <p class="ml-1">My Scans</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/admin/systemsettings') }}" class="nav-link d-flex navlink">
                <div class="icon-container">
                 

                                  @if($curr_route == "admin.systemsettings")
             <img
             src="{{ url('img/admin/settingreen.svg') }}" 
                alt="settingreen img"
              />
            @else
               <img
                    src="{{ url('img/admin/systemsetting.svg') }}"
                    alt="System Settings img"
                  />
             @endif

                </div>
                <p class="ml-1">System Settings</p>
              </a>
            </li>
          </ul>
          </nav>
        </div>
      </aside>
   <script>
  document.addEventListener("DOMContentLoaded", function () {
    let navLinks = document.querySelectorAll(".nav-link");
    let activeLink = localStorage.getItem("activeNavLink");

    if (activeLink) {
      let selectedLink = document.querySelector(`.nav-link[href='${activeLink}']`);
      if (selectedLink) {
        selectedLink.classList.add("active");
      }
    }

    navLinks.forEach((link) => {
      link.addEventListener("click", function () {
        navLinks.forEach((el) => el.classList.remove("active"));
        this.classList.add("active");
        localStorage.setItem("activeNavLink", this.getAttribute("href"));
      });
    });
  });
</script>

</script>

</body>
</html>