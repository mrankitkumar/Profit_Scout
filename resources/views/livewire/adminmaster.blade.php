<div>
    <div class="border master bg-white">
        <div
            class="d-block d-md-block d-lg-flex d-xl-flex justify-content-between align-items-center p-2 bg-white buttongroup">

            <div id="buttonGroup" class="d-flex col-12 col-lg-6 text-wrap ml-n1">
                <button
                    id="showcategorybtn"
                    class="btn addcategory btn2 col-3 col-lg-3 text-nowrap align-item-left {{ $isCategoriesTab ? 'active' : '' }}"
                    wire:click="switchTab('categories')">
                    Category
                </button>
                <button
                    id="showcountrybtn"
                    class="btn ml-1 addCountry col-3 col-lg-3 text-nowrap btn2 align-item-left {{ $isCountryTab ? 'active' : '' }}"
                    wire:click="switchTab('country')">
                    Country
                </button>
                <button
                    id="showcitybtn"
                    class="btn ml-1 addcity col-3 col-lg-3 text-nowrap align-item-left btn2 {{ $isCityTab ? 'active' : '' }}"
                    wire:click="switchTab('city')">
                    City
                </button>
                <button
                    id="showlanguagebtn"
                    class="btn ml-1 addLanguage col-3 col-lg-3 text-nowrap align-item-left btn2 {{ $isLanguageTab ? 'active' : '' }}"
                    wire:click="switchTab('language')">
                    Language
                </button>
            </div>


            @if($isCategoriesTab)
            <!-- Add Category Button -->
            <button class="addcategorybtn mt-1" data-toggle="modal"
                data-target="#addCategoryModal" id="addcategory">
                <img
                    src="{{ url('img/admin/add_circle.svg')}}"
                    alt="Add"
                    class="imgadd" />
                Add New Category
            </button>

            <!-- Search for Category -->
            <div class="input-group col-lg-2 col-md-12 col-12 mt-1 ml-md-1 rounded-3 border" id="searchcategory">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input
                    type="text"
                    wire:model="keyword"
                    class="form-control border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search"
                    wire:input="searchCategories(1)" />
            </div>
            @endif

            @if($isCountryTab)
            <!-- Add Country Button -->
            <button class="addcountrybtn mt-1 " data-toggle="modal"
                data-target="#addCountryModal" id="addcountrybtn">
                <img
                    src="{{ url('img/admin/add_circle.svg')}}"
                    alt="Add"
                    class="imgadd" />
                Add New Country
            </button>

            <!-- Search for Country -->
            <div class="input-group col-lg-2 col-md-12 col-12 mt-1 ml-md-1 rounded-3 border " id="searchCountry">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input
                    type="text"
                    wire:model="keyword"
                    class="form-control border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search"
                    wire:input="searchCountry(1)" />
            </div>
            @endif


            @if ($isCityTab)
            <!-- add for city  -->
            <button class="addCitybtn mt-1" data-toggle="modal"
                data-target="#addCityModal" id="addCitybtn">

                <img
                    src="{{ url('img/admin/add_circle.svg')}}"
                    alt="Add"
                    class="imgadd" />
                Add New City

            </button>
            <!-- Search for city -->
            <div class="input-group col-lg-2 col-md-12 col-12 mt-1 ml-md-1  rounded-3 border " id="searchcity">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input
                    type="text"
                    wire:model="keyword"
                    class="form-control border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search"
                    wire:input="searchCity(1)" />
            </div>
            @endif

            @if($isLanguageTab)
            <!-- add  Language  -->
            <button class="addlanguagebtn mt-1 " data-toggle="modal"
                data-target="#addLanguageModal" id="addlanguagebtn">
                <img
                    src="{{ url('img/admin/add_circle.svg')}}"
                    alt="Add"
                    class="imgadd" />
                Add New Language
            </button>

            <!-- Search for Language -->
            <div class="input-group col-lg-2 col-md-12 col-12 mt-1 ml-md-1 border rounded-3 " id="searchLanguage">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input
                    type="text"
                    wire:model="keyword"
                    class="form-control border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search"
                    wire:input="searchLanguage(1)" />
            </div>
            @endif

        </div>

        @if($isCategoriesTab)
        <!-- <div> 1  category-->
        <div
            id="CategoryTable"
            class="table-responsive"
            style="display: block">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $val)
                    <!-- Sample data rows -->
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->name}}</td>
                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput"
                                    type="checkbox"
                                    {{ $val->isActive ? 'checked' : '' }}
                                    wire:click="updateStatuscategory({{ $val->id }})" />
                            </div>
                        </td>
                        <td class="action-icons" style="word-spacing: 6px">
                            <img
                                src="{{ url('img/admin/edit.svg')}}"
                                alt="Edit"
                                title="Edit"
                                wire:click="editcategory({{ $val->id }})" />
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deleteCategoryModal"
                                data-id="{{$val->id}}"
                                class="delete-cat" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        @endif


        @if($isCountryTab)
        <!-- </div>2 country -->
        <div
            id="countrytable"
            class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Country ID</th>
                        <th>Country Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data rows -->
                    @foreach ($countries as $val)
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->countryname}}</td>
                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput"
                                    type="checkbox"
                                    {{ $val->isActive ? 'checked' : '' }}
                                    wire:click="updateStatuscountry({{ $val->id }})" />
                            </div>
                        </td>
                        <td class="action-icons" style="word-spacing: 6px">

                            <img
                                src="{{ url('img/admin/edit.svg')}}"
                                alt="Edit"
                                title="Edit"

                                wire:click="editcountry({{ $val->id }})"

                                class="editcountry" />
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deleteCountryModal"
                                data-id="{{$val->id}}"
                                class="delete-country" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        @endif


        @if ($isCityTab)
        <!-- ... city ... -->
        <div id="cityTable" class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>City ID</th>
                        <th>Country Title</th>
                        <th>City Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data rows -->
                    @foreach ($cities as $val)
                    <tr>

                        <td>{{$val->id}}</td>
                        <td>{{$val->countryname}}</td>
                        <td>{{$val->cityname}}</td>
                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput"
                                    type="checkbox"
                                    {{ $val->isActive ? 'checked' : '' }}
                                    wire:click="updateStatuscity({{ $val->id }})" />
                            </div>
                        </td>
                        <td class="action-icons" style="word-spacing: 6px">

                            <img
                                src="{{ url('img/admin/edit.svg')}}"
                                alt="Edit"
                                title="Edit"

                                wire:click="cityedit({{ $val->id }})"
                                class="edit-city" />
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deleteCityModal"
                                data-id="{{$val->id}}"
                                class="delete-city" />
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>


        </div>

        @endif


        @if($isLanguageTab)
        <!-- ..... Language ...  -->
        <div
            id="lanaguageTable"
            class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Language ID</th>
                        <th>Language Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($languages as $val)
                    <!-- Sample data rows -->
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->languagename}}</td>
                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput"
                                    type="checkbox"
                                    {{ $val->isActive ? 'checked' : '' }}
                                    wire:click="updateStatuslanguage({{ $val->id }})" />
                            </div>
                        </td>
                        <td class="action-icons" style="word-spacing: 6px">

                            <img
                                src="{{ url('img/admin/edit.svg')}}"
                                alt="Edit"
                                title="Edit"

                                wire:click="editlanguage({{ $val->id }})"
                                
                                class="edit-language" />
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deleteLanguageModal"
                                data-id="{{$val->id}}"
                                class="delete-language" />
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3 p-2">
            <div class="entries-info"></div>
            <nav aria-label="Page navigation" style="display: flex">
                <ul class="pagination justify-content-center mb-0">
                    <!-- Previous Button -->
                    <li class="page-item" id="prevButton">
                        <a class="page-link pagination" href="#" wire:click="changePage(-1)" tabindex="-1">Previous</a>
                    </li>

                    @if ($isCategoriesTab)
                    @for ($i = 1; $i <= $categoriesCount; $i++)
                        <li class="page-item" id="page{{ $i }}">
                        <a class="page-link {{ $i == $categoriesPage ? 'active' : '' }} pagination" href="#"
                            wire:click="changePage({{ $i - $categoriesPage }})">{{ $i }}</a>
                        </li>
                        @endfor
                        @elseif ($isCountryTab)
                        @for ($i = 1; $i <= $countryCount; $i++)
                            <li class="page-item" id="page{{ $i }}">
                            <a class="page-link {{ $i == $countryPage ? 'active' : '' }} pagination" href="#"
                                wire:click="changePage({{ $i - $countryPage }})">{{ $i }}</a>
                            </li>
                            @endfor
                            @elseif ($isCityTab)
                            @for ($i = 1; $i <= $cityCount; $i++)
                                <li class="page-item" id="page{{ $i }}">
                                <a class="page-link {{ $i == $cityPage ? 'active' : '' }} pagination" href="#"
                                    wire:click="changePage({{ $i - $cityPage }})">{{ $i }}</a>
                                </li>
                                @endfor
                                @elseif ($isLanguageTab)
                                @for ($i = 1; $i <= $languageCount; $i++)
                                    <li class="page-item" id="page{{ $i }}">
                                    <a class="page-link {{ $i == $languagePage ? 'active' : '' }} pagination" href="#"
                                        wire:click="changePage({{ $i - $languagePage }})">{{ $i }}</a>
                                    </li>
                                    @endfor
                                    @endif

                                    <!-- Next Button -->
                                    <li class="page-item" id="nextButton">
                                        <a class="page-link pagination" href="#" wire:click="changePage(1)">Next</a>
                                    </li>
                </ul>
            </nav>
        </div>

    </div>





    <!-- addCityModal  -->

    <div
        class="modal fade"
        id="addCityModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content mcon2">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('city.store') }}" method="post" id="addCityForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="country-select">Country</label>
                                <select
                                    class="form-control smallwidth"
                                    aria-label="Country"
                                    id="country-select"
                                    name="country">
                                    <option value="" selected>Country</option>
                                    @foreach ($countries as $val)
                                    <option value="{{ $val->id }}">{{ $val->countryname }}</option>
                                    @endforeach

                                </select>
                                <small class="text-danger" id="country_error"></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="city-title">City Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="city-title"
                                    placeholder="Enter"
                                    name="city" />
                                <small class="text-danger" id="city_error"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="status-container">
                                <label>Status</label>
                                <div class="form-check form-switch d-flex align-item-center justify-content-center">
                                    <input type="hidden" name="isActive" value="false">
                                    <input
                                        class="form-check-input custom-switch checkinput1"
                                        type="checkbox"
                                        name="isActive" />
                                </div>
                            </div>
                            <div class="toggleswitch position-absolute">
                                <label for="status">
                                    Toggle this switch to activate or deactivate the city.
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
            $('#addCityForm').submit(function(e) {
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

                var countryInput = $('#country-select');
                if (countryInput.val().trim() === '') {
                    countryInput.addClass('is-invalid');
                    $('#country_error').html('Country is required');
                    isValid = false;
                }

                var cityInput = $('#city-title');
                if (cityInput.val().trim() === '') {
                    cityInput.addClass('is-invalid');
                    $('#city_error').html('City Title is required');
                    isValid = false;
                }

                return isValid;
            }

            // Handle server-side validation errors
            function handleErrors(errors) {

                $('.text-danger').html('');
                $('.is-invalid').removeClass('is-invalid');

                $.each(errors, function(index, error) {

                    $('#' + error.field + '_error').html(error.message);
                    $('#' + error.field).addClass('is-invalid');
                });
            }


            $('#addCityForm input, #addCityForm select').on('input', function() {
                var input = $(this);
                input.removeClass('is-invalid');
                $('#' + input.attr('id') + '_error').html('');
            });
        });
    </script>


    <!-- Edit City Modal -->
    <div
        class="modal fade"
        id="editCityModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content mcon2">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0.75rem 1.75rem">
                    <form id="editCityForm">
                        @csrf
                        <input type="hidden" name="city_id" id="editcityid" value="" >
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="country-title">Country</label>
                                <select
                                    class="form-control"
                                    id="edit_country-select"
                                    name="country_id">
                                    <option value="" selected>Select Country</option>
                                    @foreach ($countries as $val)
                                    <option value="{{ $val->id }}">{{ $val->countryname }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="edit_country_error"></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="city-title">City Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="edit_city-title"
                                    placeholder="Enter City Name"
                                    name="city" />
                                <small class="text-danger" id="edit_city_error"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input type="hidden" name="status" value="0">
                                <input
                                    class="form-check-input custom-switch checkinput1"
                                    type="checkbox"
                                    id="edit_city_status"
                                    name="status" />
                            </div>
                        </div>
                        <button type="button" id="saveEditCity" class="addCategorysubmit">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        let cityid;
        document.addEventListener('livewire:init', () => {
            Livewire.on('city-edit', async (event) => {
               
                // Access the first element from the event (since it's an array)
                const data = event[0]; // Access the first object in the array

                // Destructure the event object
                const {
                    id,
                    countryid,
                    cityname,
                    isActive
                } = data;
         
                $('#editcityid').val(id); // Set the city ID field value
                cityid=id;
                $('#edit_city-title').val(cityname); // Set the city name field value

                // Populate the country select field based on countryid
                $('#edit_country-select option').each(function() {
                    // Compare the value of the option with the countryid
                    if ($(this).val().trim() === countryid.trim()) {
                        $(this).prop('selected', true); // Set the option as selected
                    }
                });

                // Set the checkbox status (checked or unchecked)
                $('#edit_city_status').prop('checked', isActive == 1);

                // Show the modal
                $('#editCityModal').modal('show');
            });
        });



        $(document).ready(function() {
            // Populate the modal with existing data


            // Handle the AJAX form submission
            $('#saveEditCity').on('click', function() {
                const formData = {
                    _token: $('input[name="_token"]').val(),
                    city_id:cityid,
                    city: $('#edit_city-title').val(),
                    country_id: $('#edit_country-select').val(),
                    status: $('#edit_city_status').is(':checked') ? 1 : 0,
                };
             //   console.log(formData);

                // Clear previous error messages
                $('#edit_city_error').text('');
                $('#edit_country_error').text('');

                $.ajax({
                    url: "{{ route('updateCity') }}",
                    method: "PUT",
                    data: formData,
                    success: function(response) {
                        if (response.success) {

                            $('#editCityModal').modal('hide');
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
                            if (errors.city) {
                                $('#edit_city_error').text(errors.city[0]);
                            }
                            if (errors.country_id) {
                                $('#edit_country_error').text(errors.country_id[0]);
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


    <!-- Delete Category Modal -->
    <div
        class="modal fade"
        id="deleteCategoryModal"
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
                <div class="modal-header">
                    <h5 class="text-center categorytextheading">
                        Are you sure you want to delete this category? <br>
                        This action cannot be undone.
                    </h5>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <button type="button " class="no" data-dismiss="modal">No</button>
                    <!-- Column line -->
                    <div class="line"></div>
                    <button
                        type="button"
                        class="yes" id="confirmDeleteCategory">
                        Yes, Sure
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Trigger modal when delete button is clicked
            $('.delete-cat').on('click', function() {
                const catId = $(this).data('id');


                $('#confirmDeleteCategory').attr('wire:click', `deleteCategory(${catId})`);


                $('#deleteCategoryModal').modal('show');
            });
        });
    </script>

    <!-- delete country modal  -->
    <div
        class="modal fade"
        id="deleteCountryModal"
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
                <div class="modal-header">
                    <h5 class="text-center countrytextheading">
                        Are you sure you want to delete this country? <br>
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
                        id="confirmDeleteCountry">
                        Yes, Sure
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Trigger modal when delete button is clicked
            $('.delete-country').on('click', function() {
                const catId = $(this).data('id');


                $('#confirmDeleteCountry').attr('wire:click', `deleteCountry(${catId})`);


                $('#deleteCountryModal').modal('show');
            });
        });
    </script>


    <!-- deleteCityModal  -->
    <div
        class="modal fade"
        id="deleteCityModal"
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
                <div class="modal-header">
                    <h5 class="text-center textheading">
                        Are you sure you want to delete this city? <br>
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
                        id="confirmDeleteCity">
                        Yes, Sure
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Trigger modal when delete button is clicked
            $('.delete-city').on('click', function() {
                const catId = $(this).data('id');


                $('#confirmDeleteCity').attr('wire:click', `deleteCity(${catId})`);


                $('#deleteCityModal').modal('show');
            });
        });
    </script>

    <!-- deleteLanguageModal  -->
    <div
        class="modal fade"
        id="deleteLanguageModal"
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
                <div class="modal-header">
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
                        id="confirmDeletelanguage">
                        Yes, Sure
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Trigger modal when delete button is clicked
            $('.delete-language').on('click', function() {
                const catId = $(this).data('id');


                $('#confirmDeletelanguage').attr('wire:click', `deleteLanguage(${catId})`);


                $('#deleteLanguageModal').modal('show');
            });
        });
    </script>


    <script>
        window.addEventListener('category-deleted', event => {
            sessionStorage.setItem('successMessage', 'Category deleted successfully.');
            window.location.reload();
        });
        window.addEventListener('country-deleted', event => {
            sessionStorage.setItem('successMessage', 'Country deleted successfully.');
            window.location.reload();
        });
        window.addEventListener('city-deleted', event => {
            sessionStorage.setItem('successMessage', 'City deleted successfully.');
            window.location.reload();
        });
        window.addEventListener('language-deleted', event => {
            sessionStorage.setItem('successMessage', 'Language deleted successfully.');
            window.location.reload();
        });


        window.addEventListener('category-statusupdate', event => {
            sessionStorage.setItem('successMessage', 'Customer status updated successfully!');
            window.location.reload();
        });

        window.addEventListener('country-statusupdate', event => {
            sessionStorage.setItem('successMessage', 'Country status updated successfully!');
            window.location.reload();
        });
        window.addEventListener('city-statusupdate', event => {
            sessionStorage.setItem('successMessage', 'City status updated successfully!');
            window.location.reload();
        });
        window.addEventListener('language-statusupdate', event => {
            sessionStorage.setItem('successMessage', 'Language status updated successfully!');
            window.location.reload();
        });
    </script>



</div>