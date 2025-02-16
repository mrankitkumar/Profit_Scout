@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/Masters.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')

<div class="container-fluid p-1">
    @livewire('Adminmaster');
</div>




<!-- Add Category  -->
<div
    class="modal fade"
    id="addCategoryModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form action="{{ route('category.store') }}" method="post" id="addCategoryForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="category-title">Category Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="category-title"
                                placeholder="Enter"
                                name="category" />
                            <small class="text-danger" id="category_error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="status-container">
                            <label>Status</label>
                            <div
                                class="form-check form-switch d-flex align-item-center justify-content-center">
                                <input type="hidden" name="isActive" value="false">
                                <input
                                    class="form-check-input custom-switch checkinput1"
                                    type="checkbox"
                                    name="isActive" />
                            </div>
                        </div>
                        <div class="toggleswitch position-absolute">
                            <label for="status">
                                Toggle this switch to activate or deactivate the category.
                            </label>
                        </div>
                    </div>
                    <button
                        type="submit"
                        id="submit-btn"
                        class="addCategorysubmit">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addCategoryForm').submit(function(e) {
            e.preventDefault();
            $("#submit-btn").prop('disabled', true);

            // Validate form
            if (validateForm()) {
                var baseurl = $(this).attr('action'); // Get form action URL

                $.ajax({
                    type: 'POST',
                    url: baseurl,
                    data: $(this).serialize(), // Serialize form data
                    dataType: 'json',
                    success: function(response) {
                        $("#submit-btn").prop('disabled', false);
                        if (response.Success) {
                            sessionStorage.setItem('successMessage', response.Message);
                            window.location.href = '/admin/masters';
                        } else {
                            handleErrors(response.Errors);
                        }
                    },
                    error: function(xhr) {
                        $("#submit-btn").prop('disabled', false);
                        console.error(xhr.responseText); // Log the raw response for debugging
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            handleErrors(jsonResponse.Errors || []); // Handle errors
                        } catch (e) {
                            console.error("Parsing error:", e); // Log parsing errors
                        }
                    }
                });
            } else {
                $("#submit-btn").prop('disabled', false); // Re-enable button if validation fails
            }
        });

        // Form validation function
        function validateForm() {
            var isValid = true;
            $('.is-invalid').removeClass('is-invalid'); // Remove all previous error classes
            $('.text-danger').html(''); // Clear all error messages

            var categoryInput = $('#category-title');
            if (categoryInput.val().trim() === '') {
                categoryInput.addClass('is-invalid');
                $('#category_error').html('Category Title is required');
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
                $('#' + error.field + '_error').html(error.message); // Display error message
                $('#' + error.field).addClass('is-invalid'); // Add error class to input
            });
        }

        // Remove error messages dynamically when the user starts typing
        $('#addCategoryForm input').on('input', function() {
            var input = $(this);
            input.removeClass('is-invalid'); // Remove the 'is-invalid' class when typing
            $('#' + input.attr('id') + '_error').html(''); // Clear the error message
        });
    });
</script>







<!-- addCountryModal -->
<div
    class="modal fade"
    id="addCountryModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form id="addCountryForm" action="{{ route('Country.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="country-title">Country Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="country-title"
                                placeholder="Enter"
                                name="country" />
                            <small class="text-danger" id="country_error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="status-container">
                            <label>Status</label>
                            <div
                                class="form-check form-switch d-flex align-item-center justify-content-center">
                                <input type="hidden" name="isActive" value="false">
                                <input
                                    class="form-check-input custom-switch checkinput1"
                                    type="checkbox"
                                    name="isActive" />
                            </div>
                        </div>
                        <div class="toggleswitch position-absolute">
                            <label for="status">
                                Toggle this switch to activate or deactivate the country.
                            </label>
                        </div>
                    </div>
                    <button
                        type="submit"
                        id="submit-btn"
                        class="addCategorysubmit">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addCountryForm').submit(function(e) {
            e.preventDefault();
            $("#submit-btn").prop('disabled', true);

            // Validate form
            if (validateForm()) {
                var baseurl = $(this).attr('action'); // Get form action URL

                $.ajax({
                    type: 'POST',
                    url: baseurl,
                    data: $(this).serialize(), // Serialize form data
                    dataType: 'json',
                    success: function(response) {
                        $("#submit-btn").prop('disabled', false); // Re-enable button
                        if (response.Success) {
                            sessionStorage.setItem('successMessage', response.Message);
                            window.location.href = '/admin/masters';
                        } else {
                            handleErrors(response.Errors); // Display server-side validation errors
                        }
                    },
                    error: function(xhr) {
                        $("#submit-btn").prop('disabled', false);
                        console.error(xhr.responseText); // Log the raw response for debugging
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            handleErrors(jsonResponse.Errors || []); // Handle errors
                        } catch (e) {
                            console.error("Parsing error:", e); // Log parsing errors
                        }
                    }
                });
            } else {
                $("#submit-btn").prop('disabled', false); // Re-enable button if validation fails
            }
        });

        // Form validation function
        function validateForm() {
            var isValid = true;
            $('.is-invalid').removeClass('is-invalid'); // Remove all previous error classes
            $('.text-danger').html(''); // Clear all error messages

            var countryInput = $('#country-title');
            if (countryInput.val().trim() === '') {
                countryInput.addClass('is-invalid');
                $('#country_error').html('Country Title is required');
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
                $('#' + error.field + '_error').html(error.message); // Display error message
                $('#' + error.field).addClass('is-invalid'); // Add error class to input
            });
        }

        // Remove error messages dynamically when the user starts typing
        $('#addCountryForm input').on('input', function() {
            var input = $(this);
            input.removeClass('is-invalid'); // Remove the 'is-invalid' class when typing
            $('#' + input.attr('id') + '_error').html(''); // Clear the error message
        });
    });
</script>







<!-- addLanguageModal -->
<div
    class="modal fade"
    id="addLanguageModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Language</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form id="addLanguageForm" action="{{ route('language.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="language-title">Language Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="language-title"
                                placeholder="Enter"
                                name="addlanguage" />

                            <small class="text-danger" id="addlanguage_error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="status-container">
                            <label>Status</label>
                            <div
                                class="form-check form-switch d-flex align-item-center justify-content-center">
                                <input type="hidden" name="isActive" value="false">
                                <input
                                    class="form-check-input custom-switch checkinput1"
                                    type="checkbox"
                                    name="isActive" />
                            </div>
                        </div>
                        <div class="toggleswitch position-absolute">
                            <label for="status">
                                Toggle this switch to activate or deactivate the language.
                            </label>
                        </div>
                    </div>
                    <button
                        type="submit"
                        id="submit-btn"
                        class="addCategorysubmit">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addLanguageForm').submit(function(e) {
            e.preventDefault();
            $("#submit-btn").prop('disabled', true);

            // Validate form
            if (validateForm()) {
                var baseurl = $(this).attr('action'); // Get form action URL

                $.ajax({
                    type: 'POST',
                    url: baseurl,
                    data: $(this).serialize(), // Serialize form data
                    dataType: 'json',
                    success: function(response) {
                        $("#submit-btn").prop('disabled', false); // Re-enable button
                        if (response.Success) {
                            sessionStorage.setItem('successMessage', response.Message);
                            window.location.href = '/admin/masters';
                        } else {
                            handleErrors(response.Errors); // Display server-side validation errors
                        }
                    },
                    error: function(xhr) {
                        $("#submit-btn").prop('disabled', false);
                        console.error(xhr.responseText); // Log the raw response for debugging
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            handleErrors(jsonResponse.Errors || []); // Handle errors
                        } catch (e) {
                            console.error("Parsing error:", e); // Log parsing errors
                        }
                    }
                });
            } else {
                $("#submit-btn").prop('disabled', false); // Re-enable button if validation fails
            }
        });

        // Form validation function
        function validateForm() {
            var isValid = true;
            $('.is-invalid').removeClass('is-invalid'); // Remove all previous error classes
            $('.text-danger').html(''); // Clear all error messages

            var languageInput = $('#language-title');
            if (languageInput.val().trim() === '') {
                languageInput.addClass('is-invalid');
                $('#addlanguage_error').html('Language Title is required');
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

                $('#' + error.field + '_error').html(error.message); // Display error message

                $('#' + error.field).addClass('is-invalid'); // Add error class to input
            });
        }

        // Remove error messages dynamically when the user starts typing
        $('#addLanguageForm input').on('input', function() {
            var input = $(this);
            input.removeClass('is-invalid'); // Remove the 'is-invalid' class when typing
            $('#' + input.attr('id') + '_error').html(''); // Clear the error message
        });
    });
</script>







<!-- Edit Category Modal -->
<div
    class="modal fade"
    id="editCategoryModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form id="editCategoryForm">
                    @csrf
                    <input type="hidden" name="cat_id" id="edit_catId">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="edit_category-title">Category Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_category-title"
                                placeholder="Enter category name"
                                name="category" />
                            <small class="text-danger" id="editcategory_error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="status-container">
                            <label>Status</label>
                            <div
                                class="form-check form-switch d-flex align-item-center justify-content-center">
                                <input type="hidden" name="status" value="0">
                                <input
                                    class="form-check-input custom-switch checkinput1"
                                    type="checkbox"
                                    id="edit_status"
                                    name="status"
                                    value="{{ old('status') ? 'checked' : '' }}" />
                            </div>
                        </div>
                        <div class="toggleswitch position-absolute">
                            <label for="status">
                                Toggle this switch to activate or deactivate the category.
                            </label>
                        </div>
                    </div>
                    <button type="button" id="saveEditCategory" class="addCategorysubmit">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('message-sent', async (event) => {


            // Check if the event is an array, and get the first element
            const data = event[0]; // Access the first element of the array


            const {
                catId,
                catName,
                catIsActive
            } = data;



            // Update the form fields with the received data
            $('#edit_catId').val(catId);
            $('#edit_category-title').val(catName);
            $('#edit_status').prop('checked', catIsActive == 1); // If catIsActive is 1, check the checkbox

            // Show the modal
            $('#editCategoryModal').modal('show');
        });
    });



    $(document).ready(function() {
        // Populate the modal with existing data


        // Handle the AJAX form submission
        $('#saveEditCategory').on('click', function() {
            const formData = {
                _token: $('input[name="_token"]').val(),
                cat_id: $('#edit_catId').val(),
                category: $('#edit_category-title').val(),
                status: $('#edit_status').is(':checked') ? 1 : 0
            };

            // Clear previous error messages
            $('#editcategory_error').text('');

            $.ajax({
                url: "{{ route('updateCategory') }}",
                method: "PUT",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Close the modal
                        $('#editCategoryModal').modal('hide');
                        sessionStorage.setItem('successMessage', response.message);



                        location.reload();
                    } else {
                        // Show a general error message if needed

                        sessionStorage.setItem('errorMessage', response.message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Display validation errors
                        const errors = xhr.responseJSON.errors;
                        // alert(errors);
                        if (errors.category) {
                            $('#editcategory_error').text(errors.category[0]);
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


<!-- Edit Country Modal -->
<div
    class="modal fade"
    id="editCountryModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form id="editCountryForm">
                    @csrf
                    <input type="hidden" name="country_id" id="edit_countryId">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="country-title">Country Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_country-title"
                                placeholder="Enter country name"
                                name="editcountry" />
                            <small class="text-danger" id="editcountry_error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check form-switch d-flex align-item-center justify-content-center">
                            <input type="hidden" name="status" value="0">
                            <input
                                class="form-check-input custom-switch checkinput1"
                                type="checkbox"
                                id="editcountry_status"
                                name="status" />
                        </div>
                    </div>
                    <button type="button" id="saveEditCountry" class="addCategorysubmit">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('country-edit', async (event) => {


            // Check if the event is an array, and get the first element
            const data = event[0]; // Access the first element of the array


            const {
                id,
                countryname,
                isActive
            } = data;

            $('#edit_countryId').val(id);
            $('#edit_country-title').val(countryname);
            $('#editcountry_status').prop('checked', isActive == 1);

            // Show the modal
            $('#editCountryModal').modal('show');

        });
    });
    $(document).ready(function() {


        // Handle the AJAX form submission
        $('#saveEditCountry').on('click', function() {
            const formData = {
                _token: $('input[name="_token"]').val(),
                country_id: $('#edit_countryId').val(),
                country: $('#edit_country-title').val(),
                status: $('#editcountry_status').is(':checked') ? 1 : 0,
            };

            // Clear previous error messages
            $('#editcountry_error').text('');

            $.ajax({
                url: "{{ route('updateCountry') }}",
                method: "PUT",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Close the modal
                        $('#editCountryModal').modal('hide');
                        sessionStorage.setItem('successMessage', response.message);

                        // Refresh the page or dynamically update the table
                        location.reload();
                    } else {
                        // Show a general error message if needed
                        sessionStorage.setItem('errorMessage', response.message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Display validation errors
                        const errors = xhr.responseJSON.errors;
                        if (errors.country) {
                            $('#editcountry_error').text(errors.country[0]);
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





<!-- Edit Language Modal -->
<div
    class="modal fade"
    id="editLanguageModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mcon1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Language - <span id="LanguageId"></span></h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.75rem 1.75rem">
                <form id="editLanguageForm">
                    @csrf
                    <input type="hidden" id="edit_languageId" name="language_id">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="language-title">Language Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_language-title"
                                placeholder="Enter Language Name"
                                name="language" />
                            <small class="text-danger" id="editlanguage_error"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check form-switch d-flex align-items-center justify-content-center">
                            <input type="hidden" name="status" value="0">
                            <input
                                class="form-check-input custom-switch checkinput1"
                                type="checkbox"
                                id="editlanguage_status"
                                name="status" />
                        </div>
                    </div>
                    <button type="button" id="saveEditLanguage" class="addCategorysubmit">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('language-edit', async (event) => {


      
            const data = event[0]; 


            const {
                id,
                languagename,
                isActive
            } = data;

            $('#edit_languageId').val(id);
            $('#edit_language-title').val(languagename);
            $('#editlanguage_status').prop('checked', isActive == 1);


            $('#editLanguageModal').modal('show');

        });
    });
    $(document).ready(function() {

      

        $('#saveEditLanguage').on('click', function() {
            const formData = {
                _token: $('input[name="_token"]').val(),
                language_id: $('#edit_languageId').val(),
                language: $('#edit_language-title').val(),
                status: $('#editlanguage_status').is(':checked') ? 1 : 0,
            };

            // Clear previous error messages
            $('#editlanguage_error').text('');

            $.ajax({
                url: "{{ route('updateLanguage') }}",
                method: "PUT",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Close the modal
                        $('#editLanguageModal').modal('hide');
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
                        if (errors.language) {
                            $('#editlanguage_error').text(errors.language[0]);
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