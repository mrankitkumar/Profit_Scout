@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/viewproduct.css') }}" />
@section('content')
<div class="container-fluid ">
    <div class="card-body">
       <div class="container-fluid bg-white scanproduct">
            <div class="row d-sm-flex d-md-flex d-lg-flex">
                <div class="col-lg-8 col-md-6 col-6 text-wrap">
                    <h1 class="m-0 page-title headingtext font-sm"></h1>
                </div>
                <div class="col-lg-4 col-md-6 col-6  text-end">
                    <a href="{{ url('/admin/myscans') }}">
                        <button type="button" class="btn btn-sm p-2 ml-2 goback">
                            <img src="{{url('img/admin/goback.svg')}}" alt="">
                            Go Back
                        </button>
                    </a>
                </div>
            </div>
            <hr class="mt-2" />
            <div class="row rowheading">
                <div
                    class="col-md-6 col-12 colheading d-sm-block d-md-block d-lg-flex mt-1">
                    <div class="input-group rounded-3 border col-lg-3 searchinputscan">
                        <!-- <input
                            type="text"
                            class="form-control rounded-3 border-0 "
                            placeholder="Search" />
                            <span class="input-group-text bg-white border-0">
                        <i class="fas fa-search position-absolute icon"></i>
                        </span> -->
                         <span class="input-group-text bg-white border-0">
                  <i class="fas fa-search text-muted"></i>
                </span>
                <input
                  type="text"
                  class="form-control rounded-3 border-0  "
                  placeholder="Search"
                  aria-label="Search"
                />
                    </div>

                    <!-- Marketplace Dropdown -->
                     <!-- <img src="{{url('img/admin/arrow_drop_down.svg')}}" alt="" class="src"> -->
                   <!-- <div class="dropdown-wrapper"> -->
    <select
        class="form-control rounded-3 marketplace rounded-3 custom-select"
        aria-label="Marketplace*" 
    >
        <option value="" selected disabled>Marketplace*</option>
        <option value="France">France</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="Italy">Italy</option>
        <option value="Spain">Spain</option>
        <option value="Germany">Germany</option>
    </select>
<!-- </div> -->


                    <!-- Toggle Buttons -->
                    <button class="btn  fbafbm">
                        <div class="form-check form-check-inline fba">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="inlineRadioOptions"
                                id="inlineRadio1"
                                value="option1" />
                            <label class="form-check-label" for="inlineRadio1">FBA</label>
                        </div>
                        <div class="form-check form-check-inline fbm">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="inlineRadioOptions"
                                id="inlineRadio2"
                                value="option2" />
                            <label class="form-check-label" for="inlineRadio2">FBM</label>
                        </div>
                    </button>

                    <!-- Radio Buttons -->

                    <button class="btn  all">
                        <label class="show">Show:</label>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="inlineRadioOptions"
                                id="inlineRadio1"
                                value="option1" />
                            <label class="form-check-label" for="inlineRadio1">All</label>
                        </div>
                        <div class="form-check form-check-inline ml-n1">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="inlineRadioOptions"
                                id="inlineRadio2"
                                value="option2" />
                            <label
                                class="form-check-label textlabel"
                                for="inlineRadio2">
                                Favorites</label>
                        </div>
                    </button>
                </div>
                <div
                    class="col-md-6 d-sm-block colheading1 d-md-block d-lg-flex ">
                    <button
                        class="btn btn-sm ml-0 ml-lg-1 lefticon popover-trigger"
                        type="button"
                        id="ean"
                        data-target="popover-ean">
                        <img src="{{url('img/admin/sort.svg')}}"  class="sortimage" alt="sort"> EAN
                        <img src="{{url('img/admin/cancel.svg')}}" class="cross-icon cross-icon-ean" alt="cancel"></img>
                        <!-- <span class="cross-icon cross-icon-ean">&times;</span> -->
                    </button>

                    <button
                        class="btn btn-sm ml-1 ml-lg-1 lefticon popover-trigger"
                        type="button"
                        data-target="popover-asin">
                        <img src="{{url('img/admin/sort.svg')}}" class="sortimageasin" alt="">ASIN
                         <img src="{{url('img/admin/cancel.svg')}}" class=" cross-icon-asin" alt="cancel"></img>
                        <!-- <span class="cross-icon-asin">&times;</span> -->
                    </button>

                    <button
                        class="btn btn-sm ml-0 ml-lg-1 lefticon popover-trigger"
                        type="button"
                        data-target="popover-brand">
                        <img src="{{url('img/admin/sort.svg')}}" class="sortimagebrand" alt=""> Brand
                        <img src="{{url('img/admin/cancel.svg')}}" class="cross-icon-brand" alt="cancel"></img>

                        <!-- <span class="cross-icon-brand">&times;</span> -->
                    </button>

                    <button
                        class="btn btn-sm ml-1 ml-lg-1 lefticon popover-trigger"
                        type="button"
                        data-target="popover-networth">
                        <img src="{{url('img/admin/sort.svg')}}" class="sortimagenetprofit" alt=""> NetProfit
                        <img src="{{url('img/admin/cancel.svg')}}" class="cross-icon-networth" alt="cancel"></img>
                        <!-- <span class="cross-icon-networth">&times;</span> -->
                    </button>

                    <button
                        class="btn btn-sm ml-0 ml-lg-1 lefticon popover-trigger"
                        type="button"
                        data-target="popover-roi">
                        <img src="{{url('img/admin/sort.svg')}}" class="sortimageroi" alt=""> ROI
                        <img src="{{url('img/admin/cancel.svg')}}" class="cross-icon-roi" alt="cancel"></img>
                        <!-- <span class="cross-icon-roi">&times;</span> -->
                    </button>
                    <button
                        class="btn btn-sm ml-1 ml-lg-1 lefticon popover-trigger"
                        type="button"
                        data-target="popover-margin">
                        <img src="{{url('img/admin/sort.svg')}}" class="sortimagemargin" alt="">Margin
                         <img src="{{url('img/admin/cancel.svg')}}" class="cross-icon-margin" alt="cancel"></img>
                        <!-- <span class="cross-icon-margin">&times;</span> -->
                    </button>

                    <!-- Right-side Buttons -->

                    <button
                        class="btn btn-sm ml-0 ml-lg-1 setting1"
                        data-toggle="modal"
                        data-target="#scansetting">
                        <img src="{{url('img/admin/scansetting.svg')}}" class="sortimagescan" alt="">Scan
                    </button>
                    <button
                        class="btn btn-sm ml-1 ml-lg-1 setting1 dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{url('img/admin/downloadscan.svg')}}" class="sortimagereports"></img>Reports
                    </button>
                    <ul
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="#">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="green"
                                    style="fill: green"
                                    class="bi bi-download"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5V11a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a.5.5 0 0 1 1 0v1a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3v-1a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M5.354 8.354a.5.5 0 0 1 0-.708L7.5 5.5V.5a.5.5 0 0 1 1 0v5l2.146 2.146a.5.5 0 0 1-.708.708L8 6.707 6.061 8.646a.5.5 0 0 1-.707 0z" />
                                </svg>
                                All
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="green"
                                    style="fill: green"
                                    class="bi bi-download"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5V11a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a.5.5 0 0 1 1 0v1a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3v-1a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M5.354 8.354a.5.5 0 0 1 0-.708L7.5 5.5V.5a.5.5 0 0 1 1 0v5l2.146 2.146a.5.5 0 0 1-.708.708L8 6.707 6.061 8.646a.5.5 0 0 1-.707 0z" />
                                </svg>
                                Filtered
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="green"
                                    style="fill: green"
                                    class="bi bi-download"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5V11a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a.5.5 0 0 1 1 0v1a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3v-1a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M5.354 8.354a.5.5 0 0 1 0-.708L7.5 5.5V.5a.5.5 0 0 1 1 0v5l2.146 2.146a.5.5 0 0 1-.708.708L8 6.707 6.061 8.646a.5.5 0 0 1-.707 0z" />
                                </svg>
                                Favourites
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 1  -->
            <div class="product-card mt-2">
                <div class="row align-items-center">
                    <!-- Title and Brand -->
                   <div class="container-fluid d-block d-md-block d-lg-block d-xl-flex align-item-center justify-content-between">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-7 d-block d-md-block d-lg-block d-xl-flex align-item-center justify-content-around">
                            <div class="checkbox-box ml-3 ml-md-3 ml-lg-1  checkboxhead">
                                <input type="checkbox" class="form-check-input checkboxinput">
                            </div>
                            <div class="col-12 mb-3 headerstrong">
                                <strong>Sylvanian Families - 5339</strong> - La pièce à
                                vivre Mobilier Mini-Univers, dès 3 Ans Multicolore
                                <br>
                                <span class="text-muted head">Brand: Sylvanian Families</span>
                            </div>
                            <div class="col-3 col-lg-3 star">
                                <span class="star-rating">
                                    <i class="fas fa-star"></i>
                                    <!-- <i class="fas fa-star-half-alt"></i> -->
                                </span>
                                <span class="text-muted"><strong>4.8</strong>(3,597 reviews)</span>
                            </div>
                        </div>
                        <div class="container-fluid col-12 col-md-12 col-lg-12 col-xl-2 mr-2 p-2 d-flex justify-content-between">
                            <div data-active="false">
                                <img src="http://127.0.0.1:8000/img/admin/whiteheart.svg" alt="">
                            </div>
                            <!-- <button
                                id="upload"
                                
                                data-active="false"
                                data-toggle="modal"
                                data-target="#wavesquare"> -->
                                <img src="http://127.0.0.1:8000/img/admin/wavesquare.svg" class="wavesquare" data-active="false" data-toggle="modal" data-target="#wavesquare" alt="wavesqaure">
                            <!-- </button> -->

                            <!-- <div  data-active="false"> -->
                                <a href="https://www.amazon.fr/dp/B07MBZXYMH/?th=1" target="_blank">
                                    <img src="http://127.0.0.1:8000/img/admin/amazonicon.svg" class="amazonicon" alt="amazon">
                                </a>
                            <!-- </div> -->
                            <!-- <button
                                id="upload"
                                
                                > -->
                                <img src="http://127.0.0.1:8000/img/admin/imageviewscan.svg" data-active="false" data-toggle="modal" data-target="#imageps" class="imageviewscan" alt="imageviewscan">
                            <!-- </button> -->
                            <!-- <div
                                type="button"
                                class=" viewdetails"
                                data-active="false"> -->
                               
                              <img src="http://127.0.0.1:8000/img/admin/eyeicon.svg" type="button" data-active="false" class="eyeicon viewdetails" alt="eyeicon">
                            <!-- </div> -->
                        </div>
                    </div>
                    <!-- EAN and ASIN -->
                    <div class="col-6 col-md-2 p-4 p-md-2 p-lg-2">
                        <p class="mb-0"><strong>EAN</strong></p>
                        <p>5054130535393</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>ASIN</strong></p>
                        <p>B07MBZXYVH</p>
                    </div>

                    <!-- Cost and Price -->
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Cost</strong></p>
                        <p>€11.60</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Price</strong></p>
                        <p>€12.71</p>
                    </div>

                    <!-- Margin and Net Profit -->
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1">
                            <strong>Net Profit</strong>
                        </p>
                        <div class="negative-margin">
                            <img src="{{url('img/admin/netprofiticonscan.svg')}}" alt="netprofiticonscan">
                           <p>-€0.67</p> 
                        </div>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>ROI</strong></p>
                        <p class="negative-margin1">-74.73%</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-3 p-lg-2">
                        <p class="mb-1"><strong>Margin</strong></p>
                        <p class="negative-margin1">-26.20%</p>
                    </div>
                    <!-- Additional Details -->
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Offers</strong></p>
                        <p>44</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Sales Rank</strong></p>
                        <p>807</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Category</strong></p>
                        <p>Jeux et Jouets</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>FBA Fee</strong></p>
                        <p>€5.75</p>
                    </div>

                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Referral Fee</strong></p>
                        <p>€1.91</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-3 p-lg-2">
                        <p class="mb-1"><strong>Prep Fee</strong></p>
                        <p>€0.00</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Shipping Cost</strong></p>
                        <p>€0.00</p>
                    </div>

                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Variation</strong></p>
                        <p>1</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>VAT</strong></p>
                        <p>€2.12</p>
                    </div>
                    <!-- Star Rating -->
                </div>
            </div>
            <!-- 2  -->
             <div class="product-card mt-2">
                <div class="row align-items-center">
                    <!-- Title and Brand -->
                   <div class="container-fluid d-block d-md-block d-lg-block d-xl-flex align-item-center justify-content-between">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-7 d-block d-md-block d-lg-block d-xl-flex align-item-center justify-content-around">
                            <div class="checkbox-box ml-3 ml-md-3 ml-lg-1  checkboxhead">
                                <input type="checkbox" class="form-check-input checkboxinput">
                            </div>
                            <div class="col-12 mb-3 headerstrong">
                                <strong>Sylvanian Families - 5339</strong> - La pièce à
                                vivre Mobilier Mini-Univers, dès 3 Ans Multicolore
                                <br>
                                <span class="text-muted head">Brand: Sylvanian Families</span>
                            </div>
                            <div class="col-3 col-lg-3 star">
                                <span class="star-rating">
                                    <i class="fas fa-star"></i>
                                    <!-- <i class="fas fa-star-half-alt"></i> -->
                                </span>
                                <span class="text-muted"><strong>4.8</strong>(3,597 reviews)</span>
                            </div>
                        </div>
                        <div class="container-fluid col-12 col-md-12 col-lg-12 col-xl-2 mr-2 p-2 d-flex justify-content-between">
                            <div data-active="false">
                                <img src="http://127.0.0.1:8000/img/admin/whiteheart.svg" alt="">
                            </div>
                            <!-- <button
                                id="upload"
                                
                                data-active="false"
                                data-toggle="modal"
                                data-target="#wavesquare"> -->
                                <img src="http://127.0.0.1:8000/img/admin/wavesquare.svg" class="wavesquare" data-active="false" data-toggle="modal" data-target="#wavesquare" alt="wavesqaure">
                            <!-- </button> -->

                            <!-- <div  data-active="false"> -->
                                <a href="https://www.amazon.fr/dp/B07MBZXYMH/?th=1" target="_blank">
                                    <img src="http://127.0.0.1:8000/img/admin/amazonicon.svg" class="amazonicon" alt="amazon">
                                </a>
                            <!-- </div> -->
                            <!-- <button
                                id="upload"
                                
                                > -->
                                <img src="http://127.0.0.1:8000/img/admin/imageviewscan.svg" data-active="false" data-toggle="modal" data-target="#imageps" class="imageviewscan" alt="imageviewscan">
                            <!-- </button> -->
                            <!-- <div
                                type="button"
                                class=" viewdetails"
                                data-active="false"> -->
                               
                              <img src="http://127.0.0.1:8000/img/admin/eyeicon.svg" type="button" data-active="false" class="eyeicon viewdetails" alt="eyeicon">
                            <!-- </div> -->
                        </div>
                    </div>
                    <!-- EAN and ASIN -->
                    <div class="col-6 col-md-2 p-4 p-md-2 p-lg-2">
                        <p class="mb-0"><strong>EAN</strong></p>
                        <p >5054130535393</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>ASIN</strong></p>
                        <p>B07MBZXYVH</p>
                    </div>

                    <!-- Cost and Price -->
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Cost</strong></p>
                        <p>€11.60</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Price</strong></p>
                        <p>€12.71</p>
                    </div>

                    <!-- Margin and Net Profit -->
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1">
                            <strong>Net Profit</strong>
                        </p>
                        <div class="negative-margin">
                            <img src="{{url('img/admin/netprofiticonscan.svg')}}" alt="netprofiticonscan">
                           <p>-€0.67</p> 
                        </div>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>ROI</strong></p>
                        <p class="negative-margin1">-74.73%</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-3 p-lg-2">
                        <p class="mb-1"><strong>Margin</strong></p>
                        <p class="negative-margin1">-26.20%</p>
                    </div>
                    <!-- Additional Details -->
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Offers</strong></p>
                        <p>44</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Sales Rank</strong></p>
                        <p>807</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Category</strong></p>
                        <p>Jeux et Jouets</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>FBA Fee</strong></p>
                        <p>€5.75</p>
                    </div>

                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Referral Fee</strong></p>
                        <p>€1.91</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-3 p-lg-2">
                        <p class="mb-1"><strong>Prep Fee</strong></p>
                        <p>€0.00</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Shipping Cost</strong></p>
                        <p>€0.00</p>
                    </div>

                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>Variation</strong></p>
                        <p>1</p>
                    </div>
                    <div class="col-6 col-md-2 p-4 p-md-0 p-lg-0">
                        <p class="mb-1"><strong>VAT</strong></p>
                        <p>€2.12</p>
                    </div>
                    <!-- Star Rating -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ...modal scan  -->
<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-hidden="false"
    id="scansetting">
    <div class="modal-dialog modal-md">
        <div class="modal-content mscancontent">
            <div class="modal-header">
                <h4 class="modal-title">Scan Settings</h4>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <!-- <form> -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Currency">Currency</label>
                            <select
                                class="form-select rounded-3 smallwidth"
                                aria-label="Marketplace*">
                                <option value="" selected>Marketplace*</option>
                                <option value="France">France</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Italy">Italy</option>
                                <option value="Spain">Spain</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Prep Fee(€)">Prep Fee(€)</label>
                            <input
                                type="tel"
                                class="form-control rounded-3"
                                id="Prep Fee(€)"
                                placeholder="Enter"
                                maxlength="10"
                                pattern="[789][0-9]{9}"
                                required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Amazon Check(%)">Amazon Check(%)</label>
                            <select
                                class="form-select rounded-3 smallwidth"
                                aria-label="Marketplace*">
                                <option value="" selected>Marketplace*</option>
                                <option value="France">France</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Italy">Italy</option>
                                <option value="Spain">Spain</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Keep a Chart Date Range">Keepa Chart Date Range</label>
                            <select
                                class="form-select rounded-3 smallwidth"
                                aria-label="Marketplace*">
                                <option value="" selected>Marketplace*</option>
                                <option value="France">France</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Italy">Italy</option>
                                <option value="Spain">Spain</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="Shipping Cost Per Pound(€)">Shipping Cost Per Pound(€)</label>
                            <input
                                type="text"
                                class="form-control rounded-3"
                                id="Shipping Cost Per Pound(€)"
                                placeholder="Enter" />
                        </div>
                    </div>
                    <!-- <div class="form-check  check-input"> -->
                    <div class="d-flex align-item-center box ml-n2">
                        <div class="col-6">
                            <div class="card1">
                                <p for="customRange1" class=" form-label ml-2">
                                   Price VAT
                                </p>
                                <div class="rangebox">
                                    <input
                                        type="range"
                                        id="customRange1"
                                        min="0"
                                        max="100"
                                        value="50" />
                                    <input
                                        type="text"
                                        id="rangeValue"
                                        readonly
                                        class="rangetext" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card1">
                                <p for="customRange2" class=" form-label ml-2">
                                   Cost VAT
                                </p>
                                <div class="rangebox">
                                    <input
                                        type="range"
                                        id="customRange2"
                                        min="0"
                                        max="100"
                                        value="50" />
                                    <input
                                        type="text"
                                        id="rangeValue2"
                                        readonly
                                        class="rangetext" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
              <div class="row">
                            <div class="col-4 col-md-4">
                                <button
                                    type="button"
                    class="btn  upload"
                    id="upload"
                    data-dismiss="modal"
                    data-toggle="modal"
                    data-target="#successScanModal">
                    Add
                                </button>
                            </div>
                            <div class="col-4 col-md-4">
                                
                                    <button
                                       type="button"
                    class="btn  cancel1"
                    data-dismiss="modal">
                    cancel
                                    </button>
                              
                            </div>
                        </div>
            <!-- <div class="row d-flex justify-content-evenly ml-4 mb-4">
                <button
                    type="button"
                    class="btn  upload"
                    id="upload"
                    data-dismiss="modal"
                    data-toggle="modal"
                    data-target="#successScanModal">
                    Add
                </button>
                <button
                    type="button"
                    class="btn btn-default cancel1"
                    data-dismiss="modal">
                    cancel
                </button>
            </div> -->
            <!-- </form> -->
        </div>
    </div>
</div>
<!-- ...modal -->
<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
    id="wavesquare">
    <div class="modal-dialog">
        <div class="modal-content mwave">
            <div class="modal-body">
                <div class="card h-100">
                    <img
                        src="{{ url('img/graph.PNG')}}"
                        class="draganddrop"
                        alt="upload" />
                </div>
            </div>
        </div>
    </div>
</div>

<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
    id="imageps">
    <div class="modal-dialog">
        <div class="modal-content mimage">
            <div class="modal-body">
                <div class="card h-100">
                    <img
                        src="{{ url('img/imageps.PNG')}}"
                        class="draganddrop"
                        alt="upload" />
                </div>
            </div>
        </div>
    </div>
</div>

<div
    class="modal fade"
    id="successScanModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="successModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon">
            <!-- Set width and height for desktop -->
            <button
                type="button"
                class="close cross"
                data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div
                class="d-flex justify-content-center align-items-center p-3 mt-1">
                <span
                    class="fa-solid fa-check-circle text-success icon-size"></span>
                <h5 class="success-heading mb-0 ms-2">Success</h5>
            </div>

            <div class="mt-4 text-center">
                <h5 class="mb-0 successtextnavbar">New Scan added successfully</h5>
            </div>
        </div>
    </div>
</div>

<div
    class="modal fade"
    id="successModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="successModalLabel"
    aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon">
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
                class="d-flex justify-content-center align-items-center p-4 mt-3">
                <span
                    class="fa-solid fa-check-circle text-success icon-size"></span>
                <h5 class="success-heading mb-0 ms-2">Success</h5>
            </div>

            <div class="mt-4 text-center">
                <h5
                    class="mb-0 scantext">
                    Scan settings applied successfully.
                </h5>
            </div>
        </div>
    </div>
</div>
<!-- ... EAN...  -->
<div class="popoverclass" id="popover-ean">
    <div class="popover-arrow"></div>
    <div class="popover-body">
        <div class="mb-2">
            <label class="form-label">Filter:</label>
            <div class="checkboxpadding">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="contains"
                        value="contains" />
                    <label class="form-check-label" for="contains">Contains</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="doesNotContain"
                        value="doesNotContain" />
                    <label class="form-check-label" for="doesNotContain">Does not contain</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="equal"
                        value="equal" />
                    <label class="form-check-label" for="equal">Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="notEqual"
                        value="notEqual" />
                    <label class="form-check-label" for="notEqual">Not equal</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="valueInput" class="form-label">Value:</label>
            <input
                type="text"
                class="form-control rounded-3"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn add ">Add</button>
            <button class="clear">
                Clear
            </button>
        </div>
    </div>
</div>
<!-- ....ASIN ..  -->
<div class="popoverclass" id="popover-asin">
    <div class="popover-arrow"></div>
    <!-- <button class="popover-close" id="popover-close">&times;</button> -->
    <!-- <div class="popover-header">Manage Your Channels</div> -->
    <div class="popover-body">
        <div class="mb-2">
            <label class="form-label">Filter:</label>
            <div class="checkboxpadding">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="contains"
                        value="contains" />
                    <label class="form-check-label" for="contains">Contains</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="doesNotContain"
                        value="doesNotContain" />
                    <label class="form-check-label" for="doesNotContain">Does not contain</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="equal"
                        value="equal" />
                    <label class="form-check-label" for="equal">Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="notEqual"
                        value="notEqual" />
                    <label class="form-check-label" for="notEqual">Not equal</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="valueInput" class="form-label">Value:</label>
            <input
                type="text"
                class="form-control rounded-3"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn add ">Add</button>
            <button class="clear">
                Clear
            </button>
        </div>
    </div>
</div>
<!-- ...Brand ..  -->
<div class="popoverclass" id="popover-brand">
    <div class="popover-arrow"></div>
    <!-- <button class="popover-close" id="popover-close">&times;</button> -->
    <!-- <div class="popover-header">Manage Your Channels</div> -->
    <div class="popover-body">
        <div class="mb-2">
            <label class="form-label">Filter:</label>
            <div class="checkboxpadding">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="contains"
                        value="contains" />
                    <label class="form-check-label" for="contains">Contains</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="doesNotContain"
                        value="doesNotContain" />
                    <label class="form-check-label" for="doesNotContain">Does not contain</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="equal"
                        value="equal" />
                    <label class="form-check-label" for="equal">Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="notEqual"
                        value="notEqual" />
                    <label class="form-check-label" for="notEqual">Not equal</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="valueInput" class="form-label">Value:</label>
            <input
                type="text"
                class="form-control rounded-3"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn add ">Add</button>
            <button class="clear">
                Clear
            </button>
        </div>
    </div>
</div>
<!-- ...networth ...  -->
<div class="popoverclass" id="popover-networth">
    <div class="popover-arrow"></div>
    <!-- <button class="popover-close" id="popover-close">&times;</button> -->
    <!-- <div class="popover-header">Manage Your Channels</div> -->
    <div class="popover-body">
        <div class="mb-2">
            <label class="form-label">Filter:</label>
            <div class="checkboxpadding">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Less than"
                        value="contains" />
                    <label class="form-check-label" for="Less than">Less than</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Less than or Equal"
                        value="Less than or Equal" />
                    <label class="form-check-label" for="Less than or Equal">Less than or Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Greater than"
                        value="Greater than" />
                    <label class="form-check-label" for="Greater than">Greater than</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Greater than or Equal"
                        value="Greater than or Equal" />
                    <label class="form-check-label" for="Greater than or Equal">Greater than or Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="equal"
                        value="equal" />
                    <label class="form-check-label" for="equal">Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="notEqual"
                        value="notEqual" />
                    <label class="form-check-label" for="notEqual">Not equal</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="valueInput" class="form-label">Value:</label>
            <input
                type="text"
                class="form-control rounded-3"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn add ">Add</button>
            <button class="clear">
                Clear
            </button>
        </div>
    </div>
</div>
<!-- ROI  -->
<div class="popoverclass" id="popover-roi">
    <div class="popover-arrow"></div>
    <!-- <button class="popover-close" id="popover-close">&times;</button> -->
    <!-- <div class="popover-header">Manage Your Channels</div> -->
    <div class="popover-body">
        <div class="mb-2">
            <label class="form-label">Filter:</label>
            <div class="checkboxpadding">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Less than"
                        value="contains" />
                    <label class="form-check-label" for="Less than">Less than</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Less than or Equal"
                        value="Less than or Equal" />
                    <label class="form-check-label" for="Less than or Equal">Less than or Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Greater than"
                        value="Greater than" />
                    <label class="form-check-label" for="Greater than">Greater than</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Greater than or Equal"
                        value="Greater than or Equal" />
                    <label class="form-check-label" for="Greater than or Equal">Greater than or Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="equal"
                        value="equal" />
                    <label class="form-check-label" for="equal">Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="notEqual"
                        value="notEqual" />
                    <label class="form-check-label" for="notEqual">Not equal</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="valueInput" class="form-label">Value:</label>
            <input
                type="text"
                class="form-control rounded-3"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn add ">Add</button>
            <button class="clear">
                Clear
            </button>
        </div>
    </div>
</div>

<!-- <script src="dist/js/demo.js"></script> -->
<script>
    const triggers = document.querySelectorAll(".popover-trigger");

    triggers.forEach((trigger) => {
        trigger.addEventListener("click", () => {
            const targetId = trigger.getAttribute("data-target");
            const popover = document.getElementById(targetId);
            const crossIconClass = `cross-icon-${targetId.split("-")[1]}`;
            const crossIcon = trigger.querySelector(`.${crossIconClass}`);

            // Hide all popovers and cross icons
            document
                .querySelectorAll(".popoverclass")
                .forEach((p) => (p.style.display = "none"));
            document
                .querySelectorAll(".cross-icon")
                .forEach((icon) => (icon.style.display = "none"));

            // Check current state
            if (popover.style.display === "block") {
                popover.style.display = "none";
                crossIcon.style.display = "none";
            } else {
                // Position the popover
                const rect = trigger.getBoundingClientRect();
                popover.style.top = `${rect.bottom + window.scrollY}px`;
                popover.style.left = `${rect.left + window.scrollX}px`;
                popover.style.display = "block";
                crossIcon.style.display = "block";
            }
        });

        // Close popover on cross icon click
        const crossIcon = trigger.querySelector(
            `.cross-icon-${trigger.getAttribute("data-target").split("-")[1]}`
        );
        crossIcon.addEventListener("click", (event) => {
            event.stopPropagation(); // Prevent button click
            const targetId = trigger.getAttribute("data-target");
            const popover = document.getElementById(targetId);
            popover.style.display = "none";
            crossIcon.style.display = "none";
        });
    });

    // Close popover on internal close button
    document.querySelectorAll(".popoverclass").forEach((popover) => {
        const closeButton = popover.querySelector(".popover-close");
        if (closeButton) {
            closeButton.addEventListener("click", () => {
                popover.style.display = "none";
                const trigger = document.querySelector(
                    `[data-target="${popover.id}"]`
                );
                if (trigger) {
                    const crossIcon = trigger.querySelector(
                        `.cross-icon-${popover.id.split("-")[1]}`
                    );
                    console.log(crossIcon)
                    if (crossIcon) crossIcon.style.display = "none";
                }
            });
        }
    });
</script>

<script>
    // Close the modal after 2 seconds
    setTimeout(function() {
        const successModal = new bootstrap.Modal(
            document.getElementById("successModal")
        );
        successModal.hide();
    }, 5000);
</script>

<script>
    // Get all icon-box elements
    const iconBoxes = document.querySelectorAll(".icon-box");

    iconBoxes.forEach((iconBox) => {
        iconBox.addEventListener("click", () => {
            // Toggle 'active' class on the clicked icon
            iconBox.classList.toggle("hover");
        });
    });
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

    const range = document.getElementById("customRange1");
    const rangeValue = document.getElementById("rangeValue");
    const range2 = document.getElementById("customRange2");
    const rangeValue2 = document.getElementById("rangeValue2");

    function updateRange() {
        const value = range.value;
        rangeValue.value = value + "%";

        // Update the background gradient
        range.style.background = `linear-gradient(to right, #30C37C ${value}%, #CFF3E2 ${value}.0%)`;
    }

    function updateRange2() {
        const value = range2.value;
        rangeValue2.value = value + "%";

        // Update the background gradient
        range2.style.background = `linear-gradient(to right, #30C37C ${value}%, #CFF3E2 ${value}.0%)`;
    }

    // Initialize
    updateRange();
    updateRange2();

    // Add event listener to update on input
    range.addEventListener("input", updateRange);
    range2.addEventListener("input", updateRange2);
</script>
<script>
    document.querySelectorAll(".viewdetails").forEach((button) => {
        button.addEventListener("click", () => {
            // Find the corresponding title of the product
            const title = button
                .closest(".product-card")
                .querySelector(".headerstrong")
                .textContent.trim();
            const title2 = button
                .closest(".product-card")
                .querySelector(".text-muted")
                .textContent.trim();
            const total = title + title2;
            console.log(total);
            // Encode the title for URL
            const encodedTitle = encodeURIComponent(total);

            // Redirect to the next page with the title as query parameter
            window.location.href = `/admin/viewdetailmyscans?title=${encodedTitle}`;
        });
    });
</script>
<!-- Margin .. -->
<div class="popoverclass" id="popover-margin">
    <div class="popover-arrow"></div>
    <!-- <button class="popover-close" id="popover-close">&times;</button> -->
    <!-- <div class="popover-header">Manage Your Channels</div> -->
    <div class="popover-body">
        <div class="mb-2">
            <label class="form-label">Filter:</label>
            <div class="checkboxpadding">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Less than"
                        value="contains" />
                    <label class="form-check-label" for="Less than">Less than</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Less than or Equal"
                        value="Less than or Equal" />
                    <label class="form-check-label" for="Less than or Equal">Less than or Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Greater than"
                        value="Greater than" />
                    <label class="form-check-label" for="Greater than">Greater than</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="Greater than or Equal"
                        value="Greater than or Equal" />
                    <label class="form-check-label" for="Greater than or Equal">Greater than or Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="equal"
                        value="equal" />
                    <label class="form-check-label" for="equal">Equal</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="filterOption"
                        id="notEqual"
                        value="notEqual" />
                    <label class="form-check-label" for="notEqual">Not equal</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="valueInput" class="form-label">Value:</label>
            <input
                type="text"
                class="form-control rounded-3"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn add ">Add</button>
            <button class="clear">
                Clear
            </button>
        </div>
    </div>
</div>

@endsection