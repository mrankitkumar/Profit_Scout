<div>
    {{-- Do your work, then step back. --}}
    <div class="border  managepage bg-white ">
        <div
            class="d-block d-md-flex d-lg-flex d-xl-flex justify-content-between align-items-center p-2 bg-white buttongroup">
            <!-- Buttons for switching between Customers and Company -->
            <div id="buttonGroup" class="d-md-flex">
                <button
                    id="showPagesBtn"
                    class="btn addPage btn2 rounded-3  {{ $ispagesTab ? 'active' : '' }}"
                    wire:click="switchTab('pages')">
                    Pages
                </button>
                <button
                    id="showFaqBtn"
                    class="btn ml-1 addFaq btn2 rounded-3  {{ $isfaqTab ? 'active' : '' }}"
                    wire:click="switchTab('faq')">
                    FAQs
                </button>
            </div>
            @if($isfaqTab)
            <button class="addfaqbtn mt-1 " data-toggle="modal" data-target="#addfaqModal" id="addfaqbtn">
                <img
                    src="{{ url('img/admin/add_circle.svg')}}"
                    alt="Add"
                    class="imgadd" />
                Add New Question
            </button>
            @endif


            @if($isfaqTab)
            <!-- Search for Faq -->
            <div class="input-group col-lg-3 col-md-3 col-12 mt-1 ml-md-1 border  rounded-3" id="searchFaq">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>

                <input
                    type="text"
                    class="form-control rounded-3 border-0 ps-2"
                    placeholder="Search"
                    aria-label="Search"
                    wire:model="keyword"
                    wire:input="search(1)" />
            </div>
            @endif

        </div>
        @if($ispagesTab)
        <!-- <div> 1 -->
        <div id="PageTable"
            class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Page ID</th>
                        <th>Page Title</th>
                        <th>Last updated on</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data rows -->

                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->updated_at }}</td>
                        <td>

                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput "
                                    type="checkbox"
                                    {{ $page->isActive ? 'checked' : '' }}
                                    data-id="{{ $page->id }}"
                                    wire:click="updateStatuspages({{ $page->id  }})" />
                            </div>
                        </td>
                        <td>
                            <div style="width:30px;position:relative;" class="form-check form-switch d-flex align-items-center justify-content-center flex-column flex-md-row">

                                <img
                                    src="{{ url('img/admin/edit.svg')}}"
                                    alt="Edit"
                                    title="Edit"
                                    wire:click="editpages({{ $page->id }})"

                                    class="edit-page  postion-absolute editIcon" />
                            </div>
                        </td>
                    </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
        @endif





        @if($isfaqTab)
        <!-- </div>2 -->
        <div
            id="faqTable"
            class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question Title</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data rows -->
                    @foreach($faq as $fa)
                    <tr>
                        <td>{{$fa->id}}</td>
                        <td>{{$fa->question}}</td>
                        <td>
                            <img src="{{ url('img/admin/view.svg')}}" alt="View" type="button"

                                data-toggle="modal"
                                data-target="#viewDescriptionModal"
                                data-answer="{{$fa->answer}}"
                                class="showans" />
                        </td>
                        <td>
                            <div
                                class="form-check form-switch d-flex align-items-center justify-content-center">
                                <input
                                    class="form-check-input custom-switch checkinput"
                                    type="checkbox"
                                    {{ $fa->isActive ? 'checked' : '' }}
                                    data-id="{{ $fa->id }}"
                                    wire:click="updateStatusfaq({{ $fa->id }})" />
                            </div>
                        </td>
                        <td class="action-icons">
                            <img src="{{ url('img/admin/edit.svg')}}" alt="Edit" title="Edit"
                                data-toggle="modal"
                                wire:click="editfaq({{ $fa->id }})"
                                class="edit-faq" />
                            <img
                                src="{{ url('img/admin/delete.svg')}}"
                                alt="Delete"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#deletefaqModal"
                                data-id="{{ $fa->id }}"
                                class="delete-faq" />
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mb-3 p-2">
                <div class="entries-info"></div>
                <nav aria-label="Page navigation" style="display: flex">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item" id="prevButton">
                            <a class="page-link pagination" href="#" wire:click="changePage(-1)" tabindex="-1">Previous</a>
                        </li>



                        @for ($i = 1; $i <= $Count; $i++)
                            <li class="page-item" id="page{{ $i }}">
                            <a class="page-link {{ $i == $Page ? 'active' : '' }} pagination" href="#"
                                wire:click="changePage({{ $i - $Page }})">{{ $i }}</a>
                            </li>
                            @endfor


                            <li class="page-item" id="nextButton">
                                <a class="page-link pagination" href="#" wire:click="changePage(1)">Next</a>
                            </li>
                    </ul>
                </nav>
            </div>
        </div>
        @endif


        <!-- Delete Customer Modal -->
        <div
            class="modal fade"
            id="deletefaqModal"
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
                        <h5 class="text-center pagetextheading">
                            Are you sure you want to delete this question? <br>
                            This action cannot be undone.
                        </h5>
                    </div>

                    <div class="d-flex align-item-center justify-content-center">
                        <button type="button " class="no" data-dismiss="modal">No</button>
                        <!-- Column line -->
                        <div class="line"></div>
                        <button
                            type="button"
                            class="yes "
                            id="confirmDeletefaq">
                            Yes, Sure
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Trigger modal when delete button is clicked
                $('.delete-faq').on('click', function() {
                    const catId = $(this).data('id');


                    $('#confirmDeletefaq').attr('wire:click', `deletefaq(${catId})`);


                    $('#deletefaqModal').modal('show');
                });
            });
        </script>
        <script>
            window.addEventListener('AdminFaq-deleted', event => {
                sessionStorage.setItem('successMessage', 'Faq deleted successfully.');
                window.location.reload();
            });
            window.addEventListener('Pages-statusupdate', event => {
                sessionStorage.setItem('successMessage', 'Pages status updated successfully!');
                window.location.reload();
            });
            window.addEventListener('AdminFaq-statusupdate', event => {
                sessionStorage.setItem('successMessage', 'FAQ status updated successfully!');
                window.location.reload();
            });
        </script>
    </div>