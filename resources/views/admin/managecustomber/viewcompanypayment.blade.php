@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/viewcustomer.css') }}" />
@section('content')
<div class="container-fluid">
    <div class="row  mt-5 position-absolute vcp2">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img
                            class="profile-user-img img-fluid"
                            src="{{ url('img/imageps.PNG')}}"
                            alt="User profile picture" />
                    </div>
                    <!-- <p class="profile-username text-center">Nina Mcintire</p> -->
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <h3>View Payment <span></span> </h3>
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
                                        disabled />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled />
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
                                        disabled />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter ..."
                                        disabled />
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label>City</label>
                                    <select disabled
                                        class="form-select smallwidth"
                                        aria-label="City">
                                        <option>City</option>
                                        <option value="Bangalore">Bangalore</option>
                                        <option value="Mumbai">Mumbai</option>
                                        <option value="other">other</option>
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
                                        <option value="India">India</option>
                                        <option value="Australia">Australia</option>
                                        <option value="other">other</option>
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
                                        disabled />
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header p-2">
                <h3>Subscription Details </h3>
            </div>
            <div class="card-body">
                <div
                    class="container-fluid table-responsive">
                    <!-- style="height: 83vh; overflow-y: auto" -->
                    <table class=" container-fluid table">
                        <thead>
                            <tr>
                                <th>Subscription ID</th>
                                <th>Subscription Name</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Subscription Status </th>
                                <th>Payment Date</th>
                                <th>Amount(€)</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample data rows -->
                            <tr>
                                <td>#SUB2540</td>
                                <td>Premium</td>
                                <td>Annual</td>
                                <td>22-05-2024</td>
                                <td>22-05-2025</td>
                                <td><button class="statusButton">Active</button></td>
                                <td>
                                    22-05-2024; 20:08
                                </td>
                                <td>600</td>
                                <td>Apple Pay</td>
                                <td><button class="paymentstatusButton">Success</button></td>
                            </tr>
                            <tr>
                                <td>#SUB2540</td>
                                <td>Premium</td>
                                <td>Annual</td>
                                <td>22-05-2024</td>
                                <td>22-05-2025</td>
                                <td><button class="statusButton">Inactive</button></td>
                                <td>
                                    22-05-2024; 20:08
                                </td>
                                <td>600</td>
                                <td>Apple Pay</td>
                                <td><button class="paymentstatusButton">Failed</button></td>
                            </tr>
                            <tr>
                                <td>#SUB2540</td>
                                <td>Premium</td>
                                <td>Annual</td>
                                <td>22-05-2024</td>
                                <td>22-05-2025</td>
                                <td><button class="statusButton">Cancelled</button></td>
                                <td>
                                    22-05-2024; 20:08
                                </td>
                                <td>600</td>
                                <td>Apple Pay</td>
                                <td><button class="paymentstatusButton">Pending</button></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-2">
                <a href="managepayment.html">
                    <button
                        type="button"
                        class="btn submit btn-sm">
                        Back
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>


<script>
      document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".statusButton");
        const paymentbuttons = document.querySelectorAll(".paymentstatusButton");
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
        function paymentstatus(){
            paymentbuttons.forEach((pbtn)=>{
                if (pbtn.textContent === "Success") {
              pbtn.style.backgroundColor = "#D3F3DF"; // Green background
              pbtn.style.color = "#30C37C";
            } else if (pbtn.textContent === "Failed") {
              pbtn.style.backgroundColor = "#FFE2D5"; // yellow background
              pbtn.style.color = "#FF6C2F";
            } else if (pbtn.textContent == "Pending") {
              pbtn.style.backgroundColor = "#EBEBEB"; // blue
              pbtn.style.color = "#8C8C8C";
            }
            // Common pbtn styles
            pbtn.style.width = "98px";
            pbtn.style.height = "36px";
            pbtn.style.borderRadius = "5px";
            pbtn.style.border = "none";
            pbtn.style.fontSize = "14px";
            pbtn.style.fontFamily="Inter";
            pbtn.style.lineHeight ="21px";
            })
        }
        paymentstatus();
        // Initial call to set the button styles
        updateButtonStyles();
      });
    </script>
@endsection