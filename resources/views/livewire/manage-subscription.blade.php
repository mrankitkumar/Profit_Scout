<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="border managesubscription bg-white">
        <div
            class="d-block d-md-flex d-lg-flex d-xl-flex justify-content-between align-items-center p-2 bg-white buttongroup">
            <h3>Subscription Packages</h3>

            <!-- Add Customer Button -->
            <button class="addsubscriptionbtn" id="addsubscription">
                <a href="{{ url('/admin/addpackage')}}" class="anchor">
                    <img
                        src="{{ url('img/admin/add_circle.svg')}}"
                        alt="Add"
                        class="imgadd" />
                    Add New Package
                </a>
            </button>

            <!-- Search for Customers -->
            <div class="input-group col-lg-3 col-md-3 col-6 mt-1 ml-md-1 border rounded-3" id="searchsubscription">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input
                    type="text"
                    wire:model="keyword"
                    class="form-control border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search"
                    wire:input="searchSubscription(1)" />
            </div>
        </div>
        <!-- <div> 1 -->
        <div id="customerTable" class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subscription Name</th>
                        <th>Duration</th>
                        <th>Price(€)</th>
                        <th>Interval Period</th>
                        <th>Features</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($subscription as $val)
                    <!-- Sample data rows -->
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->subscription_name}}</td>
                        <td>{{$val->subscription_type}}</td>
                        <td>{{$val->price}}</td>
                        <td>{{$val->interval_period}}</td>
                        <td>
                            <img src="{{ url('img/admin/view.svg')}}" alt="View" type="button"
                                data-toggle="modal"
                                data-target="#viewSubscriptionModal"
                                data-feature="{{$val->feature}}"
                                class="feature" />

                        </td>

                        <td>
                            <img src="{{ url('img/admin/view.svg')}}" alt="View" type="button"
                                data-toggle="modal"
                                data-target="#viewDescriptionModal"
                                data-description="{{$val->description}}"
                                class="description" />
                        </td>


                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput"
                                    type="checkbox"
                                    {{ $val->isActive ? 'checked' : '' }}
                                    wire:click="updateStatuspackage({{ $val->id }})" />
                            </div>
                        </td>
                        <td class="action-icons" style="word-spacing: 6px">
                            <a href="{{ route('admin.editpackage', ['id' => $val->id]) }}">
                                <img
                                    src="{{ url('img/admin/edit.svg')}}"
                                    alt="Edit"
                                    title="Edit"
                                    data-id="customer Id" /></a>
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deletesubscribeModal"
                                data-id="{{$val->id}}"
                                class="delete-package" />
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="9" class="text-center">

                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-3 p-2">
                <div class="entries-info">

                </div>
                <nav aria-label="Page navigation" style="display: flex">
                    <ul class="pagination justify-content-center mb-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $subscriptionPage == 1 ? 'disabled' : '' }}">
                            <a class="page-link pagination" href="#" wire:click="changePage(-1)" tabindex="-1">Previous</a>
                        </li>

                        <!-- Page Number Buttons -->
                        @for ($i = 1; $i <= $subscriptionCount; $i++)
                            <li class="page-item ">
                            <a class="page-link {{ $subscriptionPage == $i ? 'active' : '' }} pagination" href="#" wire:click="searchSubscription({{ $i }})">{{ $i }}</a>
                            </li>
                            @endfor

                            <!-- Next Button -->
                            <li class="page-item {{ $subscriptionPage == $subscriptionCount ? 'disabled' : '' }}">
                                <a class="page-link pagination" href="#" wire:click="changePage(1)">Next</a>
                            </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>


    <!-- Delete Customer Modal -->
    <div
        class="modal fade"
        id="deletesubscribeModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Set width and height for desktop -->
                <div
                    class="d-flex justify-content-center align-items-center"
                    class="yesandno">
                    <img src="{{url('img/admin/error.svg')}}" alt="">
                </div>
                <div class="modal-header">
                    <h5 class="text-center managetextheading">
                        Are you sure you want to delete this package? <br />
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
                        id="confirmDeletepackage">
                        Yes, Sure
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Trigger modal when delete button is clicked
            $('.delete-package').on('click', function() {
                const catId = $(this).data('id');


                $('#confirmDeletepackage').attr('wire:click', `deletepackage(${catId})`);


                $('#deletesubscribeModal').modal('show');
            });
        });


        window.addEventListener('package-deleted', event => {
            sessionStorage.setItem('successMessage', 'Package deleted successfully.');
            window.location.reload();
        });
        window.addEventListener('package-statusupdate', event => {
            sessionStorage.setItem('successMessage', 'Package updated successfully.');
            window.location.reload();
        });
    </script>


    <!-- viewDescriptionModal -->

    <!-- view modal  -->
    <div class="modal fade" id="viewSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content deletesubscription">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Subscription Features</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="featureList" class="list-group">
                        <!-- List items will be dynamically inserted here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Trigger modal when feature is clicked
            $('.feature').on('click', function() {
                const featureText = $(this).data('feature');
                const featureList = featureText.split("\n");


                $('#featureList').empty();


                featureList.forEach(function(feature) {
                    $('#featureList').append(`<li class="list-group-item">${feature}</li>`);
                });

                // Show the modal
                $('#viewSubscriptionModal').modal('show');
            });
        });
    </script>

    <div class="modal fade" id="viewDescriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content deletesubscription">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="descriptionText" class="text-center managetextheading">
                        <!-- Dynamic description will appear here -->
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Trigger modal when description item is clicked
            $('.description').on('click', function() {
                const description = $(this).data('description'); // Get the description from data-attribute

                // Set the description text in the modal
                $('#descriptionText').text(description);

                // Show the modal
                $('#viewDescriptionModal').modal('show');
            });
        });
    </script>




</div>