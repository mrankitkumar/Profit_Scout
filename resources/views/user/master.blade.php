<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ProfitScout</title>
    <link
        rel="stylesheet"
        href="../../../../../fonts.googleapis.com/css24b9.css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback" />

      

    <link
      rel="stylesheet"
      href="../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />

    <link
        rel="stylesheet"
        href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('css/user.css') }}" />
    <link rel="stylesheet" href="{{ url('css/useradminlte.min2167.css?v=3.2.0') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script nonce="8dc5f651-ff30-4fd3-9d88-68d227d7b9ba">
        try {
            (function(w, d) {
                !(function(bS, bT, bU, bV) {
                    bS[bU] = bS[bU] || {};
                    bS[bU].executed = [];
                    bS.zaraz = {
                        deferred: [],
                        listeners: [],
                    };
                    bS.zaraz._v = "5629";
                    bS.zaraz.q = [];
                    bS.zaraz._f = function(bW) {
                        return async function() {
                            var bX = Array.prototype.slice.call(arguments);
                            bS.zaraz.q.push({
                                m: bW,
                                a: bX,
                            });
                        };
                    };
                    for (const bY of ["track", "set", "debug"])
                        bS.zaraz[bY] = bS.zaraz._f(bY);
                    bS.zaraz.init = () => {
                        var bZ = bT.getElementsByTagName(bV)[0],
                            b$ = bT.createElement(bV),
                            ca = bT.getElementsByTagName("title")[0];
                        ca && (bS[bU].t = bT.getElementsByTagName("title")[0].text);
                        bS[bU].x = Math.random();
                        bS[bU].w = bS.screen.width;
                        bS[bU].h = bS.screen.height;
                        bS[bU].j = bS.innerHeight;
                        bS[bU].e = bS.innerWidth;
                        bS[bU].l = bS.location.href;
                        bS[bU].r = bT.referrer;
                        bS[bU].k = bS.screen.colorDepth;
                        bS[bU].n = bT.characterSet;
                        bS[bU].o = new Date().getTimezoneOffset();
                        if (bS.dataLayer)
                            for (const ce of Object.entries(
                                    Object.entries(dataLayer).reduce(
                                        (cf, cg) => ({
                                            ...cf[1],
                                            ...cg[1],
                                        }), {}
                                    )
                                ))
                                zaraz.set(ce[0], ce[1], {
                                    scope: "page",
                                });
                        bS[bU].q = [];
                        for (; bS.zaraz.q.length;) {
                            const ch = bS.zaraz.q.shift();
                            bS[bU].q.push(ch);
                        }
                        b$.defer = !0;
                        for (const ci of [localStorage, sessionStorage])
                            Object.keys(ci || {})
                            .filter((ck) => ck.startsWith("_zaraz_"))
                            .forEach((cj) => {
                                try {
                                    bS[bU]["z_" + cj.slice(7)] = JSON.parse(ci.getItem(cj));
                                } catch {
                                    bS[bU]["z_" + cj.slice(7)] = ci.getItem(cj);
                                }
                            });
                        b$.referrerPolicy = "origin";
                        b$.src =
                            "../../../../cdn-cgi/zaraz/sd0d9.js?z=" +
                            btoa(encodeURIComponent(JSON.stringify(bS[bU])));
                        bZ.parentNode.insertBefore(b$, bZ);
                    };
                    ["complete", "interactive"].includes(bT.readyState) ?
                        zaraz.init() :
                        bS.addEventListener("DOMContentLoaded", zaraz.init);
                })(w, d, "zarazData", "script");
            })(window, document);
        } catch (e) {
            throw (fetch("/cdn-cgi/zaraz/t"), e);
        }
    </script>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <div id="content">
            @include('user.common.navbar')
        </div>

        <div class="dash-box">

            @yield('content')


        </div>

    </div>

    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content full-box">
                <div class="modal-body">
                    <div class="logout-head">
                        <h1>Are you sure you want to logout?</h1>
                    </div>
                </div>

                <div class="row no-d">
                    <div class="col-6 no-p">
                        <button
                            type="button"
                            class="btn btn-secondary logout-btns position-absolute"
                            data-bs-dismiss="modal">
                            <span> No </span>
                        </button>
                    </div>
                    <div class="col-6 yes-d">
                        <a href="{{ url('/user/logout') }}">
                            <button type="button" class="btn btn-primary logout-btn">
                                <span> Yes, Sure </span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
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



    <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('/plugins/chart.js/Chart.min.js') }}"></script>

    <script src="{{ url('js/adminlte.min2167.js?v=3.2.0') }}"></script>
    <script src="{{ url('/js/pages/dashboard3.js') }}"></script>

    <script src="{{ url('js/demo.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

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

    @if(isset($successMessage))


    <script>
        const successMessage = @json($successMessage);
        if (successMessage) {
            $("#succ_message").text(successMessage);
            $("#successModal").modal('show');
            sessionStorage.removeItem('successMessage');
        }

        setTimeout(function() {
            $("#successModal").modal('hide');
        }, 6000);
    </script>
    @endif

    @if(isset($errorMessage))


    <script>
        //alert();
        const errorMessag = @json($errorMessage);

        if (errorMessag) {
            $("#err_message").text(errorMessag);
            $("#errorModal").modal('show');
            sessionStorage.removeItem('errorMessag');
        }



        setTimeout(function() {
            $("#errorModal").modal('hide');

        }, 6000);
    </script>
    @endif


</body>

</html>