@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/myproduct.css') }}" />


@section('content')


<div class="content-header">
    <div class="container-fluid myscan">
        <div class="row row1 mb-2">
            <div class="col-md-6">
                <h1 class="mb-2 mb-md-2 mb-lg-2 ml-n2 heading">My Product Lists</h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid d-flex flex-wrap justify-content-between align-items-center mt-5 mt-md-2 mt-lg-0 mb-md-2 mb-lg-0">
    <!-- Search and Sort Container -->
    <div class="col-12 col-md-3 col-lg-5 d-flex align-items-center mb-3 mb-md-0">
        <!-- Search Input -->
        <div class="input-group search">
            <span class="input-group-text bg-white border-0">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" class="form-control h-auto border-0 ps-2" placeholder="Search" aria-label="Search">
        </div>
    </div>

    <!-- Button Group for Filters -->
    <div class="col-12 col-md-3 col-lg-3 d-flex flex-wrap gap-2 justify-content-center justify-content-md-start justify-content-lg-between mb-3 mb-md-0 mb-lg-3 ml-lg-n3 mb-xl-3">
    <button type="button" class="btn All flex-grow-1">All</button>
    <button type="button" class="btn save1 flex-grow-1 bg-white">New</button>
    <button type="button" class="btn save2 flex-grow-1 bg-white">Used</button>
</div>

    <!-- Upload Product Button -->
    <div class="col-12 col-md-3 col-lg-4 text-center text-md-end">
        <button type="button" class="btn saveupload d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#UploadProductList">
            <img src="{{url('img/admin/uploadbutton.svg')}}" alt="Upload Icon" class="me-2">
            Upload Product List
        </button>
    </div>
</div>

<!-- <div class="content"> -->
    <div class="container-fluid">
        <div class="row row1">
            <div
                class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column">
                <!-- <a href="viewproduct.html" style="text-decoration: none; color: inherit;"> -->
                <div
                    class="card bg-white d-flex justify-content-between flex-fill">
                    <div class="card-body  p-4">
                        <!-- File Icon and Title -->
                        <div
                            class="d-flex align-items-start justify-content-between">
                            <img
                                src="{{ url('img/admin/sheet.svg')}}"
                                alt="File Icon"
                                class="file-icon me-3" />
                            <h6 class="card-title mb-2">
                                8d59400d-7c3c-4e16-aec7-3e5a77dcbf78.xlsx
                            </h6>

                            <!-- More Options -->
                            <div class="ms-auto">
                                <button class="btn btn-link text-dark p-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center textprogress gap-2">
                            <!-- NEW Badge -->
                            <span class="badge-new">NEW</span>
                            <!-- Progress Indicator -->
                            <div class="progress-container barprogresss">
                                <div class="mt-1 ">
                                    <div class="percentagebar"
                                        role="progressbar"
                                        aria-valuenow="60"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-labelledby="prgress">
                                        60%
                                    </div>
                                </div>
                                <!-- <span style="font-size: 12px">60%</span> -->
                            </div>
                        </div>
                        <!-- Metadata -->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Uploaded on</p>
                                    <p class="mb-2 span">20-10-2024; 17:35</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">ID Type</p>
                                    <p class="mb-2 span">EAN</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">
                                        Total Line Count
                                    </p>
                                    <p class="mb-2 span">214</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Marketplace</p>
                                    <p class="mb-2 span">FR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </a> -->
            </div>
            <div
                class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column main">
                <div
                    class="card bg-white d-flex justify-content-between flex-fill">
                    <div class="card-body  p-4">
                        <!-- File Icon and Title -->
                        <div
                            class="d-flex align-items-start justify-content-between">
                            <img
                                src="{{ url('img/admin/sheet.svg')}}"
                                alt="File Icon"
                                class="file-icon me-3" />
                            <h6 class="card-title mb-2">
                                8d59400d-7c3c-4e16-aec7-3e5a77dcbf78.xlsx
                            </h6>

                            <!-- More Options -->
                            <div class="ms-auto">
                                <button class="btn btn-link text-dark p-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center textprogress gap-2">
                            <!-- NEW Badge -->
                            <span class="badge-new">NEW</span>
                            <!-- Progress Indicator -->
                            <div class="progress-container complete">
                                <div class="mt-1">
                                    <div
                                        role="progressbar"
                                        aria-valuenow="100"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-labelledby="prgress">
                                        complete
                                    </div>
                                </div>
                                <!-- <span style="font-size: 12px">60%</span> -->
                            </div>
                        </div>
                        <!-- Metadata -->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Uploaded on</p>
                                    <p class="mb-2 span">20-10-2024; 17:35</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">ID Type</p>
                                    <p class="mb-2 span">EAN</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">
                                        Total Line Count
                                    </p>
                                    <p class="mb-2 span">214</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Marketplace</p>
                                    <p class="mb-2 span">FR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div
                class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column main">
                <div
                    class="card bg-white d-flex justify-content-between flex-fill">
                    <div class="card-body  p-4">
                        <!-- File Icon and Title -->
                        <div
                            class="d-flex align-items-start justify-content-between">
                            <img
                                src="{{ url('img/admin/sheet.svg')}}"
                                alt="File Icon"
                                class="file-icon me-3" />
                            <h6 class="card-title mb-2">
                                8d59400d-7c3c-4e16-aec7-3e5a77dcbf78.xlsx
                            </h6>

                            <!-- More Options -->
                            <div class="ms-auto">
                                <button class="btn btn-link text-dark p-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center textprogress gap-2">
                            <!-- NEW Badge -->
                            <span class="badge-new">NEW</span>
                            <!-- Progress Indicator -->
                            <div class="progress-container complete">
                                <div class="mt-1">
                                    <div
                                        role="progressbar"
                                        aria-valuenow="100"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-labelledby="prgress">
                                        complete
                                    </div>
                                </div>
                                <!-- <span style="font-size: 12px">60%</span> -->
                            </div>
                        </div>
                        <!-- Metadata -->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Uploaded on</p>
                                    <p class="mb-2 span">20-10-2024; 17:35</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">ID Type</p>
                                    <p class="mb-2 span">EAN</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">
                                        Total Line Count
                                    </p>
                                    <p class="mb-2 span">214</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Marketplace</p>
                                    <p class="mb-2 span">FR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div
                class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column main">
                <div
                    class="card bg-white d-flex justify-content-between flex-fill">
                    <div class="card-body  p-4">
                        <!-- File Icon and Title -->
                        <div
                            class="d-flex align-items-start justify-content-between">
                            <img
                                src="{{ url('img/admin/sheet.svg')}}"
                                alt="File Icon"
                                class="file-icon me-3" />
                            <h6 class="card-title mb-2">
                                8d59400d-7c3c-4e16-aec7-3e5a77dcbf78.xlsx
                            </h6>

                            <!-- More Options -->
                            <div class="ms-auto">
                                <button class="btn btn-link text-dark p-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center textprogress gap-2">
                            <!-- NEW Badge -->
                            <span class="badge-new">NEW</span>
                            <!-- Progress Indicator -->
                            <div class="progress-container complete">
                                <div class="mt-1">
                                    <div
                                        role="progressbar"
                                        aria-valuenow="100"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-labelledby="prgress">
                                        complete
                                    </div>
                                </div>
                                <!-- <span style="font-size: 12px">60%</span> -->
                            </div>
                        </div>
                        <!-- Metadata -->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Uploaded on</p>
                                    <p class="mb-2 span">20-10-2024; 17:35</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">ID Type</p>
                                    <p class="mb-2 span">EAN</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">
                                        Total Line Count
                                    </p>
                                    <p class="mb-2 span">214</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Marketplace</p>
                                    <p class="mb-2 span">FR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div
                class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column main">
                <div
                    class="card bg-white d-flex justify-content-between flex-fill">
                    <div class="card-body  p-4">
                        <!-- File Icon and Title -->
                        <div
                            class="d-flex align-items-start justify-content-between">
                            <img
                                src="{{ url('img/admin/sheet.svg')}}"
                                alt="File Icon"
                                class="file-icon me-3" />
                            <h6 class="card-title mb-2">
                                8d59400d-7c3c-4e16-aec7-3e5a77dcbf78.xlsx
                            </h6>

                            <!-- More Options -->
                            <div class="ms-auto">
                                <button class="btn btn-link text-dark p-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center textprogress gap-2">
                            <!-- NEW Badge -->
                            <span class="badge-new">NEW</span>
                            <!-- Progress Indicator -->
                            <div class="progress-container complete">
                                <div class="mt-1">
                                    <div
                                        role="progressbar"
                                        aria-valuenow="100"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-labelledby="prgress">
                                        complete
                                    </div>
                                </div>
                                <!-- <span style="font-size: 12px">60%</span> -->
                            </div>
                        </div>
                        <!-- Metadata -->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Uploaded on</p>
                                    <p class="mb-2 span">20-10-2024; 17:35</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">ID Type</p>
                                    <p class="mb-2 span">EAN</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">
                                        Total Line Count
                                    </p>
                                    <p class="mb-2 span">214</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Marketplace</p>
                                    <p class="mb-2 span">FR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div
                class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch flex-column main">
                <div
                    class="card bg-white d-flex justify-content-between flex-fill">
                    <div class="card-body  p-4">
                        <!-- File Icon and Title -->
                        <div
                            class="d-flex align-items-start justify-content-between">
                            <img
                                src="{{ url('img/admin/sheet.svg')}}"
                                alt="File Icon"
                                class="file-icon me-3" />
                            <h6 class="card-title mb-2">
                                8d59400d-7c3c-4e16-aec7-3e5a77dcbf78.xlsx
                            </h6>

                            <!-- More Options -->
                            <div class="ms-auto">
                                <button class="btn btn-link text-dark p-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center textprogress gap-2">
                            <!-- NEW Badge -->
                            <span class="badge-new">NEW</span>
                            <!-- Progress Indicator -->
                            <div class="progress-container complete">
                                <div class="mt-1">
                                    <div
                                        role="progressbar"
                                        aria-valuenow="100"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-labelledby="prgress">
                                        complete
                                    </div>
                                </div>
                                <!-- <span style="font-size: 12px">60%</span> -->
                            </div>
                        </div>
                        <!-- Metadata -->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Uploaded on</p>
                                    <p class="mb-2 span">20-10-2024; 17:35</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">ID Type</p>
                                    <p class="mb-2 span">EAN</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">
                                        Total Line Count
                                    </p>
                                    <p class="mb-2 span">214</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 textmuted">Marketplace</p>
                                    <p class="mb-2 span">FR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
</div>

<!-- modal -->
<div class="modal fade" id="UploadProductList">
    <div class="modal-dialog">
        <div class="modal-content mcon">
            <!-- <div class="modal-header">
                  <h4 class="modal-title">Default Modal</h4>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> -->
            <div class="modal-body">
                <div class="card h-100">
                    <div class="border-gray updatefiles" id="dropZone">
                        <h3 class="h3text">Drag and drop file</h3>
                        <p class="csv">(CSV/XLS/XLSX/PDF)</p>
                        <img
                            src="{{url('img/admin/Vector.png')}}"
                            class="draganddrop"
                            alt="upload" />
                        <p class="selectAfile">Click to select a file</p>
                        <input type="file" id="fileInput" style="display: none" />
                        <p class="footer1">(For large files, convert to CSV)</p>
                    </div>
                    <p id="uploadStatus"></p>
                </div>
            </div>
            <div class="d-flex justify-content-evenly mb-4">
                <button type="button" class="btn  download">
                    Download Template
                </button>
                <button
                    type="button"
                    class="btn btn-default cancel"
                    data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="uploadProductmodal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content mcon">
            <div class="modal-header">
                <h4 class="modal-title modaltitle">Upload Products</h4>
                <button
                    type="button"
                    class="close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="sp">Starting Position</p>
                <!-- Table -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body uploadtable p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">SKU</th>
                                        <th>Description</th>
                                        <th>Seg.</th>
                                        <th>Units per box</th>
                                        <th>Price(€)</th>
                                        <th>EAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>386907</td>
                                        <td>ACQUADI' CHIC EDT DN ML30</td>
                                        <td>-</td>
                                        <td>1</td>
                                        <td>5.99</td>
                                        <td>8002747061254</td>
                                    </tr>
                                    <tr>
                                        <td>386907</td>
                                        <td>ACQUADI' CHIC EDT DN ML30</td>
                                        <td>-</td>
                                        <td>1</td>
                                        <td>5.99</td>
                                        <td>8002747061254</td>
                                    </tr>
                                    <tr>
                                        <td>386907</td>
                                        <td>ACQUADI' CHIC EDT DN ML30</td>
                                        <td>-</td>
                                        <td>1</td>
                                        <td>5.99</td>
                                        <td>8002747061254</td>
                                    </tr>
                                    <tr>
                                        <td>386907</td>
                                        <td>ACQUADI' CHIC EDT DN ML30</td>
                                        <td>-</td>
                                        <td>1</td>
                                        <td>5.99</td>
                                        <td>8002747061254</td>
                                    </tr>
                                    <tr>
                                        <td>386907</td>
                                        <td>ACQUADI' CHIC EDT DN ML30</td>
                                        <td>-</td>
                                        <td>1</td>
                                        <td>5.99</td>
                                        <td>8002747061254</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="card"> -->
                        <div class="d-block d-md-flex d-lg-flex align-item-center justify-content-between">
                            <div class=" col-12 col-md-6 mb-3 align-item-center d-flex d-lg-flex ml-n1 ml-md-n4 ml-lg-auto">
                                <div class=" d-flex d-md-flex d-lg-flex d-xl-flex flex-wrap align-items-center justify-content-between">
                                    <div class="col-6">
                                        <h5 class="card-title1 col-12 col-md-6 mb-2 mb-md-0 mt-1 ml-n3 ml-md-n1 ml-lg-n4">
                                            Search by*:
                                        </h5>
                                    </div>
                                    <div class=" col-6 d-flex justify-content-lg-evenly justify-content-between justify-content-md-between">
                                        <div class="form-check ml-md-n3 ml-3 col-1">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked="">
                                            <label class="form-check-label" for="exampleRadios1">
                                                EAN
                                            </label>
                                        </div>

                                        <div class="form-check ml-3 col-1">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                            <label class="form-check-label" for="exampleRadios2">
                                                ASIN
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 d-flex ml-n1 ml-md-auto ml-lg-auto pl-n1">
                                <select class="form-select formselect form-select-sm mb-3 ml-1 ml-lg-n2 ml-md-n1" aria-label="Product ID Column*">
                                    <option value="" selected="" disabled="">
                                        Product ID Column*
                                    </option>
                                    <option value="EAN">EAN</option>
                                    <option value="SKU">SKU</option>
                                    <option value="Description">Description</option>
                                    <option value="Seg.">Seg.</option>
                                    <option value="Units per box">Units per box</option>
                                    <option value="Price">Price</option>
                                </select>
                                <select class="form-select formselect form-select-sm mb-3 ml-1 ml-lg-2 ml-md-1" aria-label="Marketplace*">
                                    <option value="" selected="" disabled="">Marketplace*</option>
                                    <option value="France">France</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Germany">Germany</option>
                                </select>

                                <select class="form-select formselect form-select-sm mb-3 ml-1 ml-lg-2 ml-md-1" aria-placeholder="Cost Column*" aria-label="Cost Column*">
                                    <option value="" selected="" disabled="">Cost Column*</option>
                                    <option value="SKU">SKU</option>
                                    <option value="Description">Description</option>
                                    <option value="Seg.">Seg.</option>
                                    <option value="Units per box">Units per box</option>
                                    <option value="Price">Price</option>
                                    <option value="EAN">EAN</option>
                                </select>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="form-check ml-2 check-input">
                        <input
                            type="checkbox"
                            class="form-check-input formcheckinput"
                            id="exampleCheck2"
                            oninput="validateCheckbox()" />
                        <label class="form-check-label ml-1 formchecklabel" for="exampleCheck2">VAT registered?</label>
                        <div
                            class="d-none align-item-center box">
                            <div class="col-md-6 col-lg-3  col-6 ml-n4 ml-md-n3 ml-lg-0">
                                <div class=" card1">
                                    <p for="customRange1" class="form-label ml-3">
                                        VAT on Price
                                    </p>
                                    <div class="pricerange">
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
                            <div class="col-md-6 col-lg-3  col-6 ml-n2 ml-md-n2 ml-lg-n2">
                                <div class="card1">
                                    <p for="customRange2" class="form-label ml-3">
                                        VAT on Cost
                                    </p>
                                    <div class="pricecost">
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
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-evenly mb-4">
                <button
                    type="button"
                    class="btn btn-gray upload"
                    id="upload"
                    data-toggle="modal"
                    data-target="#UploadingAnimation"
                    disabled>
                    Upload
                </button>
                <button
                    type="button"
                    class="btn btn-default cancel1"
                    data-bs-dismiss="modal">
                    cancel
                </button>
            </div>
        </div>
    </div>
</div>
<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
    id="UploadingAnimation">
    <div class="modal-dialog">
        <div class="modal-content mcon">
            <div class="modal-body">
                <div class="card h-100">
                    <img
                        src="{{url('img/admin/uploadingproduct.svg')}}"
                        class="draganddrop1"
                        alt="upload" />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const dropZone = document.getElementById("dropZone");
    const fileInput = document.getElementById("fileInput");
    const uploadStatus = document.getElementById("uploadStatus");
    const uploadModal = new bootstrap.Modal(
        document.getElementById("uploadProductmodal")
    );

    // Highlight drop zone when dragging a file over it
    dropZone.addEventListener("dragover", (event) => {
        event.preventDefault();
        dropZone.classList.add("dragover");
    });

    // Remove highlight when leaving drop zone
    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("dragover");
    });

    // Handle file drop
    dropZone.addEventListener("drop", (event) => {
        event.preventDefault();
        dropZone.classList.remove("dragover");
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    // Open file selector on click
    dropZone.addEventListener("click", () => {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener("change", (event) => {
        const files = event.target.files;
        handleFiles(files);
    });

    // Process files
    function handleFiles(files) {
        if (files.length > 0) {
            uploadStatus.textContent = `File uploaded: ${files[0].name}`;
            uploadModal.show();
        } else {
            uploadStatus.textContent = "No file uploaded.";
        }
    }
</script>
<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]'); // Select all checkboxes
    const uploadButton = document.getElementById("upload"); // Select the upload button
    const container = document.querySelector(".box");

    if (checkboxes && uploadButton && container) {
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                // Check if any checkbox is checked
                const isAnyChecked = Array.from(checkboxes).some(
                    (cb) => cb.checked
                );
                if (isAnyChecked) {
                    container.style.setProperty("display", "flex", "important");
                    uploadButton.style.setProperty(
                        "background-color",
                        "#30C37C",
                        "important"
                    ); // Green color
                    uploadButton.style.setProperty("color", "#fff", "important"); // White text
                    uploadButton.removeAttribute("disabled"); // Remove the disabled property
                } else {
                    container.style.setProperty("display", "none", "important"); // Hide the box
                    uploadButton.style.setProperty(
                        "background-color",
                        "#EBEBEB",
                        "important"
                    ); // Default gray color
                    uploadButton.style.setProperty("color", "white", "important"); // Default white text
                }
            });
        });
    } else {
        console.error(
            "Checkboxes, upload button, or container not found in the DOM."
        );
    }

    const range = document.getElementById("customRange1");
    const rangeValue = document.getElementById("rangeValue");
    const range2 = document.getElementById("customRange2");
    const rangeValue2 = document.getElementById("rangeValue2");

    function updateRange() {
        const value = range.value;
        rangeValue.value = value + "%";
        // Update the background gradient
        range.style.background = `linear-gradient(to right, #30C37C ${value}%, #CFF3E2 ${value}%)`;
    }

    function updateRange2() {
        const value = range2.value;
        rangeValue2.value = value + "%";

        // Update the background gradient
        range2.style.background = `linear-gradient(to right, #30C37C ${value}%, #CFF3E2 ${value}%)`;
    }

    // Initialize
    updateRange();
    updateRange2();

    // Add event listener to update on input
    range.addEventListener("input", updateRange);
    range2.addEventListener("input", updateRange2);
</script>
<script>
    const uploadButton1 = document.getElementById("upload"); // Upload button
    const modalElement = document.getElementById("UploadingAnimation"); // Modal element
    const modalInstance = new bootstrap.Modal(modalElement); // Bootstrap modal instance

    // Add event listener to show modal and close it after 5 seconds
    uploadButton1.addEventListener("click", () => {
        modalInstance.show(); // Show the modal

        // Automatically close the modal after 5 seconds
        setTimeout(() => {
            modalInstance.hide(); // Hide the modal
            window.location.href = "/admin/myscans";
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>
<script>
    document.querySelectorAll(".card").forEach((card) => {
        card.addEventListener("click", () => {
            const title = card.querySelector(".card-title").textContent.trim(); // Extract the title
            const encodedTitle = encodeURIComponent(title); // Encode the title for use in a URL
            window.location.href = `/admin/viewmyscans?title=${encodedTitle}`; // Redirect with the title as a query parameter
        });
    });
</script>

@endsection