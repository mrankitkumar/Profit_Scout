<div>

    <div class="row row1">
        <div class="border managepayment bg-white">
            <div
                class="d-block d-md-block d-lg-flex d-xl-flex justify-content-between align-items-center p-2 bg-white buttongroup">
                <!-- Buttons for switching between Customers and Company -->
                <div id="buttonGroup">
                    <button
                        id="showCustomerBtn"
                        class="btn addcustomer btn2 rounded-3 {{ $isCustomerTabp ? 'active' : '' }}"
                        wire:click="switchTab('customerp')">
                        Customers
                    </button>
                    <button
                        id="showCompanyBtn"
                        class="btn addcustomercompany btn2 rounded-3 {{ $isCompanyTabp ? 'active' : '' }}"
                        wire:click="switchTab('companyp')">
                        Company
                    </button>
                </div>


                @if ($isCustomerTabp)
                <!-- Search for Customers -->
                <div class="input-group col-lg-3 col-md-12 col-12 mt-1  border rounded-3" id="searchcustomber">
                    <span class="input-group-text bg-white border-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input
                        wire:model="keyword"
                        type="text"
                        class="form-control border-0 ps-2"
                        placeholder="Search"
                        aria-label="Search"
                        wire:input="search(1)" />
                </div>
                @endif

                @if ($isCompanyTabp)
                <!-- Search for Company -->
                <div class="input-group col-lg-3 col-md-12 col-12 mt-1 border  rounded-3" id="searchcompany">
                    <span class="input-group-text bg-white border-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input
                        wire:model="keyword"
                        type="text"
                        class="form-control border-0 ps-2"
                        placeholder="Search"
                        aria-label="Search"

                        wire:input="searchCompany(1)" />
                </div>
                @endif


            </div>

            @if ($isCustomerTabp)
            <!-- <div> 1 -->
            <div
                id="customerTable"
                class="table-responsive">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th>Payment Id</th>
                            <th>Payment Type Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Mobile Number</th>
                            <th>Date/Time</th>
                            <th>Subscription</th>
                            <th>Amount(€)</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data rows -->
                        @foreach ($customers as $var)
                        <tr>
                            <td>{{$var->user_subscription_histories_id}}</td>
                            <td>{{$var->payment_method_id}}</td>
                            <td>{{$var->first_name}}</td>
                            <td>{{$var->last_name}}</td>
                            <td>{{$var->email}}</td>
                            <td>{{$var->mobile_number}}</td>
                            <td>{{$var->created_at}}</td>
                            <td>{{$var->subscription_name}}</td>
                            <td>{{$var->price}}</td>
                            <td>{{$var->payment_method}}</td>

                            <td>
                                <button class="statusButton">{{$var->payment_status}}</button>
                            </td>
                            <td class="action-icons">
                                <a href="{{ route('admin.viewCustomber', ['id' => $var->customber_id]) }}">
                                    <img
                                        src="{{ url('img/admin/view.svg')}}"
                                        alt="View"
                                        title="View" />
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="12" class="text-center">

                            </td>
                        </tr>



                    </tbody>
                </table>


            </div>
            @endif

            @if ($isCompanyTabp)
            <!-- </div>2 -->
            <div
                id="companyTable"
                class="table-responsive">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th>Payment Id</th>
                            <th>Payment Type Id</th>
                            <th>Company Name</th>
                            <th>Email Address</th>
                            <th>Mobile Number</th>
                            <th>Date/Time</th>
                            <th>Subscription</th>
                            <th>Amount(€)</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $var)
                        <!-- Sample data rows -->
                        <tr>
                            <td>{{$var->user_subscription_histories_id}}</td>
                            <td>{{$var->payment_method_id}}</td>
                            <td>{{$var->first_name}}</td>

                            <td>{{$var->email}}</td>
                            <td>{{$var->mobile_number}}</td>
                            <td>{{$var->created_at}}</td>
                            <td>{{$var->subscription_name}}</td>
                            <td>{{$var->price}}</td>
                            <td>{{$var->payment_method}}</td>

                            <td>
                                <button class="statusButton">{{$var->payment_status}}</button>
                            </td>
                            <td class="action-icons">
                                <a href="{{ route('admin.viewCompany', ['id' => $var->customber_id]) }}">
                                    <img
                                        src="{{ url('img/admin/view.svg')}}"
                                        alt="View"
                                        title="View" />
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="11" class="text-center">

                            </td>
                        </tr>

                    </tbody>
                </table>

                <!-- Pagination -->

            </div>

            @endif
            <div class="d-flex justify-content-between align-items-center mb-3 p-2">
        <div class="entries-info"></div>
        <nav aria-label="Page navigation" style="display: flex">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item" id="prevButton">
                    <a class="page-link pagination" href="#" wire:click="changePage(-1)" tabindex="-1">Previous</a>
                </li>

                @if ($isCustomerTabp)
                @for ($i = 1; $i <= $customersCount; $i++)
                    <li class="page-item" id="page{{ $i }}">
                    <a class="page-link {{ $i == $customerPage ? 'active' : '' }} pagination" href="#"
                        wire:click="changePage({{ $i - $customerPage }})">{{ $i }}</a>
                    </li>
                    @endfor
                    @elseif ($isCompanyTabp)
                    @for ($i = 1; $i <= $companyCount; $i++)
                        <li class="page-item" id="page{{ $i }}">
                        <a class="page-link {{ $i == $companyPage ? 'active' : '' }} pagination" href="#"
                            wire:click="changePage({{ $i - $companyPage }})">{{ $i }}</a>
                        </li>
                        @endfor
                        @endif

                        <li class="page-item" id="nextButton">
                            <a class="page-link pagination" href="#" wire:click="changePage(1)">Next</a>
                        </li>
            </ul>
        </nav>
    </div>


        </div>
    </div>

</div>