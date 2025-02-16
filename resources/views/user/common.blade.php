<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>ProfitScout</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
       

    <link
      rel="stylesheet"
      href="../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <link rel="stylesheet" href="{{ url('css/sinup.css?v=1') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    @yield('content')


    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
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
                <img src="{{ url('/img/user/check_circle11.svg') }}" alt="">
                    <h5 class="success-heading mb-0 ms-2 title">Success</h5>
                </div>

                <div class="mt-4 text-center">
                    <h5 class="mb-0" id="succ_message"
                        style="
font-size: 14px;
font-weight: 400;
color: #363636;
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

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>