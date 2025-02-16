@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/viewcustomer.css') }}" />
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 viewcompanypart">
            <div class="card ">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img
                            class="profile-user-img img-fluid"
                            src="{{ $company->profile_picture ? url($company->profile_picture) : url('img/admin/imageexample.png') }}"
                            alt="User profile picture" />
                    </div>
            
                    <a href="{{ url('/admin/editcompany/' . $company->id) }}">
                        <i class="fas fa-edit camera-icon" id="cameraIcon"></i>
                    </a>
                    <p class="profile-username text-center">Edit Profile</p>
                </div>
            </div>
        </div>

        <div class="col-md-9 viewcompanypart">
            <div class="card">
                <div class="card-header p-2">
                    <h3>View Company <span></span></h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled 
                                        value="{{$company->first_name}}"
                                        />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled 
                                        value="{{$company->email}}"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled 
                                        value="{{$company->mobile_number}}"/>
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
                                        value="{{$company->address_line_1}}"/>
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
                                         value="{{$company->address_line_2}}"
                                        />
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label>City</label>
                                    <select disabled
                                        class="form-select smallwidth"
                                        aria-label="City">
                                        <option>City</option>
                                        @foreach ($city as $val)
                                         <option value="{{ $val->id }}" {{ $val->id==  $company->city ? 'selected' : '' }}>{{ $val->cityname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select disabled
                                        class="form-select smallwidth"
                                        aria-label="Country">
                                        <option>Country</option>
                                        @foreach ($country as $val)
                                         <option value="{{ $val->id }}" {{ $val->id ==  $company->country ? 'selected' : '' }}>{{ $val->countryname }}</option>
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
                                        value="{{$company->postal_code}}"
                                        />
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            @livewire('admin-user-subscription', ['id' => $company->id])

            <div class="row">
                <div class="col-md-3 mb-2">
                    <a href="{{ url('/admin/managecustomber') }}">
                        <button
                            type="button"
                            class="btn back btn-success btn-sm">
                            Back
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function searchTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("myTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let rowContainsMatch = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const cellText = cells[j].textContent || cells[j].innerText;
                    if (cellText.toLowerCase().indexOf(filter) > -1) {
                        rowContainsMatch = true;
                        break;
                    }
                }
            }

            rows[i].style.display = rowContainsMatch ? "" : "none";
        }
    }
</script>

<script>
      document.addEventListener("DOMContentLoaded", function () {
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
            button.style.fontFamily="Inter";
            button.style.lineHeight ="21px";
          });
        }

        // Initial call to set the button styles
        updateButtonStyles();
      });
    </script>


@endsection