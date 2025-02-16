@extends('user.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/userviewproduct.css') }}" />
@section('content')

<div class="card-body scanproduct">
<div class="card-boxs bg-white ">
    <div class="row d-sm-flex d-md-flex d-lg-flex  box-margt">
        <div class="col-sm-8 col-md-6 col-6 text-wrap">
            <h1 class="m-0 page-title headingtext font-sm"></h1>
        </div>
        <div class="col-sm-4 col-md-6 col-6 text-end">
            <a href="myproduct.html">
                <button type="button" class="btn p-2 ml-2 goback">
                <img src="{{ url('/img/user/circal.svg') }}" alt="" />
                    Go Back
                </button>
            </a>
        </div>
    </div>
    <hr class="mt-2" />
    <div class="row rowheading">
        <div
            class="col-md-6 col-12 colheading d-sm-block d-md-block d-lg-flex mt-1">
            <div class="input-group input-sm">
                <input type="text" class="form-control" placeholder="Search" />
                <i class="fas fa-search position-absolute icon"></i>
            </div>

            <!-- Marketplace Dropdown -->
            <select
                class="form-control marketplace"
                aria-label="Marketplace*">
                <option value="" selected disabled>Marketplace</option>
                <option value="France">France</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Italy">Italy</option>
                <option value="Spain">Spain</option>
                <option value="Germany">Germany</option>
            </select>

            <!-- Toggle Buttons -->
            <button class="btn fbafbm">
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

            <button class="btn showbutton all">
                <label class="shows">Show:</label>
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
                    <label class="form-check-label textlabel" for="inlineRadio2">
                        Favorites</label>
                </div>
            </button>
        </div>
        <div class="col-md-6 d-sm-block colheading d-md-block d-lg-flex">
            <button
                class="btn btn-sm lefticon popover-trigger"
                type="button"
                id="ean"
                data-target="popover-ean">
                <img src="{{ url('/img/user/sort.svg') }}" alt="" /> EAN
                <span class="cross-icon cross-icon-ean">&times;</span>
            </button>

            <button
                class="btn btn-sm ml-1 lefticon popover-trigger"
                type="button"
                data-target="popover-asin">
                <img src="{{ url('/img/user/sort.svg') }}" alt="" />ASIN
                <span class="cross-icon-asin">&times;</span>
            </button>

            <button
                class="btn btn-sm ml-1 lefticon popover-trigger"
                type="button"
                data-target="popover-brand">
                <img src="{{ url('/img/user/sort.svg') }}" alt="" /> Brand
                <span class="cross-icon-brand">&times;</span>
            </button>

            <button
                class="btn btn-sm ml-1 lefticon popover-trigger"
                type="button"
                data-target="popover-networth">
                <img src="{{ url('/img/user/sort.svg') }}" alt="" />NetProfit
                <span class="cross-icon-networth">&times;</span>
            </button>

            <button
                class="btn btn-sm ml-1 lefticon popover-trigger"
                type="button"
                data-target="popover-roi">
                <img src="{{ url('/img/user/sort.svg') }}" alt="" /> ROI
                <span class="cross-icon-roi">&times;</span>
            </button>
            <button
                class="btn btn-sm ml-1 lefticon popover-trigger"
                type="button"
                data-target="popover-margin">
                <img src="{{ url('/img/user/sort.svg') }}" alt="" />Margin
                <span class="cross-icon-margin">&times;</span>
            </button>

            <!-- Right-side Buttons -->

            <button
                class="btn btn-sm ml-1 setting1"
                data-toggle="modal"
                data-target="#scansetting">
                <i class="fas fa-cog"></i>Scan
            </button>
            <button
                class="btn btn-sm ml-1 setting1 dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-download"></i>Reports
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                    <a class="dropdown-item" href="#">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="green"
                            class="bi bi-download svgicon"
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
                            class="bi bi-download svgicon"
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
                            class="bi bi-download svgicon"
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
            <div
                class="container-fluid d-flex align-item-center justify-content-between">
                <div
                    class="col-6 col-lg-6 d-block d-md-block d-lg-flex d-xl-flex align-item-center justify-content-around">
                    <div class="checkbox-box ml-3 checkboxhead">
                        <input
                            type="checkbox"
                            class="form-check-input checkboxinput" />
                    </div>
                    <div class="col-12 mb-3 headerstrong">
                        <strong>Sylvanian Families - 5339</strong> - La pièce à
                        vivre Mobilier Mini-Univers, dès 3 Ans Multicolore
                        <br />
                        <span class="text-muted head">Brand: <span>Sylvanian Families</span> </span>
                    </div>
                    <div class="col-5 mt-1 d-flex">
                        <span class="star-rating mt-1">
                            <i class="fas fa-star"></i>
                            <!-- <i class="fas fa-star-half-alt"></i> -->
                        </span>
                        <span class="text-muted text-nowrap d-flex">4.8 <p>(3507 reviews) </p></span>
                    </div>
                </div>
                <div
                class="container-fluid icon-img col-6 col-lg-2 col-md-2 col-sm-2  p-0 d-flex justify-content-between">
                    <div class="icon-box" data-active="false">
                        <!-- <i class="fa-regular fa-heart"></i> -->
                        <img src="{{ url('/img/user/heart.svg') }}" alt="" />
                    </div>
                    <button
                        id="upload"
                        class="icon-box"
                        data-active="false"
                        data-toggle="modal"
                        data-target="#wavesquare">
                        <img src="{{ url('/img/user/wave.svg') }}" alt="" />
                    </button>

                    <div class="icon-box" data-active="false">
                        <a
                            href="https://www.amazon.fr/dp/B07MBZXYMH/?th=1"
                            target="_blank">
                            <img src="{{ url('/img/user/amazon.svg') }}" alt="" />
                        </a>
                    </div>
                    <button
                        id="upload"
                        class="icon-box"
                        data-active="false"
                        data-toggle="modal"
                        data-target="#imageps">
                        <img src="{{ url('/img/user/viewhil.svg') }}" alt="" />
                    </button>
                    <div
                        type="button"
                        class="icon-box viewdetails"
                        data-active="false">
                        <img src="{{ url('/img/user/eye.svg') }}" alt="" />
                    </div>
                </div>
            </div>
            <!-- EAN and ASIN -->
            <div class="col-6 col-md-2">
                <p class="mb-0"><strong>EAN</strong></p>
                <p>5054130535393</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>ASIN</strong></p>
                <p>B07MBZXYVH</p>
            </div>

            <!-- Cost and Price -->
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Cost</strong></p>
                <p>€11.60</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Price</strong></p>
                <p>€12.71</p>
            </div>

            <!-- Margin and Net Profit -->
            <div class="col-6 col-md-2">
                <p class="mb-1">
                    <strong>Net Profit</strong>
                </p>
                <p class="negative-margin">
                <img src="{{ url('/img/user/phone.svg') }}" alt="" />-€0.67
                </p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>ROI</strong></p>
                <p class="negative-margin">-74.73%</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Margin</strong></p>
                <p class="negative-margin">-26.20%</p>
            </div>
            <!-- Additional Details -->
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Offers</strong></p>
                <p>44</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Sales Rank</strong></p>
                <p>807</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Category</strong></p>
                <p>Jeux et Jouets</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>FBA Fee</strong></p>
                <p>€5.75</p>
            </div>

            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Referral Fee</strong></p>
                <p>€1.91</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Prep Fee</strong></p>
                <p>€0.00</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Shipping Cost</strong></p>
                <p>€0.00</p>
            </div>

            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Variation</strong></p>
                <p>1</p>
            </div>
            <div class="col-6 col-md-2">
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
            <div
                class="container-fluid d-flex align-item-center justify-content-between">
                <div
                    class="col-6 col-lg-6 d-block d-md-block d-lg-flex d-xl-flex align-item-center justify-content-around">
                    <div class="checkbox-box ml-3 checkboxhead">
                        <input
                            type="checkbox"
                            class="form-check-input checkboxinput" />
                    </div>
                    <div class="col-12 mb-3 headerstrong">
                        <strong>Sylvanian Families - 5339</strong> - La pièce à
                        vivre Mobilier Mini-Univers, dès 3 Ans Multicolore
                        <br />
                        <span class="text-muted head">Brand: <span>Sylvanian Families</span>  </span>
                    </div>
                    <div class="col-5 mt-1 d-flex">
                        <span class="star-rating mt-1">
                            <i class="fas fa-star"></i>
                            <!-- <i class="fas fa-star-half-alt"></i> -->
                        </span>
                        <span class="text-muted text-nowrap d-flex">4.8 <p>(3507 reviews) </p></span>
                    </div>
                </div>
                <div
                class="container-fluid icon-img col-6 col-lg-2 col-md-2 col-sm-2  p-0 d-flex justify-content-between">
                    <div class="icon-box" data-active="false">
                        <!-- <i class="fa-regular fa-heart"></i> -->
                        <img src="{{ url('/img/user/heart.svg') }}" alt="" />
                    </div>
                    <button
                        id="upload"
                        class="icon-box"
                        data-active="false"
                        data-toggle="modal"
                        data-target="#wavesquare">
                        <img src="{{ url('/img/user/wave.svg') }}" alt="" />
                    </button>

                    <div class="icon-box" data-active="false">
                        <a
                            href="https://www.amazon.fr/dp/B07MBZXYMH/?th=1"
                            target="_blank">
                            <img src="{{ url('/img/user/amazon.svg') }}" alt="" />
                        </a>
                    </div>
                    <button
                        id="upload"
                        class="icon-box"
                        data-active="false"
                        data-toggle="modal"
                        data-target="#imageps">
                        <img src="{{ url('/img/user/viewhil.svg') }}" alt="" />
                    </button>
                    <div
                        type="button"
                        class="icon-box viewdetails"
                        data-active="false">
                        <img src="{{ url('/img/user/eye.svg') }}" alt="" />
                    </div>
                </div>
            </div>
            <!-- EAN and ASIN -->
            <div class="col-6 col-md-2">
                <p class="mb-0"><strong>EAN</strong></p>
                <p>5054130535393</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>ASIN</strong></p>
                <p>B07MBZXYVH</p>
            </div>

            <!-- Cost and Price -->
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Cost</strong></p>
                <p>€11.60</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Price</strong></p>
                <p>€12.71</p>
            </div>

            <!-- Margin and Net Profit -->
            <div class="col-6 col-md-2">
                <p class="mb-1">
                    <strong>Net Profit</strong>
                </p>
                <p class="negative-margin">
                <img src="{{ url('/img/user/phone.svg') }}" alt="" />-€0.67
                </p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>ROI</strong></p>
                <p class="negative-margin">-74.73%</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Margin</strong></p>
                <p class="negative-margin">-26.20%</p>
            </div>
            <!-- Additional Details -->
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Offers</strong></p>
                <p>44</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Sales Rank</strong></p>
                <p>807</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Category</strong></p>
                <p>Jeux et Jouets</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>FBA Fee</strong></p>
                <p>€5.75</p>
            </div>

            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Referral Fee</strong></p>
                <p>€1.91</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Prep Fee</strong></p>
                <p>€0.00</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Shipping Cost</strong></p>
                <p>€0.00</p>
            </div>

            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>Variation</strong></p>
                <p>1</p>
            </div>
            <div class="col-6 col-md-2">
                <p class="mb-1"><strong>VAT</strong></p>
                <p>€2.12</p>
            </div>
            <!-- Star Rating -->
        </div>
    </div>
</div>
</div>

<!-- ...modal scan  -->
<!-- ...modal scan  -->
<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-hidden="false"
    id="scansetting">
    <div class="modal-dialog modal-md">
        <div class="modal-content mod-cont">
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
                                class="form-control smallwidth"
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
                                class="form-control"
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
                                class="form-control smallwidth"
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
                                class="form-control smallwidth"
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
                                class="form-control"
                                id="Shipping Cost Per Pound(€)"
                                placeholder="Enter" />
                        </div>
                    </div>
                    <!-- <div class="form-check  check-input"> -->
                    <div class="d-flex align-item-center box ml-n2">
                        <div class="col-6">
                            <div class="cards">
                                <p for="customRange1" class="form-label ml-2">
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
                            <div class="cards">
                                <p for="customRange1" class="form-label ml-2">
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
                                        class="rangetext"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
            <div class="d-flex justify-content-evenly ml-4 mb-4">
                <button
                    type="button"
                    class="btn upload"
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
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<!-- ...modal -->
<div
    class="modal fade sadow-mod"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
    id="wavesquare">
    <div class="modal-dialog">
        <div class="modal-content wid-mod">
            <div class="modal-body">
                <div class="card h-100">
                <img src="{{ url('/img/user/image 5.svg') }}" alt="" />
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
        <div class="modal-content">
            <div class="modal-body">
                <div class="card h-100">
                    <img
                       src="{{ url('/img/user/image 4.svg') }}"
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
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div
                class="d-flex justify-content-center align-items-center p-4 mt-3">
                <span
                    class="fa-solid fa-check-circle text-success icon-size"></span>
                <h5 class="success-heading mb-0 ms-2">Success</h5>
            </div>

            <div class="mt-4 text-center">
                <h5 class="mb-0 scansettingbutton">
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
            <div>
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
                class="form-control"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success g-btn">Add</button>
            <button class="clear popveraddbutton">Clear</button>
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
            <div>
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
                class="form-control"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success g-btn">Add</button>
            <button class="clear popveraddbutton">Clear</button>
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
            <div>
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
                class="form-control"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success g-btn">Add</button>
            <button class="clear popveraddbutton">Clear</button>
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
            <div>
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
                class="form-control"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success g-btn">Add</button>
            <button class="clear popveraddbutton">Clear</button>
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
            <div>
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
                class="form-control"
                id="valueInput"
                placeholder="Enter" />
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success g-btn">Add</button>
            <button class="clear popveraddbutton">Clear</button>
        </div>
    </div>
</div>



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
            window.location.href = `/user/viewdetailproduct?title=${encodedTitle}`;
        });
    });
</script>


@endsection