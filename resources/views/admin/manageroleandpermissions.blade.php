@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/manageRole&permission.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')


<div class="container-fluid p-2">
    @livewire('ManageRoleAndPermission');
</div>


<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form action="{{ route('role.store') }}" method="post" id="addRoleForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="role-title">Role Title</label>
                            <input type="text" class="form-control rounded-3" id="role-title" placeholder="Enter" name="role" />
                            <small class="text-danger" id="role_error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="status-container">
                            <label>Status</label>
                            <div class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input type="hidden" name="isActive" value="false">
                                <input class="form-check-input custom-switch checkinput1" type="checkbox" name="isActive" />
                            </div>
                        </div>
                        <div class="toggleswitch position-absolute">
                            <label for="status">Toggle this switch to activate or deactivate the role.</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block form-control addRoleSubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addRoleForm').submit(function(e) {
            e.preventDefault();
            $(".addRoleSubmit").prop('disabled', true);

            // Validate form
            if (validateForm()) {
                var baseurl = $(this).attr('action'); // Get form action URL

                $.ajax({
                    type: 'POST',
                    url: baseurl,
                    data: $(this).serialize(), // Serialize form data
                    dataType: 'json',
                    success: function(response) {
                        $(".addRoleSubmit").prop('disabled', false);
                        if (response.Success) {
                            sessionStorage.setItem('successMessage', response.Message);
                            window.location.href = '/admin/manageroleandpermissions';
                        } else {
                            handleErrors(response.Errors);
                        }
                    },
                    error: function(xhr) {
                        $(".addRoleSubmit").prop('disabled', false);
                        console.error(xhr.responseText);
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            handleErrors(jsonResponse.Errors || []);
                        } catch (e) {
                            console.error("Parsing error:", e); // Log parsing errors
                        }
                    }
                });
            } else {
                $(".addRoleSubmit").prop('disabled', false); // Re-enable button if validation fails
            }
        });

        // Form validation function
        function validateForm() {
            var isValid = true;
            $('.is-invalid').removeClass('is-invalid'); // Remove all previous error classes
            $('.text-danger').html(''); // Clear all error messages

            var roleTitleInput = $('#role-title');
            if (roleTitleInput.val().trim() === '') {
                roleTitleInput.addClass('is-invalid');
                $('#role_error').html('Role title is required.');
                isValid = false;
            }

            return isValid;
        }

        // Handle server-side validation errors
        function handleErrors(errors) {
            // Clear previous errors
            $('.text-danger').html('');
            $('.is-invalid').removeClass('is-invalid');

            $.each(errors, function(index, error) {
                // Use the field name to identify the correct input
                $('#' + error.field + '_error').html(error.message);
                $('#' + error.field).addClass('is-invalid');
            });
        }

        // Remove error messages dynamically when the user starts typing
        $('#addRoleForm input').on('input', function() {
            var input = $(this);
            input.removeClass('is-invalid');
            $('#' + input.attr('id') + '_error').html('');
        });
    });
</script>




<!-- Edit Role Modal -->
<div
    class="modal fade"
    id="editROleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role <span id="edId"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form id="editroleform">
                    @csrf
                    <input type="hidden" name="role_id" id="edit_roleId">

                    <div class="form-group">
                        <label for="category-title">Role Title</label>
                        <input
                            type="text"
                            class="form-control"
                            id="category-title"
                            placeholder="Enter"
                            name="editrolename" />
                        <small class="text-danger" id="editrolename_error"></small>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input
                                class="form-check-input custom-switch checkinput1"
                                type="checkbox"
                                id="edit_status"
                                name="status"
                                value="1" />
                        </div>
                        <small class="toggleswitch">
                            Toggle this switch to activate or deactivate the role.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary form-control addRolesubmit">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener('livewire:init', () => {
        Livewire.on('role-edit', async (event) => {


      
            const data = event[0]; 


            const {
                id,
                rolesname,
                isActive
            } = data;

            $('#edit_roleId').val(id);
            $('#category-title').val(rolesname);
            $('#edit_status').prop('checked', isActive == 1);

            // Show the modal
            $('#editROleModal').modal('show');

        });
    });
    $(document).ready(function() {
        // Populate the modal with existing data
     
        // Handle the AJAX form submission
        $('#editroleform').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                _token: $('input[name="_token"]').val(),
                role_id: $('#edit_roleId').val(),
                editrolename: $('#category-title').val(),
                status: $('#edit_status').is(':checked') ? 1 : 0
            };

            // Clear previous error messages
            $('#editrolename_error').text('');

            $.ajax({
                url: "{{ route('updaterole') }}",
                method: "PUT",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#editROleModal').modal('hide');
                        sessionStorage.setItem('successMessage', response.message);
                        location.reload();
                    } else {
                        sessionStorage.setItem('errorMessage', response.message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.editrolename) {
                            $('#editrolename_error').text(errors.editrolename[0]);
                        }
                    } else {
                        sessionStorage.setItem('errorMessage', xhr.responseJSON.message || "An error occurred.");
                        location.reload();
                    }
                }
            });
        });
    });
</script>









@endsection