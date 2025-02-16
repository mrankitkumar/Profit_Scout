@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/viewcustomer.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="card viewcompanypart">
            <div class="card-header p-2">
                <h3>Edit Package <span></span></h3>
            </div>
            <div class="card-body">
                <form id="editpackage-form" method="POST" action="{{ route('editpackagepost') }}">
                    @csrf
                    <input type="hidden" value="{{$subscription->id}}" name="subscriptionid">

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Subscriptions Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter ..."
                                    value="{{$subscription->subscription_name}}"
                                    id="SubscriptionsName"
                                    name="subscription_name" />
                                <span id="subscription_name_error" class="form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Subscription Type</label>
                                <select id="SubscriptionsType" class="form-select smallwidth" name="subscription_type">
                                    <option value="">Select Subscription Type</option>
                                    <option value="Annual" {{ $subscription->subscription_type == 'Annual' ? 'selected' : '' }}>Annual</option>
                                    <option value="Monthly" {{ $subscription->subscription_type == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="Days" {{ $subscription->subscription_type == 'Days' ? 'selected' : '' }}>Days</option>
                                </select>
                                <span id="subscription_type_error" class="form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Amount (€)</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter ..."
                                    id="Amount"
                                    value="{{$subscription->price}}"
                                    step="0.01"
                                    min="0"
                                    name="price" />
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
                                    placeholder="Enter ..."
                                    id="IntervalPeriod"
                                    min="1"
                                    value="{{$subscription->interval_period}}"
                                    name="interval_period" />
                                <span id="interval_period_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Features</label>
                                <textarea class="form-control" id="Features" name="features">{{ $subscription->feature }}</textarea>
                                <span id="features_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="Description" name="description">{{ $subscription->description }}</textarea>
                                <span id="description_error" class="form-text text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <button type="submit" class="btn submit btn-sm">Save</button>
                        </div>
                        <div class="col-md-3">
                        <a href="{{url('/admin/managesubscriptions')}}">
                                <button
                                    type="button"
                                    class="btn  back btn-sm ">
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Clear errors when input fields are updated
        $('#SubscriptionsName, #SubscriptionsType, #Amount, #IntervalPeriod, #Features, #Description').on('input', function() {
            $('#' + this.name + '_error').text('');
        });

      
        $('#editpackage-form').on('submit', function(e) {
            e.preventDefault();

  
            $('.form-text.text-danger').text('');

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
                       
                        window.location.href = "{{ url('/admin/managesubscriptions') }}";
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            Object.keys(errors).forEach(function(key) {
                                console.log(key);
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