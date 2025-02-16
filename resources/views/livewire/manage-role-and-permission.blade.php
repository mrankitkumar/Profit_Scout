<div>

    <div class="border manageRole bg-white">
        <div
            class="d-block d-md-flex d-lg-flex d-xl-flex justify-content-between align-items-center p-2 bg-white buttongroup">
            <!-- Buttons for switching between Customers and Company -->
            <div id="buttonGroup" class="d-md-flex">
                <button
                    id="showRoleBtn"
                    class="btn addcustomer btn2 rounded-3 {{ $isroleTab ? 'active' : '' }}"
                    wire:click="switchTab('role')">
                    Roles
                </button>
                <button
                    id="showCompanyBtn"
                    class="btn ml-1 addcustomercompany rounded-3 text-nowrap btn2 {{ $issubadminTab ? 'active' : '' }}"
                    wire:click="switchTab('subadmin')">
                    Sub-admins
                </button>
            </div>

            @if ($isroleTab)
            <!-- Add Customer Button -->
            <button class="addRolebtn mt-1" data-toggle="modal"
                data-target="#addROleModal" id="addcustomer">
                <img
                    src="{{ url('img/admin/add_circle.svg')}}"
                    alt="Add"
                    class="imgadd" />
                Add New Role
            </button>

            <!-- Search for Customers -->
            <!-- <div class="input-group col-lg-3 col-md-3 col-12 mt-1 ml-md-1 border rounded-3" id="searchcustomber">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input
                     wire:model="keyword"
                    type="text"
                    class="form-control border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search" 
                     wire:input="search(1)"
                    />
            </div> -->
            @endif


            @if ($issubadminTab)
            <!-- Add Company Button -->
            <button class="addRolebtn mt-1 " id="addcompany">
                <a href="{{ url('/admin/addsubadmin')}}" class="anchor">
                    <img
                        src="{{ url('img/admin/add_circle.svg')}}"
                        alt="Add"
                        class="imgadd" />
                    Add New Sub-Admin
                </a>
            </button>

            <!-- Search for Company -->
            <div class="input-group col-lg-3 col-md-3 col-12 mt-1 ml-md-1 border  rounded-3" id="searchcompany">
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

        </div>

        @if ($isroleTab)
        <!-- <div> 1 -->
        <div
            id="RoleTable"
            class="table-responsive"
            style="display: block">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Role ID</th>
                        <th>Role Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data rows -->
                    @foreach ($roles as $val)
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->rolesname}}</td>
                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput"
                                    type="checkbox"
                                    {{ $val->isActive ? 'checked' : '' }}
                                    wire:click="updateStatusrole({{ $val->id }})" />
                            </div>
                        </td>
                        <td class="action-icons" style="word-spacing: 6px;cursor:pointer;">
                            <img
                                src="{{ url('img/admin/edit.svg')}}"
                                alt="Edit"
                                title="Edit"


                                wire:click="editrole({{ $val->id }})"
                                class="editrole" />
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deleteroleModal"
                                data-id="{{$val->id}}"
                                class="delete-role" />
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
        @endif


        @if ($issubadminTab)
        <!-- </div>2 -->
        <div
            id="SubAdminTable"
            class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Sub-Admin ID</th>
                        <th>Sub-Admin Name</th>
                        <th>Email ID</th>
                        <th>Mobile Number</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data rows -->
                    @foreach ( $subadmin as $val)
                    @if($val->subadminrole_id)
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->first_name}}</td>
                        <td>{{$val->email}}</td>
                        <td>{{$val->mobile_number}}</td>
                        <td>{{$val->subadminrole_id}}</td>
                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinputsubadmin"
                                    type="checkbox"
                                    {{ $val->isActive ? 'checked' : '' }}
                                    wire:click="updateStatussubadmin({{ $val->id }})" />
                            </div>
                        </td>
                        <td class="action-icons" style="word-spacing: 6px">
                            <a href="{{ url('/admin/viewsubadmin',['id' => $val->id])}}">
                                <img
                                    src="{{ url('img/admin/view.svg')}}"
                                    alt="View"
                                    title="View" />
                            </a>
                            <a href="{{ url('/admin/editsubadmin',['id' => $val->id])}}">
                                <img src="{{ url('img/admin/edit.svg')}}" alt="Edit" title="Edit" />
                            </a>
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deleteSubAdminModal"
                                data-id="{{$val->id}}"
                                class="delete-subadmin" />
                        </td>
                    </tr>
                    @endif
                    @endforeach


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

                    @if ($isroleTab)
                    @for ($i = 1; $i <= $roleCount; $i++)
                        <li class="page-item" id="page{{ $i }}">
                        <a class="page-link {{ $i == $rolePage ? 'active' : '' }} pagination" href="#"
                            wire:click="changePage({{ $i - $rolePage }})">{{ $i }}</a>
                        </li>
                        @endfor
                        @elseif ($issubadminTab)
                        @for ($i = 1; $i <= $subadminCount; $i++)
                            <li class="page-item" id="page{{ $i }}">
                            <a class="page-link {{ $i == $subadminPage ? 'active' : '' }} pagination" href="#"
                                wire:click="changePage({{ $i - $subadminPage }})">{{ $i }}</a>
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


    <div
        class="modal fade"
        id="deleteroleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div
            class="modal-dialog"
            role="document">
            <div class="modal-content mcon">
                <!-- Set width and height for desktop -->
                <div
                    class="d-flex justify-content-center align-items-center"
                    class="yesandno">
                    <img src="{{ url('img/admin/error.svg')}}" alt="error">
                </div>
                <div class="modal-header mb-4">
                    <h5 class="text-center textheading">
                        Are you sure you want to delete this Language? <br>
                        This action cannot be undone.
                    </h5>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <button type="button " class="no" data-dismiss="modal">No</button>
                    <!-- Column line -->
                    <div class="line"></div>
                    <button
                        type="button"
                        class="yes"
                        id="confirmDeleterole">
                        Yes, Sure
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Trigger modal when delete button is clicked
            $('.delete-role').on('click', function() {
                const catId = $(this).data('id');


                $('#confirmDeleterole').attr('wire:click', `deleterole(${catId})`);


                $('#deleteroleModal').modal('show');
            });
        });
    </script>

    <div
        class="modal fade"
        id="deleteSubAdminModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div
            class="modal-dialog"
            role="document">
            <div class="modal-content mcon">
                <!-- Set width and height for desktop -->
                <div
                    class="d-flex justify-content-center align-items-center"
                    class="yesandno">
                    <img src="{{ url('img/admin/error.svg')}}" alt="error">
                </div>
                <div class="modal-header mb-4">
                    <h5 class="text-center textheading">
                        Are you sure you want to delete this Language? <br>
                        This action cannot be undone.
                    </h5>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <button type="button " class="no" data-dismiss="modal">No</button>

                    <div class="line"></div>
                    <button
                        type="button"
                        class="yes"
                        id="confirmSubadmin">
                        Yes, Sure
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Trigger modal when delete button is clicked
            $('.delete-subadmin').on('click', function() {
                const catId = $(this).data('id');


                $('#confirmSubadmin').attr('wire:click', `deletesubadmin(${catId})`);


                $('#deleteSubAdminModal').modal('show');
            });
        });
    </script>
    <script>
        window.addEventListener('role-statusupdate', event => {
            sessionStorage.setItem('successMessage', 'Role status updated successfully!');
            window.location.reload();
        });

        window.addEventListener('role-deleted', event => {
            sessionStorage.setItem('successMessage', 'Role deleted successfully.');
            window.location.reload();
        });

        window.addEventListener('Subadmin-Updated', event => {
            sessionStorage.setItem('successMessage', 'Subadmin Updated successfully.');
            window.location.reload();
        });

        window.addEventListener('Subadmin-deleted', event => {
            sessionStorage.setItem('successMessage', 'Subadmin deleted successfully.');
            window.location.reload();
        });
    </script>

</div>