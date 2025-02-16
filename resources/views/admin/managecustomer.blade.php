@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/managecustomer.css') }}" />
@section('content')


<div class="container-fluid p-1 customerandcompany">

    @livewire('ManageCustomerCompany');

</div>
<!-- Delete Customer Modal -->
<div
    class="modal fade"
    id="deleteCustomerModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Icon or Image -->
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ url('img/admin/error.svg') }}" alt="error">
            </div>
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="text-center customertextheading">
                    Are you sure you want to delete this customer? <br>
                    This action cannot be undone.
                </h5>
            </div>
            <!-- Modal Footer -->
            <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="customerno" data-dismiss="modal">No</button>
                <div class="customerline"></div>
                <form id="deleteCustomerForm" method="POST">
                    @csrf
                    @method("GET")
                    <button type="submit" class="customeryes">
                        Yes, Sure
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Variable to hold the delete URL
        let deleteUrl = '';


        $('.deletecustomber').on('click', function() {
            const customerId = $(this).data('id');
            //alert(customerId);
            deleteUrl = "{{ route('item.delete', ':id') }}".replace(':id', customerId);

            // Dynamically set the form's action attribute
            $('#deleteCustomerForm').attr('action', deleteUrl);

            $('#deleteCustomerModal').modal('show');
        });

        // Handle Delete Form Submission
        $('#deleteCustomerForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: deleteUrl,
                type: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#deleteCustomerModal').modal('hide');

                    // Remove the customer from DOM
                    $('#customer-' + response.customerId).remove();


                    if (response.success) {
                        sessionStorage.setItem('successMessage', response.Message);
                        window.location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.Message) {
                        sessionStorage.setItem('errorMessage', xhr.responseJSON.Message);
                    } else {
                        sessionStorage.setItem('errorMessage', 'An unexpected error occurred.');
                    }

                    // Reload the page to show the error message
                    // window.location.reload();
                }
            });
        });
    });
</script>


<div
    class="modal fade"
    id="deleteCompanyModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Error Icon -->
            <div class="d-flex justify-content-center align-items-center yesandno">
                <img src="{{ url('img/admin/error.svg') }}" alt="error" />
            </div>

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="text-center companytextheading">
                    Are you sure you want to delete this Company? <br />
                    This action cannot be undone.
                </h5>
            </div>

            <!-- Modal Footer -->
            <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="btn btn-secondary companyno" data-dismiss="modal">No</button>
                <!-- Separator -->
                <div class="companyline mx-2"></div>
                <form id="deleteCompanyForm" method="POST">
                    @csrf
                    @method("get")
                    <button type="submit" class=" companyyes">Yes, Sure</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Variable to hold the delete URL
        let deleteUrl = '';

       
        $('.deletecomapny').on('click', function () {
            const companyId = $(this).data('id');

            
            deleteUrl = "{{ route('itemcompany.delete', ':id') }}".replace(':id', companyId);

           
            $('#deleteCompanyForm').attr('action', deleteUrl);

      
            $('#deleteCompanyModal').modal('show');
        });

        // Handle Delete Form Submission
        $('#deleteCompanyForm').on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                url: deleteUrl,
                type: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    $('#deleteCompanyModal').modal('hide');

                    if (response.success) {
                        // Remove the company element from the DOM
                        $('#company-' + response.companyId).remove();
                        sessionStorage.setItem('successMessage', response.Message);

                        // Reload the page to reflect changes
                        window.location.reload();
                    } else {
                        sessionStorage.setItem('errorMessage', response.Message || 'Error occurred.');
                        window.location.reload();
                    }
                },
                error: function (xhr) {
                    const errorMessage =
                        (xhr.responseJSON && xhr.responseJSON.Message) || 'An unexpected error occurred.';
                    sessionStorage.setItem('errorMessage', errorMessage);

                    // Optionally reload the page to show the error
                   // window.location.reload();
                },
            });
        });
    });
</script>






@endsection