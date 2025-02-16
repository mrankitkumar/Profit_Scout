@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/addcustomer.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')

<div class="container-fluid">
    <form id="addpackage-form" method="POST" action="{{ route('addpackagepost') }}">
        @csrf
        <div class="row">
            <div class="card addcustomerpart">
                <div class="card-header p-2">
                    <h3>Add New Package</h3>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Subscriptions Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter "
                                    name="subscription_name"
                                />
                                <span id="subscription_name_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Subscriptions Type</label>
                                <select
                                    class="form-select smallwidth"
                                    aria-label="Subscriptions Type"
                                    name="subscription_type"
                                >
                                    <option>Subscriptions Type</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Days">Days</option>
                                </select>
                                <span id="subscription_type_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Amount(€)</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Enter "
                                    step="0.0001"
                                    min="0"
                                    name="price"
                                />
                                <span id="price_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Interval Period</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Enter "
                                    name="interval_period"
                                    min="1"
                                />
                                <span id="interval_period_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Features</label>
                                <textarea
                                    class="form-control"
                                    placeholder="Enter "
                                    name="feature"
                                ></textarea>
                                <span id="feature_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea
                                    class="form-control"
                                    placeholder="Enter "
                                    name="description"
                                ></textarea>
                                <span id="description_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button
                                type="submit"
                                class="btn submit btn-sm"
                            >
                                Submit
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{url('/admin/managesubscriptions')}}">
                                <button
                                    type="button"
                                    class="btn back btn-sm">
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function() {
    // Clear errors when input fields are updated
    $('#subscription_name, #subscription_type, #price, #interval_period, #feature, #description').on('input', function() {
        $('#' + this.name + '_error').text('');
        $('#general1_error').text('');
    });

    // Handle form submission
    $('#addpackage-form').on('submit', function(e) {
        e.preventDefault();
        
        // Clear any previous errors
        $('#general1_error').text('');
        $('#subscription_name_error').text('');
        $('#subscription_type_error').text('');
        $('#price_error').text('');
        $('#interval_period_error').text('');
        $('#feature_error').text('');
        $('#description_error').text('');

        const form = $(this);
        const formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    
                    sessionStorage.setItem('successMessage', response.message);
                    window.location.reload();  
                }
            },
            error: function(xhr) {
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        // Loop through errors and display each one
                        Object.keys(errors).forEach(function(key) {
                            $('#' + key + '_error').text(errors[key][0]);
                        });
                    }
                }
            }
        });
    });
});

</script>

@endsection