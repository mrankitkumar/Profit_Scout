@extends('user.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url("css/subscription.css")}}" />
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="my-product-head"></div>

        <div class="product-container">
            <div class="product-card card-fluid sub-full">
                <div class="prd-card">
                    <div class="col-6 ml-3">
                        <h2>{{ $package->subscription_name  }}</h2>
                    </div>
                    <div class="col-6 text-end">
                        @if($package->price)
                        <p class="price"><strong>€{{ $package->price }}</strong><span>/{{ $package->subscription_type }}</span></p>
                        @else
                        <p class="price"><strong></strong><span></span></p>
                        @endif
                    </div>

                </div>

                <ul class="features">
                    @foreach(explode("\n", $package->feature) as $feature)
                    <li>{{ $feature }}</li>
                    @endforeach

                </ul>
                <p>{{ $package->description }}</p>
                <div class="row valid-date">
                    <!-- <div class="col-6 text-nowrap">
                        Last purchased on 22-05-2024
                    </div>
                    <div class="col-6 text-end">Valid till 22-05-2025</div> -->
                </div>
            </div>
            <button class="backbtn">
                <a href="{{ url('/user/mysubscription') }}">
                    back
                </a>
            </button>
        </div>
    </div>
</div>
@endsection