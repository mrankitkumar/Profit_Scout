<div>
   
    {{-- In work, do what you enjoy. --}}
    <div class="card">
        <div class="card-header p-2">
            <h3>Subscription Details </h3>
        </div>
        <div class="card-body">
            <div
                class="container-fluid table-responsive">
                <!-- style="height: 83vh; overflow-y: auto" -->
                <table class=" container-fluid table">

                    <tbody>
                        <!-- Sample data rows -->
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

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3 p-2">
        <div class="entries-info"></div>
        <nav aria-label="Page navigation" style="display: flex">
            <ul class="pagination justify-content-center mb-0">
                <!-- Previous Page Button -->
                <li class="page-item" id="prevButton">
                    <a class="page-link pagination" href="#" wire:click="goToPage({{ $subscriptionHistoryPage - 1 }})" tabindex="-1" {{ $subscriptionHistoryPage > 1 ? '' : 'disabled' }}>Previous</a>
                </li>

                <!-- Pagination Numbers -->
                @for ($i = 1; $i <= $subscriptionHistoryCount; $i++)
                    <li class="page-item" id="page{{ $i }}">
                    <a class="page-link {{ $i == $subscriptionHistoryPage ? 'active' : '' }} pagination" href="#" wire:click="goToPage({{ $i }})">{{ $i }}</a>
                    </li>
                    @endfor

                    <!-- Next Page Button -->
                    <li class="page-item" id="nextButton">
                        <a class="page-link pagination" href="#" wire:click="goToPage({{ $subscriptionHistoryPage + 1 }})" {{ $subscriptionHistoryPage < $subscriptionHistoryCount ? '' : 'disabled' }}>Next</a>
                    </li>
            </ul>
        </nav>
    </div>



</div>