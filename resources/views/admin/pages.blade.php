@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/Pages.css') }}" />
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')

<div class="container-fluid p-2">
  @livewire('AdminPages');
</div>

<div
  class="modal fade"
  id="viewDescriptionModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content deletesubscription">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Answer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center managetextheading" id="descriptionText"></p>
      </div>

    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Trigger modal when description item is clicked
    $('.showans').on('click', function() {
      const description = $(this).data('answer'); // Get the description from data-attribute

      // Set the description text in the modal as HTML
      $('#descriptionText').html(description);

      // Show the modal
      $('#viewDescriptionModal').modal('show');
    });
  });
</script>



<div class="modal fade" id="addfaqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content mcondialog">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addfaqForm" action="{{ route('faqadd') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="addquestionTitle">Question Title</label>
            <input type="text" class="form-control rounded-3" id="addquestionTitle" placeholder="Enter title">
          </div>
          <div class="form-group">
            <label for="Description">Answer</label>
            <div id="toolbar" class="d-flex flex-wrap mb-2 rounded-3">
              <button type="button" id="bold" class="m-1 ss toolbarbutton"><i class="fas fa-bold"></i></button>
              <button type="button" id="italic" class="m-1 ss toolbarbutton"><i class="fas fa-italic"></i></button>
              <button type="button" id="underline" class="m-1 ss toolbarbutton"><i class="fas fa-underline"></i></button>
              <button type="button" id="align-left" class="m-1 ss toolbarbutton"><i class="fas fa-align-left"></i></button>
              <button type="button" id="align-center" class="m-1 ss toolbarbutton"><i class="fas fa-align-center"></i></button>
              <button type="button" id="align-right" class="m-1 ss toolbarbutton"><i class="fas fa-align-right"></i></button>
              <button type="button" id="list-ul" class="m-1 ss toolbarbutton"><i class="fas fa-list-ul"></i></button>
              <button type="button" id="list-ol" class="m-1 ss toolbarbutton"><i class="fas fa-list-ol"></i></button>
              <button type="button" id="undo" class="m-1 ss toolbarbutton"><i class="fas fa-undo"></i></button>
              <button type="button" id="redo" class="m-1 ss toolbarbutton"><i class="fas fa-redo"></i></button>
            </div>
            <div id="editoraddquestion" class="editor-container rounded-3"></div>
          </div>
          <div class="form-group">
            <div class="status-container">
              <label>Status</label>
              <div class="form-check form-switch d-flex align-items-center justify-content-center">
                <input class="form-check-input custom-switch checkinput1" type="checkbox" id="addquestionactive" checked />
              </div>
            </div>
            <div class="toggleswitch position-absolute">
              <label for="status">
                Toggle this switch to activate or deactivate the page.
              </label>
            </div>
          </div>
          <button type="submit" class="texteditbutton">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const quillAddFaq = new Quill('#editoraddquestion', {
      theme: 'snow',
      modules: {
        toolbar: false
      }
    });

    function toggleFormat(format, value = true) {
      const range = quillAddFaq.getSelection();
      if (!range) {
        quillAddFaq.focus();
        quillAddFaq.setSelection(0, quillAddFaq.getLength());
      }
      quillAddFaq.format(format, value);
    }

    document.getElementById('bold').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('bold');
    });
    document.getElementById('italic').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('italic');
    });
    document.getElementById('underline').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('underline');
    });
    document.getElementById('align-left').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('align', 'left');
    });
    document.getElementById('align-center').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('align', 'center');
    });
    document.getElementById('align-right').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('align', 'right');
    });
    document.getElementById('list-ul').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('list', 'bullet');
    });
    document.getElementById('list-ol').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('list', 'ordered');
    });
    document.getElementById('undo').addEventListener('click', (e) => {
      e.preventDefault();
      quillAddFaq.history.undo();
    });
    document.getElementById('redo').addEventListener('click', (e) => {
      e.preventDefault();
      quillAddFaq.history.redo();
    });

    $('#addfaqForm').on('submit', function(e) {
      e.preventDefault();

      const pageTitle = $('#addquestionTitle').val();
      const pageContent = quillAddFaq.root.innerHTML;
      const isActive = $('#addquestionactive').is(':checked');
      // Optional alert for debugging
      // alert(pageTitle);

      $.ajax({
        url: $('#addfaqForm').attr('action'),
        type: 'POST',
        data: {
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          title: pageTitle,
          content: pageContent,
          isActive: isActive,
        },

        success: function(response) {
          if (response.success) {

            sessionStorage.setItem('successMessage', response.message);
            location.reload();
          } else {

            error_alert('An error occurred while updating the page. Please try again.');
          }
        },
        error: function(xhr) {
          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;
            let errorMessage = "";

            // Loop through errors and concatenate messages
            $.each(errors, function(key, messages) {
              errorMessage += messages[0] + "\n"; // Show the first error message for each field
            });

            error_alert(errorMessage); // Show error messages using error_alert()
          } else {
            error_alert('An error occurred while updating the page. Please try again.');
          }
        }
      });
    });
  });
</script>









<!-- Edit FAQ Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content mcondialog">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Question - <span id="edfaqId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editfaqForm">
          @csrf
          <div class="form-group">
            <label class="pageTitle">Question Title</label>
            <input type="text" class="form-control rounded-3" id="editfaqTitle" placeholder="Enter title" required>
          </div>
          <div class="form-group">
            <label class="pageTitle">Answer</label>
            <div id="toolbar" class="d-flex flex-wrap mb-2 rounded-3">
              <button type="button" id="bold-faq" class="m-1 ss toolbarbutton"><i class="fas fa-bold"></i></button>
              <button type="button" id="italic-faq" class="m-1 ss toolbarbutton"><i class="fas fa-italic"></i></button>
              <button type="button" id="underline-faq" class="m-1 ss toolbarbutton"><i class="fas fa-underline"></i></button>
              <button type="button" id="align-left-faq" class="m-1 ss toolbarbutton"><i class="fas fa-align-left"></i></button>
              <button type="button" id="align-center-faq" class="m-1 ss toolbarbutton"><i class="fas fa-align-center"></i></button>
              <button type="button" id="align-right-faq" class="m-1 ss toolbarbutton"><i class="fas fa-align-right"></i></button>
              <button type="button" id="list-ul-faq" class="m-1 ss toolbarbutton"><i class="fas fa-list-ul"></i></button>
              <button type="button" id="list-ol-faq" class="m-1 ss toolbarbutton"><i class="fas fa-list-ol"></i></button>
              <button type="button" id="undo-faq" class="m-1 ss toolbarbutton"><i class="fas fa-undo"></i></button>
              <button type="button" id="redo-faq" class="m-1 ss toolbarbutton"><i class="fas fa-redo"></i></button>
            </div>
            <div id="editor-faq_edit" class="editor-container rounded-3"></div>
          </div>
          <div class="form-group">
            <div class="status-container">
              <label>Status</label>
              <div class="form-check form-switch d-flex align-items-center justify-content-center">
                <input class="form-check-input custom-switch checkinput1" type="checkbox" id="editisActive">
              </div>
            </div>
            <div class="toggleswitch position-absolute">
              <label for="status">Toggle this switch to activate or deactivate the page.</label>
            </div>
          </div>
          <button type="submit" class="texteditbutton">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const quill2 = new Quill('#editor-faq_edit', {
      theme: 'snow',
      modules: {
        toolbar: false
      }
    });

    function toggleFormat(format) {
      let range = quill2.getSelection();

      if (!range) {
        range = {
          index: 0,
          length: quill2.getLength()
        };
        quill2.setSelection(range);
      }

      const currentFormat = quill2.getFormat(range);
      quill.format(format, !currentFormat[format]);
    }

    document.getElementById('bold-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('bold');
    });

    document.getElementById('italic-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('italic');
    });

    document.getElementById('underline-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('underline');
    });

    document.getElementById('align-left-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill2.format('align', 'left');
    });

    document.getElementById('align-center-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill2.format('align', 'center');
    });

    document.getElementById('align-right-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill2.format('align', 'right');
    });

    document.getElementById('list-ul-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill2.format('list', 'bullet');
    });

    document.getElementById('list-ol-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill2.format('list', 'ordered');
    });

    document.getElementById('undo-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill2.history.undo();
    });

    document.getElementById('redo-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill2.history.redo();
    });

    document.addEventListener('livewire:init', () => {
      Livewire.on('faql-edit', async (event) => {


        const data = event[0];

        // Destructure the event object
        const {
          id,
          question,
          answer,
          isActive
        } = data;



        $('#edfaqId').text(id);
        $('#editfaqTitle').val(question);
        quill2.root.innerHTML = answer || '';

        if (isActive) {
          $('#editisActive').prop('checked', true);
        } else {
          $('#editisActive').prop('checked', false);
        }

        $('#editModal').modal('show');

      });
    });



    $('#editfaqForm').on('submit', function(e) {
      e.preventDefault();
      const faqId = $('#edfaqId').text();
      const faqTitle = $('#editfaqTitle').val();
      const faqContent = quill2.root.innerHTML;
      const isActive = $('#editisActive').is(':checked');

      $.ajax({
        url: '/faq/update/' + faqId,
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          title: faqTitle,
          content: faqContent,
          isActive: isActive
        },
        success: function(response) {
          if (response.success) {

            sessionStorage.setItem('successMessage', response.message);
            location.reload();
          } else {

            error_alert('An error occurred while updating the page. Please try again.');
          }
        },
        error: function(xhr) {
          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;
            let errorMessage = "";

            // Loop through errors and concatenate messages
            $.each(errors, function(key, messages) {
              errorMessage += messages[0] + "\n"; // Show the first error message for each field
            });

            error_alert(errorMessage); // Show error messages using error_alert()
          } else {
            error_alert('An error occurred while updating the page. Please try again.');
          }
        }
      });
    });
  });
</script>











<div class="modal fade" id="editPageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content mcondialog">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editPageFormforpage">
          @csrf
          <div class="form-group">
            <label for="pageTitle">Page Title</label>
            <input type="text" class="form-control rounded-3" id="editpageTitle" placeholder="Enter title" name="title">
          </div>
          <div class="form-group">
            <label for="Description">Description</label>
            <div id="toolbar" class="d-flex flex-wrap mb-2 rounded-3">
              <button type="button" id="bold-page" class="m-1 ss  toolbarbutton"><i class="fas fa-bold"></i></button>
              <button type="button" id="italic-page" class=" m-1 ss toolbarbutton"><i class="fas fa-italic"></i></button>
              <button type="button" id="underline-page" class=" m-1 ss toolbarbutton"><i class="fas fa-underline"></i></button>
              <button type="button" id="align-left-page" class=" m-1 ss toolbarbutton"><i class="fas fa-align-left"></i></button>
              <button type="button" id="align-center-page" class=" m-1 ss toolbarbutton"><i class="fas fa-align-center"></i></button>
              <button type="button" id="align-right-page" class=" m-1 ss toolbarbutton"><i class="fas fa-align-right"></i></button>
              <button type="button" id="list-ul-page" class=" m-1 ss toolbarbutton"><i class="fas fa-list-ul"></i></button>
              <button type="button" id="list-ol-page" class=" m-1 ss toolbarbutton"><i class="fas fa-list-ol"></i></button>
              <button type="button" id="undo-page" class=" m-1 ss toolbarbutton"><i class="fas fa-undo"></i></button>
              <button type="button" id="redo-page" class=" m-1 ss toolbarbutton"><i class="fas fa-redo"></i></button>
            </div>
            <div id="editor-page" class="editor-container rounded-3"></div>
          </div>
          <div class="form-group">
            <div class="status-container">
              <label>Status</label>
              <div class="form-check form-switch d-flex align-item-center justify-content-center">
                <input class="form-check-input custom-switch checkinput1" type="checkbox" id="editisActivepage" />
              </div>
            </div>
            <div class="toggleswitch position-absolute">
              <label for="editisActivepage">Toggle this switch to activate or deactivate the page.</label>
            </div>
          </div>
          <button type="submit" class="texteditbutton">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const quill = new Quill('#editor-page', {
      theme: 'snow',
      modules: {
        toolbar: false
      }
    });

    function toggleFormat(format) {
      let range = quill.getSelection();

      if (!range) {
        range = {
          index: 0,
          length: quill.getLength()
        };
        quill.setSelection(range);
      }

      const currentFormat = quill.getFormat(range);
      const isFormatted = currentFormat[format];
      quill.format(format, !isFormatted);
    }

    document.getElementById('bold-page').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('bold');
    });

    document.getElementById('italic-page').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('italic');
    });

    document.getElementById('underline-page').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('underline');
    });

    document.getElementById('align-left-page').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('align', 'left');
    });

    document.getElementById('align-center-page').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('align', 'center');
    });

    document.getElementById('align-right-page').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('align', 'right');
    });

    document.getElementById('list-ul-page').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('list', 'bullet');
    });

    document.getElementById('list-ol-page').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('list', 'ordered');
    });

    document.getElementById('undo-page').addEventListener('click', (e) => {
      e.preventDefault();
      quill.history.undo();
    });

    document.getElementById('redo-page').addEventListener('click', (e) => {
      e.preventDefault();
      quill.history.redo();
    });

    document.addEventListener('livewire:init', () => {
      Livewire.on('pagel-edit', async (event) => {

        // Access the first element from the event (since it's an array)
        const data = event[0]; // Access the first object in the array

        // Destructure the event object
        const {
          id,
          title,
          content,
          isActive
        } = data;

        if (isActive) {
          $('#editisActivepage').prop('checked', true);
        } else {
          $('#editisActivepage').prop('checked', false);
        }

        $('#editPageModal').data('page-id', id);
        $('#editpageTitle').val(title);
        quill.root.innerHTML = content || '';

        $('#editPageModal').modal('show');

      });
    });





    $('#editPageFormforpage').on('submit', function(e) {
      e.preventDefault();
      const pageId = $('#editPageModal').data('page-id');
      const pageTitle = $('#editpageTitle').val();
      const pageContent = quill.root.innerHTML;
      const isActive = $('#editisActivepage').is(':checked');
      //alert(pageId);
      $.ajax({
        url: '/pages/update/' + pageId,
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          title: pageTitle,
          content: pageContent,
          isActive,
        },
        success: function(response) {
          if (response.Success) {
            sessionStorage.setItem('successMessage', response.Message);
            window.location.href = '/admin/pages';
          } else {
            error_alert('An error occurred while updating the page. Please try again.');
          }
        },
        error: function() {
          error_alert('An error occurred while updating the page. Please try again.');
        }
      });
    });



  });
</script>
















<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor without the default toolbar
    const quill = new Quill('#editor-faq', {
      theme: 'snow',
      modules: {
        toolbar: false // Disable default toolbar
      }
    });
    // Function to toggle formatting based on current selection
    function toggleFormat(format) {
      let range = quill.getSelection();

      // If there's no selection, select all text content
      if (!range) {
        range = {
          index: 0,
          length: quill.getLength()
        }; // Select all text
        quill.setSelection(range); // Set selection
      }

      const currentFormat = quill.getFormat(range); // Get current format
      const isFormatted = currentFormat[format]; // Check if format is applied
      quill.format(format, !isFormatted); // Toggle format based on current state
    }


    // Button click event listeners for toggling formatting
    document.getElementById('bold-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('bold');
    });
    document.getElementById('italic-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('italic');
    });
    document.getElementById('underline-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('underline');
    });
    document.getElementById('align-left-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('align', 'left'); // Set to specific alignment
    });
    document.getElementById('align-center-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('align', 'center'); // Set to specific alignment
    });
    document.getElementById('align-right-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill.format('align', 'right'); // Set to specific alignment
    });
    document.getElementById('list-ul-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('list', 'bullet');
    });
    document.getElementById('list-ol-faq').addEventListener('click', (e) => {
      e.preventDefault();
      toggleFormat('list', 'ordered');
    });

    // Undo and Redo functionality
    document.getElementById('undo-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill.history.undo();
    });

    document.getElementById('redo-faq').addEventListener('click', (e) => {
      e.preventDefault();
      quill.history.redo();
    });
  });
</script>




@endsection