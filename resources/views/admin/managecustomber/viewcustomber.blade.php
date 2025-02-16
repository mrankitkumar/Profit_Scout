@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/viewcustomer.css') }}" />
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 viewcompanypart">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center">

                        <img
                            class="userimage1 img-fluid img-rectangle "
                            src="{{ $customber->profile_picture ? url($customber->profile_picture) : url('img/admin/imageexample.png') }}"
                            alt="User profile picture" />

                    </div>
                    <a href="{{ url('/admin/editcustomber/' . $customber->id) }}">
                        <i class="fas fa-edit camera-icon" id="cameraIcon"></i>
                    </a>


                    <p class="profile-username text-center">Edit Profile</p>
                </div>
            </div>
        </div>

        <div class="col-md-9 viewcompanypart">
            <div class="card">
                <div class="card-header p-2">
                    <h3>View Customer <span></span></h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled
                                        value="{{$customber->first_name}}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        value="{{$customber->last_name}}"
                                        disabled />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select
                                        disabled
                                        class="form-select smallwidth"
                                        aria-label="Gender">
                                        <option>Gender</option>
                                        <option value="Male" {{ $customber->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Mumbai" {{ $customber->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ $customber->gender == 'other' ? 'selected' : '' }}>other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled
                                        value="{{$customber->email}}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled
                                        value="{{$customber->mobile_number}}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled
                                        value="{{$customber->address_line_1}}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled
                                        value="{{$customber->address_line_2}}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <select
                                        disabled
                                        class="form-select smallwidth"
                                        aria-label="City">
                                        <option>City</option>
                                        @foreach ($city as $val)
                                        <option value="{{ $val->id }}" {{ $val->id ==  $customber->city ? 'selected' : '' }}>{{ $val->cityname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select
                                        disabled
                                        class="form-select smallwidth"
                                        aria-label="Country">
                                        <option>Country</option>
                                        @foreach ($country as $val)
                                        <option value="{{ $val->id }}" {{ $val->id ==  $customber->country ? 'selected' : '' }}>{{ $val->countryname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled

                                        value="{{$customber->postal_code}}" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @livewire('admin-user-subscription', ['id' => $customber->id])


            <div class="row">
                <div class="col-md-3 mb-2">
                    <a href="{{ url('/admin/managecustomber') }}">
                        <button
                            type="button"
                            class="btn back btn-sm">
                            Back
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".statusButton");

        // Function to update button styles based on text content
        function updateButtonStyles() {
            buttons.forEach((button) => {
                if (button.textContent === "Active") {
                    button.style.backgroundColor = "#D3F3DF"; // Green background
                    button.style.color = "#30C37C";
                } else if (button.textContent === "Inactive") {
                    button.style.backgroundColor = "#FFE2D5"; // yellow background
                    button.style.color = "#FF6C2F";
                } else if (button.textContent == "Cancelled") {
                    button.style.backgroundColor = "#EBEBEB"; // blue
                    button.style.color = "#8C8C8C";
                }
                // Common button styles
                button.style.width = "98px";
                button.style.height = "36px";
                button.style.borderRadius = "5px";
                button.style.border = "none";
                button.style.fontSize = "14px";
                button.style.fontFamily = "Inter";
                button.style.lineHeight = "21px";
            });
        }

        // Initial call to set the button styles
        updateButtonStyles();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the query parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const customerId = urlParams.get("id");

        if (customerId) {
            // Display the customer ID (for testing)
            console.log("Customer ID:", customerId);
            document.querySelector("span").textContent = `#${customerId}`;

        }
    });
</script>

@endsection