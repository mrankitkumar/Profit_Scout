<div class="mangecustomer border bg-white">
    <!--  -->

    <div class="d-block d-md-flex d-lg-flex d-xl-flex justify-content-between align-items-center p-2 bg-white">
        <!-- Buttons for switching between Customers and Company -->
        <div id="buttonGroup" class="d-md-flex">
            <button
                id="showCustomerBtn"
                class="btn addcustomer btn2 {{ $isCustomerTab ? 'active' : '' }}"
                wire:click="switchTab('customer')">
                Customers
            </button>
            <button
                id="showCompanyBtn"
                class="btn ml-1 addcustomercompany btn2 {{ $isCompanyTab ? 'active' : '' }}"
                wire:click="switchTab('company')">
                Company
            </button>
        </div>

        <!-- Add Customer and Search Customer -->
        @if ($isCustomerTab)
        <button class="addcustomerbtn mt-1" id="addcustomer">
            <a href="{{ url('/admin/addcustomber')}}" class="anchor">
                <img src="{{ url('img/admin/add_circle.svg')}}" alt="Add" class="imgadd" />
                Add Customer
            </a>
        </button>
        <div class="input-group col-lg-3 col-md-3 col-12 mt-1 ml-md-1 border rounded-3" id="searchcustomber">
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

        <!-- Add Company and Search Company -->
        @if ($isCompanyTab)
        <button class="addcompanybtn mt-1" id="addcompany">
            <a href="{{ url('/admin/addcompany')}}" class="anchor">
                <img src="{{ url('img/admin/add_circle.svg')}}" alt="Add" class="imgadd" />
                Add Company
            </a>
        </button>
        <div class="input-group col-lg-3 col-md-3 col-12 mt-1 ml-md-1 border rounded-3" id="searchcompany">
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

    <!-- Customer Table -->
    @if ($isCustomerTab)
    <div id="customerTable" class="table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Subscription Type</th>
                    <th>Valid Till</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->mobile_number }}</td>
                    <?php
                    //dd($customer->subscriptionHistory);
                    $subscriptionHistory = $customer->subscriptionHistory;
                    //  dd($subscriptionHistory->subscription_name);
                    ?>
                    @if($subscriptionHistory)
                    <td>{{ $subscriptionHistory->subscription_name }}</td>
                    @else
                    <td>-</td>
                    @endif
                    @if($subscriptionHistory)
                    <td>{{ $subscriptionHistory->end_date }}</td>
                    @else
                    <td>-</td>
                    @endif

                    <td>
                        <div class="form-check form-switch d-flex align-items-center justify-content-center">
                            <input class="form-check-input custom-switch checkinput" type="checkbox"
                                {{ $customer->isActive ? 'checked' : '' }}
                                wire:click="updateStatus({{ $customer->id }})" />
                        </div>
                    </td>
                    <td class="action-icons" style="word-spacing: 6px">
                        <a href="{{ route('admin.viewCustomber', ['id' => $customer->id]) }}}">
                            <img src="{{ url('img/admin/view.svg')}}" alt="View" title="View" />
                        </a>
                        <a href="{{ route('admin.editCustomber', ['id' => $customer->id]) }}">
                            <img src="{{ url('img/admin/edit.svg')}}" alt="Edit" title="Edit" />
                        </a>
                        <img src="{{ url('img/admin/delete.svg')}}" alt="Delete" title="Delete" data-toggle="modal" data-target="#deleteCustomerModal"
                            data-id="{{ $customer->id }}"
                            class="deletecustomber" />
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="9" class="text-center">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    @endif

    <!-- Company Table -->
    @if ($isCompanyTab)
    <div id="companyTable" class="table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Subscription Type</th>
                    <th>Valid Till</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->first_name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->mobile_number }}</td>
                    <?php
                    //dd($customer->subscriptionHistory);
                    $subscriptionHistory = $company->subscriptionHistory;
                    //  dd($subscriptionHistory->subscription_name);
                    ?>
                    @if($subscriptionHistory)
                    <td>{{ $subscriptionHistory->subscription_name }}</td>
                    @else
                    <td>-</td>
                    @endif
                    @if($subscriptionHistory)
                    <td>{{ $subscriptionHistory->end_date }}</td>
                    @else
                    <td>-</td>
                    @endif
                    <td>
                        <div class="form-check form-switch d-flex align-items-center justify-content-center">
                            <input class="form-check-input custom-switch checkinput" type="checkbox"
                                {{ $company->isActive ? 'checked' : '' }}
                                wire:click="updateStatuscompany({{ $company->id }})" />
                        </div>
                    </td>
                    <td class="action-icons" style="word-spacing: 6px">
                        <a href="{{ route('admin.viewCompany', ['id' => $company->id]) }}">
                            <img src="{{ url('img/admin/view.svg')}}" alt="View" title="View" />
                        </a>
                        <a href="{{ route('admin.editCompany', ['id' => $company->id]) }}">
                            <img src="{{ url('img/admin/edit.svg')}}" alt="Edit" title="Edit" />
                        </a>
                        <img src="{{ url('img/admin/delete.svg')}}" alt="Delete" title="Delete" data-toggle="modal" data-target="#deleteCompanyModal"
                            data-id="{{ $company->id }}"
                            class="deletecomapny" />
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="9" class="text-center">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    @endif
    <div class="d-flex justify-content-between align-items-center mb-3 p-2">
        <div class="entries-info"></div>
        <nav aria-label="Page navigation" style="display: flex">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item" id="prevButton">
                    <a class="page-link pagination" href="#" wire:click="changePage(-1)" tabindex="-1">Previous</a>
                </li>

                @if ($isCustomerTab)
                @for ($i = 1; $i <= $customersCount; $i++)
                    <li class="page-item" id="page{{ $i }}">
                    <a class="page-link {{ $i == $customerPage ? 'active' : '' }} pagination" href="#"
                        wire:click="changePage({{ $i - $customerPage }})">{{ $i }}</a>
                    </li>
                    @endfor
                    @elseif ($isCompanyTab)
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




    <script>
        window.addEventListener('status-updated', event => {
            sessionStorage.setItem('successMessage', 'Customer status updated successfully!');
            window.location.reload();
        });

        window.addEventListener('status-updatedcompany', event => {
            sessionStorage.setItem('successMessage', 'Company status updated successfully!');
            window.location.reload();
        });
    </script>




</div>