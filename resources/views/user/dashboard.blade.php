@extends('user.master')
@section('title', 'test')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-sm-6 mt-4">
                <h1 class="ml-4">Dashboard</h1>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row box-dash">
                        <div class="col-lg-2 col-6 box-col">
                            <div class="small-box bg-white d-flex box-high">
                                <div class="inner imgdas col-6">
                                    <img src="{{ url('/img/user/Overlay.svg') }}" alt="" />
                                </div>
                                <div class="text-box col-6">
                                    <p>Active Subscription</p>
                                    <h4>13,647</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 box-col">
                            <div class="small-box bg-white d-flex box-high">
                                <div class="inner imgdas col-6">
                                    <img src="{{ url('/img/user/Overlay (1).svg') }}" alt="" />
                                </div>
                                <div class="text-box col-6">
                                    <p>Total Revenue</p>
                                    <h4>13,647</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 box-col">
                            <div class="small-box bg-white d-flex box-high">
                                <div class="inner imgdas col-6">
                                    <img src="{{ url('/img/user/Overlay (2).svg') }}" alt="" />
                                </div>
                                <div class="text-box col-6">
                                    <p>Total Customer</p>
                                    <h4>13,647</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 box-col">
                            <div class="small-box bg-white d-flex box-high">
                                <div class="inner imgdas col-6">
                                    <img src="{{ url('/img/user/Overlay (3).svg') }}" alt="" />
                                </div>
                                <div class="text-box col-6">
                                    <p>Total Products</p>
                                    <h4>13,647</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 box-col">
                            <div class="small-box bg-white d-flex box-high">
                                <div class="inner imgdas col-6">
                                    <img src="{{ url('/img/user/Overlay (4).svg') }}" alt="" />
                                </div>
                                <div class="text-box col-6">
                                    <p>Total Uploaded Reports</p>
                                    <h4>13,647</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection