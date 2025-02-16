<div>


    <!-- //<?php
            //   dd($subscriptionActiveHistory);
            //
            ?> -->

    <div class="container-fluid">
        <div class="my-product-head">
            <h1>My Product Lists</h1>
        </div>

        <div class="product-container">

            @foreach($subscriptionActiveHistory as $pack)
            <div class="product-card">
                <div class="prd-card">
                    <div class="col-6">
                        <h2>{{ $pack->subscription_name }}</h2>
                    </div>
                    <div class="col-6 text-end">
                        @if($pack->price)
                        <p class="price"><strong>€{{ $pack->price }}</strong><span>/{{ $pack->subscription_type }}</span></p>
                        @endif
                    </div>
                </div>

                <h6>Features</h6>

                <ul class="features">

                    @php
                    $features = explode("\n", $pack->feature); // Split features into an array
                    $maxFeatures = 3; // Show only the first 3 features initially
                    @endphp

                    @foreach($features as $key => $feature)
                    @if($key < $maxFeatures)
                        <li>{{ $feature }}</li>
                        @else
                        <li class="more-features d-none">{{ $feature }}</li> <!-- Initially hidden features -->
                        @endif
                        @endforeach
                </ul>

                @if(count($features) > $maxFeatures)
                <a href="{{ route('package.details', ['id' => $pack->id]) }}" class="read-more">Read More</a>
                @endif

                <!-- For Description -->
                <p>{{ Str::limit($pack->description, 200) }}</p>

                <!-- "Read More" for description if it's longer than 100 characters -->
                @if(strlen($pack->description) > 200)
                <a href="{{ route('package.details', ['id' => $pack->id]) }}" class="read-more">Read More</a>
                @endif


                @if($pack->price)
                <a href="#" class="btnn payment" data-bs-toggle="modal" data-bs-target="#paymentModal"
                    data-packageid="{{ $pack->id }}"
                    data-price="{{ $pack->price }}">
                    Renew
                </a>
                @else
                <a href="#" class="btnn zeropayment"
                    data-packageid="{{ $pack->id }}"
                    data-price="{{ $pack->price }}">
                    Renew
                </a>


                @endif



                <div class="row valid-date">
                    <div class="col-6 text-nowrap">
                        Last purchased on {{ $pack->start_date }}
                    </div>
                    <div class="col-6 text-end">Valid till {{ $pack->end_date }}</div>
                </div>
            </div>
            @endforeach




            @foreach($package as $pack)
            <div class="product-card">
                <div class="prd-card">
                    <div class="col-6">
                        <h2>{{ $pack->subscription_name }}</h2>
                    </div>
                    <div class="col-6 text-end">
                        @if($pack->price)
                        <p class="price"><strong>€{{ $pack->price }}</strong><span>/{{ $pack->subscription_type }}</span></p>
                        @endif
                    </div>
                </div>

                <h6>Features</h6>
                <ul class="features">
                    @php
                    $features = explode("\n", $pack->feature);
                    $maxFeatures = 3;
                    @endphp

                    @foreach($features as $key => $feature)
                    @if($key < $maxFeatures)
                        <li>{{ $feature }}</li>
                        @else
                        <li class="more-features d-none">{{ $feature }}</li>
                        @endif
                        @endforeach
                </ul>


                <p>{{ Str::limit($pack->description, 200) }}</p>

                @if(strlen($pack->description) > 200)
                <a href="{{ route('package.details', ['id' => $pack->id]) }}" class="read-more">Read More</a>
                @endif


                @if($pack->price)
                <a href="#" class="btnn payment" data-bs-toggle="modal" data-bs-target="#paymentModal"
                    data-packageid="{{ $pack->id }}"
                    data-price="{{ $pack->price }}">
                    Purchase
                </a>

                @else
                <a href="#" class="btnn zeropayment"
                    data-packageid="{{ $pack->id }}"
                    data-price="{{ $pack->price }}">
                    It's FREE! Try it!
                </a>


                @endif



                <div class="row valid-date bnone">
                    <div class="col-6 text-nowrap">
                        Last purchased on 22-05-2024
                    </div>
                    <div class="col-6 text-end">Valid till 22-05-2025</div>
                </div>
            </div>
            @endforeach







        </div>

        <div class="subscription-history">


            <div class="pt-3 mb-2 ml-2">
                <h1>Subscription History</h1>
            </div>

            <table class="">
                <thead class="t-head">
                    <tr>
                        <th>ID</th>
                        <th>Subscription Name</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Subscription Status</th>
                        <th>Payment Date</th>
                        <th>Amount(€)</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($subscriptionHistory as $history)
                    <tr>
                        <td>#{{ $history->user_subscription_histories_id }}</td>
                        <td>{{ $history->subscription_name }}</td>
                        <td>{{ $history->subscription_type }}</td>
                        <td>{{ \Carbon\Carbon::parse($history->start_date)->format('d-m-Y') }}</td>

                        @if($history->end_date)
                        <td>{{ \Carbon\Carbon::parse($history->end_date)->format('d-m-Y') }}</td>
                        @else
                        <td>-</td>
                        @endif
                        <td><span class="status-s {{ $history->subscription_status }}">{{ $history->subscription_status }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($history->payment_date)->format('d-m-Y; H:i') }}</td>

                        @if($history->ammount)
                        <td>{{ $history->ammount}}</td>
                        @else
                        <td>Free</td>
                        @endif
                        @if($history->end_date)
                        <td>{{ $history->payment_method }}</td>
                        @else
                        <td>-</td>
                        @endif

                        <td><span class="status-s {{ $history->payment_status}}">{{ $history->payment_status }}</span></td>
                        <td><a href="#" class="invoice-link"><img src="{{ url('/img/user/pdfsub.svg') }}" alt="Invoice" /></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                <!-- Previous Page Button -->
                @if ($subscriptionHistoryPage > 1)
                <button wire:click="goToPage({{ $subscriptionHistoryPage - 1 }})" class="pagination-btns">
                    <img src="{{ url('/img/user/arowsub.svg') }}" alt="leftarrow" />
                </button>
                @else
                <button disabled class="pagination-btns">
                    <img src="{{ url('/img/user/arowsub.svg') }}" alt="leftarrow" />
                </button>
                @endif

                <!-- Pagination Numbers -->
                @for ($i = 1; $i <= $subscriptionHistoryCount; $i++)
                    <button
                    wire:click="goToPage({{ $i }})"
                    class="pagination-btn {{ $i == $subscriptionHistoryPage ? 'active' : '' }}">
                    {{ $i }}
                    </button>
                    @endfor

                    <!-- Next Page Button -->
                    @if ($subscriptionHistoryPage < $subscriptionHistoryCount)
                        <button wire:click="goToPage({{ $subscriptionHistoryPage + 1 }})" class="pagination-btn">
                        <img src="{{ url('/img/user/arowsub.svg') }}" alt="rightarrow" />
                        </button>
                        @else
                        <button disabled class="pagination-btn">
                            <img src="{{ url('/img/user/arowsub.svg') }}" alt="rightarrow" />
                        </button>
                        @endif
            </div>


        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Trigger modal when description item is clicked
                $('.zeropayment').on('click', function() {
                    const packageid = $(this).data('packageid');
                    const price = 0;

                    // Add CSRF token to the AJAX request
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');

                    const formData = {
                        packageid: packageid,
                        price: price
                    };

                    // AJAX call
                    $.ajax({
                        url: '/user/basicsubscription',
                        method: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if (response.success) {
                                sessionStorage.setItem('successMessage', response.message);
                                window.location.reload();
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                sessionStorage.setItem('errorMessage', xhr.responseJSON.message);
                                window.location.reload();



                            } else {
                                sessionStorage.setItem('errorMessage', 'Something went wrong. Please try again.');
                                window.location.reload();
                            }
                        },
                        beforeSend: function() {

                            $('.form-text.text-danger').text('');
                        }
                    });
                });
            });
        </script>


        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="paymentForm">
                            <div class="form-check pay-mod">
                                <input class="form-check-input circal-mod" type="radio" name="paymentMethod" id="creditCard" value="creditCard" checked />
                                <label class="form-check-label" for="creditCard">Debit/Credit Card</label>
                            </div>
                            <div class="form-check pay-mod">
                                <input class="form-check-input circal-mod" type="radio" name="paymentMethod" id="paypal" value="paypal" />
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                            <div class="form-check pay-mod">
                                <input class="form-check-input circal-mod" type="radio" name="paymentMethod" id="applePay" value="applePay" />
                                <label class="form-check-label" for="applePay">Apple Pay</label>
                            </div>
                            <div class="form-check pay-mod">
                                <input class="form-check-input circal-mod" type="radio" name="paymentMethod" id="googleWallet" value="googleWallet" />
                                <label class="form-check-label" for="googleWallet">Google Wallet</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3" id="paymentBtn">
                                Proceed to Pay €<span id="priceDisplay"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Trigger modal when "Purchase" button is clicked
                $('.payment').on('click', function() {
                    const packageid = $(this).data('packageid');
                    const price = $(this).data('price');

                    // Display price in modal
                    $('#priceDisplay').text(price);

                    // Store the packageid and price in hidden fields or wherever needed
                    $('#paymentForm').data('packageid', packageid);
                    $('#paymentForm').data('price', price);
                });

                // Handle payment form submission
                $('#paymentForm').on('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    const packageid = $(this).data('packageid');
                    const price = $(this).data('price');
                    const paymentMethod = $('input[name="paymentMethod"]:checked').val();
                    const paymentBtn = $('#paymentBtn');

                    // Disable the button and show loading text
                    paymentBtn.prop('disabled', true).text('Processing...');

                    // Make AJAX request to create the checkout session
                    $.ajax({
                        url: '/create-checkout-session',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            packageid: packageid,
                            price: price,
                            paymentMethod: paymentMethod
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.url) {
                                // Redirect to the Stripe Checkout page
                                window.location.href = response.url;
                            } else {
                                sessionStorage.setItem('errorMessage', 'Something went wrong. Please try again.');

                                paymentBtn.prop('disabled', false).html('Proceed to Pay €<span id="priceDisplay">' + price + '</span>');

                                //window.location.reload();
                            }
                        },
                        error: function() {
                            sessionStorage.setItem('errorMessage', 'Something went wrong. Please try again.');
                            paymentBtn.prop('disabled', false).html('Proceed to Pay €<span id="priceDisplay">' + price + '</span>');

                           // window.location.reload();
                        }
                    });
                });
            });
        </script>
    </div>
</div>