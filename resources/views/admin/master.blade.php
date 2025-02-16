<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from adminlte.io/themes/v3/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 May 2024 11:43:07 GMT -->
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ProfitScout Admin</title>

    <link
      rel="stylesheet"
      href="../../../fonts.googleapis.com/css24b9.css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"
    />

    <link
      rel="stylesheet"
      href="../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="{{ url('plugins/fontawesome-free/css/all.min.css') }}" />
    
    <link rel="stylesheet" href="{{ url('css/adminlte.min2167.css?v=3.2.0') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @livewireStyles

  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <div id="content">
           @include('admin.common.navbar')
      </div>
      <div id="content2">
      @include('admin.common.sidebar')
      </div>

      <div class="content-wrapper">
          @yield('content')
      </div>


      <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

      <!-- .. Logout modal  -->
      <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- Set width and height for desktop -->
          <div
            class="d-flex justify-content-center align-items-center"
            class="yesandno"
          >
             <img src="{{ url('img/admin/error.svg')}}" class="img-fluid" alt="error">
        </div>
         
          <div class="modal-header">
            <h5 class="text-center navtextheading">
              Are you sure you want to logout?
            </h5>
          </div>

          <div class="d-flex align-item-center justify-content-center">
            <button type="button " class="nonavbar" data-dismiss="modal">
              No
            </button>
            <!-- Column line -->
            <div class="linenavbar"></div>
            <a href="{{ url('/admin/logout') }}">
            <button
              type="button mt-5"
              class="yesnavbar"
             
            >
              Yes, Sure
            </button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- ... success modal ..  -->
    <div
      class="modal fade"
      id="successModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="successModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- Set width and height for desktop -->
          <button
            type="button"
            class="close cross"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>

          <div
            class="d-flex justify-content-center align-items-center p-3 mt-1"
          >
          <img src="{{ url('/img/user/check_circle11.svg') }}" alt="">
            <h5 class="success-heading mb-0 ms-2">Success</h5>
          </div>

          <div class="mt-4 text-center">
            <h5 class="mb-0 successtextnavbar" id="succ_message">Logout successfully</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"
            style="position: fixed; left: 50%; transform: translateX(-50%)">
            <div class="modal-content" style="width: 384px; height: 146px">
                <!-- Set width and height for desktop -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="position: absolute; top: 10px; right: 10px">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="d-flex justify-content-center align-items-center p-4 mt-3">
                    <span class="fa-solid fa-xmark-circle text-danger icon-size"></span>
                    <h5 class="success-heading mb-0 ms-2 title" style="color: red !important">Failure</h5>
                </div>

                <div class="mt-4 text-center">
                    <h5 class="mb-0" id="err_message"
                        style="
font-size: 14px;
font-weight: 400;
color: #c54646;
font-family: 'Inter', sans-serif;
margin-top: -1.5rem;
margin-bottom: 20px;
">
                        Customer deleted successfully
                    </h5>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('js/adminlte.min2167.js?v=3.2.0') }}"></script>


    <script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var successMessage = sessionStorage.getItem('successMessage');

            if (successMessage) {


                success_alert(successMessage);

                sessionStorage.removeItem('successMessage');
            }

            var errorMessage = sessionStorage.getItem('errorMessage');
                     
            if (errorMessage) {

                error_alert(errorMessage);

                sessionStorage.removeItem('errorMessage');
            }
        });


        function success_alert(mesg = 'Success') {
            $("#succ_message").text(mesg);
            $("#successModal").modal('show');
            setTimeout(function() {
                $("#successModal").modal('hide');
            }, 2000);
        }

  
        function error_alert(mesg = 'Something went wrong!') {
            $("#err_message").text(mesg);
            $("#errorModal").modal('show');
            setTimeout(function() {
                $("#errorModal").modal('hide');
            }, 2000);
        }
    </script>



@livewireScripts
  </body>
</html>
