@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/index.css') }}" />
@section('content')


<div class="content-header">
    <div class="container-fluid ">
        <div class="row mb-2">
            <div class="">
                <h1 class="m-0"></h1>
            </div>
           
        </div>
    </div>
</div>

<!-- <section class="content"> -->
    <div class="container-fluid mt-5">
        <div class="row g-2">
            <!-- Box 1 -->
            <div class="col-lg col-md-6  col-12 box">
                <div class="small-box d-flex bg-white">
                    <div class="col-4 p-2 ">
                        <img class="iconimage" src="{{ url('img/admin/dashboardSubscription.svg') }}" alt="icon" />
                    </div>
                    <div class="inner col-8 ">
                        <p class="text-end ">Active Subscriptions</p>
                        <p class="text-right ml-2">13,647</p>
                    </div>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="col-lg col-md-6  col-12 box">
                <div class="small-box d-flex bg-white">
                    <div class="col-4 p-2">
                        <img class="iconimage" src="{{ url('img/admin/Revenue.svg') }}" alt="icon" />
                    </div>
                    <div class="inner col-8 ">
                        <p class="text-end">Total Revenue</p>
                        <p class="text-right ml-2">13,647</p>
                    </div>
                </div>
            </div>

            <!-- Box 3 -->
            <div class="col-lg col-md-6  col-12 box">
                <div class="small-box d-flex bg-white">
                    <div class="col-4 p-2 ">
                        <img class="iconimage" src="{{ url('img/admin/customer.svg') }}" alt="icon" />
                    </div>
                    <div class="inner col-8 ">
                        <p class="text-end ">Total Customers</p>
                        <p class="text-right ml-2">13,647</p>
                    </div>
                </div>
            </div>

            <!-- Box 4 -->
            <div class="col-lg col-md-6  col-12 box">
                <div class="small-box d-flex bg-white">
                    <div class="col-4 p-2 ">
                        <img class="iconimage"  src="{{ url('img/admin/product.svg') }}" alt="icon" />
                    </div>
                    <div class="inner col-8 ">
                        <p class="text-end">Total Products</p>
                        <p class="text-right ml-2">13,647</p>
                    </div>
                </div>
            </div>

            <!-- Box 5 -->
            <div class="col-lg col-md-6  col-12 box">
                <div class="small-box d-flex bg-white">
                    <div class="col-4 p-2">
                        <img class="iconimage" src="{{ url('img/admin/Report.svg') }}" alt="icon" />
                    </div>
                    <div class="inner col-8 ">
                        <p class="text-end ">Total Uploaded Reports</p>
                        <p class="text-right ml-2">13,647</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </section> -->


@endsection