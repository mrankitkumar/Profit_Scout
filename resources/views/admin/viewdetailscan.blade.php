@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/viewDetailsId.css') }}" />
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-between mt-5">
            <!-- Title Section -->
            <div class="col-6 col-sm-7 col-md-8 col-lg-9 mb-2 mb-sm-0">
                <p class="m-0 page-title"></p>
            </div>
            <!-- Button Group -->
            <div
                class="col-6 col-sm-5 col-md-4 col-lg-3 d-flex d-md-flex d-lg-flex d-xl-flex justify-content-end gap-2 buttongroupdetails">
                <a href="{{ url('/admin/viewmyscans') }}" class="w-100">
                    <button type="button" class="btn goback">
                        <img src="{{url('img/admin/goback.svg')}}" alt=""> Go Back
                    </button>
                </a>
                <button class="btn btn-dark amazon1">
                    <a
                        href="https://www.amazon.fr/dp/B07MBZXYMH"
                        target="_blank"
                        class="text-white">
                        <i class="fab fa-amazon"></i>
                    </a>
                </button>
                <button class="btn  flag">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        width="16"
                        height="16">
                        <path
                            d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24L0 64 0 350.5 0 400l0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-100 80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30l0-279.7c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52l0-28zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8l0 241.8-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5l0-237z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-12 col-md-5 col-lg-2 text-center ">
                <img
                    src="{{ url('img/imageps.PNG')}}"
                    class="img-fluid vdimage"
                    alt="imageps" />
            </div>

            <!-- Content Section -->
            <div class="col-12 p-4 col-md-7 col-lg-10">
                <div class="row g-2">
                    <!-- First Column -->
                    <div class="col-6 col-md-4 col-lg-2 mb-3 rounded-3">
                        <div class="description-block1 text-start maintextbox">
                            <span class="description-percentage toptext">Condition</span>
                            <p class="description-header1 text-start">New</p>
                        </div>
                        <div class="description-block1 text-start mt-4 maintextbox">
                            <span class="description-percentage toptext">Sales Rank</span>
                            <p class="description-header1 text-start">500</p>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-6 col-md-4 col-lg-2 mb-3 rounded-3">
                        <div class="description-block1 text-start maintextbox">
                            <span class="description-percentage toptext">Buy Box - Current Price</span>
                            <div class="d-flex align-items-center maintextbox">
                                <p class="description-header1 me-2 text-start">€12.71</p>
                                <button class="btn fba btn-sm mt-n2">
                                    FBA
                                </button>
                            </div>
                        </div>
                        <div class="description-block1 text-start mt-2 maintextbox">
                            <span class="description-percentage toptext">30 Day Average</span>
                            <p class="description-header1">1,113</p>
                        </div>
                    </div>

                    <!-- Third Column -->
                    <div class="col-6 col-md-4 col-lg-2 mb-3 rounded-3">
                        <div class="description-block1 text-start maintextbox ">
                            <span class="description-percentage toptext">Buy Box-90 Days Average Price</span>
                            <p class="description-header1">€14.55</p>
                        </div>
                        <div class="description-block1 text-start mt-4 maintextbox">
                            <span class="description-percentage toptext">90 Days Average</span>
                            <p class="description-header1">2,685</p>
                        </div>
                    </div>

                    <!-- Fourth Column -->
                    <div class="col-6 col-md-4 col-lg-3 mb-3">
                        <div class="description-block1 text-start maintextbox">
                            <span class="description-percentage toptext">Buy Box - 180 Days Average Price</span>
                            <p class="description-header1">€15.01</p>
                        </div>
                        <div class="description-block1 text-start maintextbox mt-4">
                            <span class="description-percentage toptext">180 Days Average</span>
                            <p class="description-header1">2,935</p>
                        </div>
                    </div>

                    <!-- Fifth Column -->
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <div class="description-block1 text-start maintextbox">
                            <span class="description-percentage toptext">Last Price Change</span>
                            <p class="description-header1">10/25/24, 4:26 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid1">
        <div class="row g-2 ">
            <!-- Chart Section -->
            <div class="col-12 col-md-6 col-lg-6 ml-lg-n2 card1">
                <div class="card archart">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Price & Rank History</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                             <div class="showgraphstauts ">
                                <div class="d-flex justify-content-md-between justify-content-evenly col-3 col-md-3 col-lg-3 ">
                                    <div class="SalesRank"></div>
                                    <div for="Sales Rank" class="salesrankprice">Sales Rank #609</div>
                                </div>
                                 <div class="d-flex justify-content-md-between justify-content-evenly col-3 col-md-3 col-lg-3">
                                    <div class="Amazon"></div>
                                    <div for="Amazon €15.99" class="amazonprice">Amazon €15.99</div>
                                </div>
                                 <div class="d-flex justify-content-md-between justify-content-evenly col-3 col-md-3 col-lg-3">
                                    <div class="New"></div>
                                    <div for="New €15.99" class="newprice">New €15.99</div>
                                </div>
                          </div>
                            <canvas
                                id="areaChart"></canvas>
                        </div>
                              <div class=" daysbutton ">

                               <button class="btn days30" type="button">30 days</button>
                               <button class="btn days90" type="button">90 days</button>
                                  <button class="btn days365" type="button">365 days</button>
                          </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="col-12 col-md-6 col-lg-6 ml-lg-2  ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Offers</h3>
                    </div>
                    <!-- Filters Section -->
                    <div
                        class="row">
                        <div class=" d-flex d-lg-flex flex-wrap justify-content-between p-3">
                             <div class="btn  shipmethod1 d-flex align-items-center justify-content-evenly rounded-3">
                            
                                <div class="d-flex align-items-center ">
                                    <div class="font-weight-bold ml-n2 text-nowrap">Shipping Method:</div>
                                    <div class="form-check form-check-inline ml-1">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="radioAll" value="all" checked="">
                                        <label class="form-check-label" for="radioAll">All</label>
                                    </div>
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="radioFBA" value="fba">
                                        <label class="form-check-label" for="radioFBA">FBA</label>
                                    </div>
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="radioFBM" value="fbm">
                                        <label class="form-check-label" for="radioFBM">FBM</label>
                                    </div>
                                </div>
                            </div>
                        <div class="btn condition rounded-3">
                            <label class="mr-2">Condition:</label>
                            <div class="form-check form-check-inline mt-1 ml-n2">
                                <input
                                    class="form-check-input "
                                    type="radio"
                                    name="condition"
                                    id="allCondition"
                                    value="all"
                                    checked />
                                <label class="form-check-label" for="allCondition">All</label>
                            </div>
                            <div class="form-check form-check-inline mt-1">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="condition"
                                    id="newCondition"
                                    value="new" />
                                <label class="form-check-label" for="newCondition">New</label>
                            </div>
                        </div>
                        </div>
                       
                    </div>
                    <!-- Table -->
                    <div class="card-body bg-white p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Seller</th>
                                        <th>Price</th>
                                        <th>Condition</th>
                                        <th>Shipping</th>
                                        <th>Sale Price</th>
                                        <th>Buybox %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Amazon</td>
                                        <td>€12.71</td>
                                        <td>New</td>
                                        <td>FBA</td>
                                        <td>€11.71</td>
                                        <td>100%</td>
                                    </tr>
                                    <tr>
                                        <td>Amazon</td>
                                        <td>€12.71</td>
                                        <td>New</td>
                                        <td>FBA</td>
                                        <td>€11.71</td>
                                        <td>100%</td>
                                    </tr>
                                    <tr>
                                        <td>Amazon</td>
                                        <td>€12.71</td>
                                        <td>New</td>
                                        <td>FBA</td>
                                        <td>€11.71</td>
                                        <td>100%</td>
                                    </tr>
                                    <tr>
                                        <td>Amazon</td>
                                        <td>€12.71</td>
                                        <td>New</td>
                                        <td>FBA</td>
                                        <td>€11.71</td>
                                        <td>100%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item">
                                <a class="page-link rounded-3" href="#">Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-3" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-3" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-3" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-3" href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ...card ..  -->
    <div class="container-fluid bg-white third">
        <div class="card-header">
            <h3 class="card-title">Profit / ROI Calculator</h3>
            <!-- <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-tool"
                  data-card-widget="collapse"
                  title="Collapse"
                >
                  <i class="fas fa-minus"></i>
                </button>
                <button
                  type="button"
                  class="btn btn-tool"
                  data-card-widget="remove"
                  title="Remove"
                >
                  <i class="fas fa-times"></i>
                </button>
              </div> -->
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6 order-2 order-md-1">
                    <div class="card-body">
                        <form>
                           <button class="btn  shipmethod d-flex align-items-center justify-content-between ">
                                <div class="d-flex align-items-center">
                                    <div class="font-weight-bold text-nowrap">Shipping Method:</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="radioAll" value="all" checked="">
                                        <label class="form-check-label" for="radioAll">All</label>
                                    </div>
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="radioFBA" value="fba">
                                        <label class="form-check-label" for="radioFBA">FBA</label>
                                    </div>
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="radioFBM" value="fbm">
                                        <label class="form-check-label" for="radioFBM">FBM</label>
                                    </div>
                                </div>
                            </button>
                            <div class="row mt-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Buy Box Price(€)</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="12.71" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Weight</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="0.65 Pounds"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>FBA Fee</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="€5.75"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Shipping Cost(€)</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <!-- VAT on Price -->
                                <div class="col-12 col-md-6">
                                    <div class="card1 p-3">
                                        <p for="customprice1" class="form-label mb-2">
                                            Price VAT
                                        </p>
                                        <div class="range-slider d-flex align-items-center">
                                            <input
                                                id="customprice1"
                                                class="form-range"
                                                type="range"
                                                min="0"
                                                max="100"
                                                value="50"
                                                step="1"
                                                oninput="updateValue(this, 'rangePrice')" />
                                            <input
                                                class="form-control rounded-3 rangetext"
                                                id="rangePrice"
                                                type="text"
                                                readonly
                                                value="50%" />
                                        </div>
                                    </div>
                                </div>
                                <!-- VAT on Cost -->
                                <div class="col-12 col-md-6">
                                    <div class="card1 p-3">
                                        <p for="customcost2" class="form-label mb-2">
                                            Cost VAT
                                        </p>
                                        <div class="range-slider d-flex align-items-center">
                                            <input
                                                id="customcost2"
                                                type="range"
                                                min="0"
                                                max="100"
                                                value="30"
                                                step="1"
                                                class="form-range"
                                                oninput="updateValue(this, 'rangeCost2')" />

                                            <input
                                                type="text"
                                                id="rangeCost2"
                                                class="form-control rounded-3 rangetext"
                                                readonly
                                                value="50%" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Cost(€)</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="11.60" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="text-nowrap">Discount / Premium(%)</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <!-- <label>Product Dimensions</label> -->
                                        <input

                                            class="form-control rounded-3 NetProfit"
                                            placeholder="NetProfit=" />
                                        <span id="placeholdertext">-74.73%</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <!-- <label>Amazon Referral Fee</label> -->
                                        <input

                                            class="form-control rounded-3 ROI"
                                            placeholder="ROI=" />
                                        <span id="placeholdertext"> -74.73%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Dimensions</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="6.73 x 7.87 x 2.44 Inches"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Amazon Referral Fee</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="€1.91"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prep Fee(€)</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="0.00" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Variable Closing Fee</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="0.00"
                                            disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Net VAT</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="€2.12"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Seller Proceeds</label>
                                        <input
                                            type="text"
                                            class="form-control rounded-3"
                                            placeholder="€2.93"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ..big table ..  -->
    <div class="container-fluid card mt-2">
        <div class="card-header">
            <h3 class="card-title">Variations</h3>
            <!-- <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control rounded-3 float-right"
                  placeholder="Search"
                />
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div> -->
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Product image</th>
                        <th class="col-2">Product Title</th>
                        <th>Sales Rank</th>
                        <th>Category</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Reviews</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img
                                src="{{ url('img/imageps.PNG')}}"
                                class="tableimg"
                                alt="imgps" />
                        </td>
                        <td>
                            Sylvanian Families - La pièce à vivre - Set + de 20
                            accessoires <br />
                            - Plongez dans l'univers de la famille Sylvanian -
                            Figurines animaux <br />
                            miniatures - Jouet enfant 3 ans et + - 5339
                        </td>
                        <td>548</td>
                        <td>Toy</td>
                        <td>Multicolore</td>
                        <td>1 Unité (Lot De 1)</td>
                        <td>3,597</td>
                    </tr>
                    <tr>
                        <td>
                            <img
                                src="{{ url('img/imageps.PNG')}}"
                                class="tableimg"
                                alt="imgps" />
                        </td>
                        <td>
                            Sylvanian Families - La pièce à vivre - Set + de 20
                            accessoires <br />
                            - Plongez dans l'univers de la famille Sylvanian -
                            Figurines animaux <br />
                            miniatures - Jouet enfant 3 ans et + - 5339
                        </td>
                        <td>548</td>
                        <td>Toy</td>
                        <td>Multicolore</td>
                        <td>1 Unité (Lot De 1)</td>
                        <td>3,597</td>
                    </tr>
                    <tr>
                        <td>
                            <img
                                src="{{ url('img/imageps.PNG')}}"
                                class="tableimg"
                                alt="imgps" />
                        </td>
                        <td>
                            Sylvanian Families - La pièce à vivre - Set + de 20
                            accessoires <br />
                            - Plongez dans l'univers de la famille Sylvanian -
                            Figurines animaux <br />
                            miniatures - Jouet enfant 3 ans et + - 5339
                        </td>
                        <td>548</td>
                        <td>Toy</td>
                        <td>Multicolore</td>
                        <td>1 Unité (Lot De 1)</td>
                        <td>3,597</td>
                    </tr>
                    <tr>
                        <td>
                            <img
                                src="{{ url('img/imageps.PNG')}}"
                                class="tableimg"
                                alt="imgps" />
                        </td>
                        <td>
                            Sylvanian Families - La pièce à vivre - Set + de 20
                            accessoires <br />
                            - Plongez dans l'univers de la famille Sylvanian -
                            Figurines animaux <br />
                            miniatures - Jouet enfant 3 ans et + - 5339
                        </td>
                        <td>548</td>
                        <td>Toy</td>
                        <td>Multicolore</td>
                        <td>1 Unité (Lot De 1)</td>
                        <td>3,597</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer  clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item">
                    <a class="page-link rounded-3 " href="#">Previous</a>
                </li>
                <li class="page-item">
                    <a class="page-link rounded-3" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link rounded-3" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link rounded-3" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link rounded-3" href="#">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>



</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Fetch the external HTML file
        // Get the query string from the URL
        const params = new URLSearchParams(window.location.search);

        // Extract the 'title' parameter
        const title = params.get("title");

        // Display the title (e.g., in a heading or log it)
        if (title) {
            document.querySelector(".page-title").textContent =
                decodeURIComponent(title); // Assuming there's a .page-title element
        }
    });
</script>
<script>
    function updateValue(slider, outputId) {
        const value = slider.value;
        const output = document.getElementById(outputId);
        output.value = value + "%";
        slider.style.setProperty('--value', value + '%');
    }
</script>

<script>
    $(function() {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");

        var areaChartData = {
            labels: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
            ],
            datasets: [{
                    label: "Digital Goods",
                    backgroundColor: "rgba(60,141,188,0.9)",
                    borderColor: "rgba(60,141,188,0.8)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    label: "Electronics",
                    backgroundColor: "rgba(210, 214, 222, 1)",
                    borderColor: "rgba(210, 214, 222, 1)",
                    pointRadius: false,
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
        };

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    },
                }, ],
                yAxes: [{
                    gridLines: {
                        display: false,
                    },
                }, ],
            },
        };

        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: "line",
            data: areaChartData,
            options: areaChartOptions,
        });

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChartOptions = $.extend(true, {}, areaChartOptions);
        var lineChartData = $.extend(true, {}, areaChartData);
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false;

        var lineChart = new Chart(lineChartCanvas, {
            type: "line",
            data: lineChartData,
            options: lineChartOptions,
        });

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $("#donutChart").get(0).getContext("2d");
        var donutData = {
            labels: ["Chrome", "IE", "FireFox", "Safari", "Opera", "Navigator"],
            datasets: [{
                data: [700, 500, 400, 600, 300, 100],
                backgroundColor: [
                    "#f56954",
                    "#00a65a",
                    "#f39c12",
                    "#00c0ef",
                    "#3c8dbc",
                    "#d2d6de",
                ],
            }, ],
        };
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: "doughnut",
            data: donutData,
            options: donutOptions,
        });

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieData = donutData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: "pie",
            data: pieData,
            options: pieOptions,
        });

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChartData = $.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        var temp1 = areaChartData.datasets[1];
        barChartData.datasets[0] = temp1;
        barChartData.datasets[1] = temp0;

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
        };

        new Chart(barChartCanvas, {
            type: "bar",
            data: barChartData,
            options: barChartOptions,
        });

        //---------------------
        //- STACKED BAR CHART -
        //---------------------
        var stackedBarChartCanvas = $("#stackedBarChart")
            .get(0)
            .getContext("2d");
        var stackedBarChartData = $.extend(true, {}, barChartData);

        var stackedBarChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    stacked: true,
                }, ],
                yAxes: [{
                    stacked: true,
                }, ],
            },
        };

        new Chart(stackedBarChartCanvas, {
            type: "bar",
            data: stackedBarChartData,
            options: stackedBarChartOptions,
        });
    });
</script>

@endsection