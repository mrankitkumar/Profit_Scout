@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/viewsubadmin.css') }}" />
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="card mt-5 p-1">
            <div class="card-header p-2">
                <h3>View Sub-Admin<span></span></h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Sub-Admin Name</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter ..."
                                name="subadminname"
                                value="{{$user->first_name}}" disabled />
                            <span id="subadminname_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="Enter ..."
                                name="email"
                                value="{{$user->email}}" disabled />
                            <span id="email_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="Enter ..."
                                name="mobileno"
                                value="{{$user->mobile_number}}" disabled />
                            <span id="mobileno_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-select smallwidth" aria-label="role" name="rolename" disabled>
                                <option value="">Select Role</option>
                                @foreach ($roles as $val)
                                <option value="{{ $val->id }}" {{ $user->subadminrole_id == $val->id ? 'selected' : '' }}>
                                    {{ $val->rolesname }}
                                </option>
                                @endforeach
                            </select>

                            <span id="rolename_error" class="form-text text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="card-header1">
                    <h3>Permissions</h3>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>Manage Customers</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="managecustomber")

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="addCustomer" name="manageCustomerAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="addCustomer">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="viewCustomer" name="manageCustomerView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="viewCustomer">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="editCustomer" name="manageCustomerEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="editCustomer">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="deleteCustomer" name="manageCustomerDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="deleteCustomer">Delete</label>
                                </div>
                            </div>
                            <span id="manageCustomerError" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>Manage Subscriptions</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="managesubscription")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="addSubscription" name="manageSubscriptionAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="addSubscription">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="viewSubscription" name="manageSubscriptionView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="viewSubscription">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="editSubscription" name="manageSubscriptionEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="editSubscription">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="deleteSubscription" name="manageSubscriptionDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="deleteSubscription">Delete</label>
                                </div>
                            </div>
                            <span id="manageSubscriptionError" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>Manage Payments</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="managepayment")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="addPayment" name="managePaymentAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="addPayment">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="viewPayment" name="managePaymentView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="viewPayment">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="editPayment" name="managePaymentEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="editPayment">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="deletePayment" name="managePaymentDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="deletePayment">Delete</label>
                                </div>
                            </div>
                            <span id="managePaymentError" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>





                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>Manage Roles & Permissions</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="roles")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rolesAdd" name="rolesAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="rolesAdd">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rolesView" name="rolesView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="rolesView">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rolesEdit" name="rolesEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="rolesEdit">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rolesDelete" name="rolesDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="rolesDelete">Delete</label>
                                </div>
                            </div>
                            <span id="managerolesandpermision_error" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>Pages</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="pages")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="pagesAdd" name="pagesAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="pagesAdd">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="pagesView" name="pagesView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="pagesView">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="pagesEdit" name="pagesEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="pagesEdit">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="pagesDelete" name="pagesDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="pagesDelete">Delete</label>
                                </div>
                            </div>
                            <span id="pages_error" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>Masters</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="masters")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="mastersAdd" name="mastersAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="mastersAdd">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="mastersView" name="mastersView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="mastersView">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="mastersEdit" name="mastersEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="mastersEdit">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="mastersDelete" name="mastersDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="mastersDelete">Delete</label>
                                </div>
                            </div>
                            <span id="masters_error" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>Reports</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="reports")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="reportsAdd" name="reportsAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="reportsAdd">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="reportsView" name="reportsView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="reportsView">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="reportsEdit" name="reportsEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="reportsEdit">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="reportsDelete" name="reportsDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="reportsDelete">Delete</label>
                                </div>
                            </div>
                            <span id="reports_error" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>My Scans</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="scans")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="scansAdd" name="scansAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="scansAdd">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="scansView" name="scansView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="scansView">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="scansEdit" name="scansEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="scansEdit">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="scansDelete" name="scansDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="scansDelete">Delete</label>
                                </div>
                            </div>
                            <span id="myscans_error" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group p-2">
                            <label>System Settings</label>
                            @foreach ( $permissions as $val)
                            @if($val->permissionsname=="systemsetting")
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="settingsAdd" name="settingsAdd" {{ $val->isAdd ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="settingsAdd">Add</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="settingsView" name="settingsView" {{ $val->isView ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="settingsView">View</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="settingsEdit" name="settingsEdit" {{ $val->isEdit ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="settingsEdit">Edit</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="settingsDelete" name="settingsDelete" {{ $val->isDelete ? 'checked' : '' }}>
                                    <label class="form-check-label text-wrap" for="settingsDelete">Delete</label>
                                </div>
                            </div>
                            <span id="systemsettings_error" class="form-text text-danger"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <div class="status-container col-md-6 d-flex justify-content-between">
                        <div><label>Status</label></div>

                        <div
                            class="form-check form-switch d-flex align-item-center justify-content-center">
                            <input
                                class="form-check-input custom-switch checkinput1"
                                type="checkbox"
                                name="isActive"
                                {{ $user->isActive ? 'checked' : '' }} />
                        </div>
                    </div>
                    <div class="toggleswitch position-absolute">
                        <label for="status">
                            Toggle this switch to activate or deactivate the sub-admin.
                        </label>
                    </div>
                </div>
                <div class="row rowbutton">
                    <div class="col-md-3 submitbutton">
                        <button
                            type="button"
                            class="btn btn-block btn-success submitbutton btn-sm"
                            id="submitBtn">
                            Submit
                        </button>
                    </div>
                    <div class="col-md-3 submitbutton1">
                        <a href="{{url('/admin/manageroleandpermissions')}}">
                            <button
                                type="button"
                                class="btn btn-block back submitbutton1 border btn-sm submitBtn">
                                Back
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection