<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="border managereportsadmin  bg-white ">
        <div
            class="d-block d-md-flex d-lg-flex d-xl-flex justify-content-between align-items-center p-2 bg-white buttongroup">
            <h3 class="managereports">Reports</h3>
            <!-- Search for Customers -->
            <!-- <div class="input-group w-25 border rounded-3" id="searchsubscription">
                <span class="input-group-text bg-white border-0 ">
                  <i class="fas fa-search text-muted"></i>
                </span>
                <input
                  type="text"
                  class="form-control border-0 "
                  placeholder="Search"
                  aria-label="Search"
                />
              </div> -->
            <div class="input-group col-lg-3 col-md-3 col-12 mt-1 ml-md-1  rounded-3" id="searchsubscription">
                <!-- <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span> -->
                <!-- <input
                    type="text"
                    class="form-control rounded-3 border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search" /> -->
            </div>
        </div>
        <!-- <div> 1 -->
        <div id="customerTable" class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th class="col-2">ID</th>
                        <th class="col-7">Reports Title</th>
                        <th class="col-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data rows -->
                  
                    <tr>
                        <td>1</td>
                        <td>Custombers Report</td>
                        <td class="action-icons">

                            <img
                                src="{{ url('img/admin/download.svg')}}"
                                alt="Delete"
                                title="Download" wire:click="Custombers_reoprt" />
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Subscription Report</td>
                        <td class="action-icons">

                        <img
                                src="{{ url('img/admin/download.svg')}}"
                                alt="Delete"
                                title="Download"
                                wire:click="subscription_reoprt"
                                 />
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Payment Report</td>
                        <td class="action-icons">

                        <img
                                src="{{ url('img/admin/download.svg')}}"
                                alt="Delete"
                                title="Download"
                                wire:click="payment_reoprt"
                                 />
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Sub Admin Report</td>
                        <td class="action-icons">

                        <img
                                src="{{ url('img/admin/download.svg')}}"
                                alt="Delete"
                                title="Download"
                                wire:click="subadmin_reoprt"
                                 />
                        </td>
                    </tr>
                   
                    
                  

                </tbody>
            </table>

          
        </div>
    </div>
</div>