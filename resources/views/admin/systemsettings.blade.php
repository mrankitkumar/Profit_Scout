@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/setting.css') }}" />
@section('content')

<div class="container-fluid">
    <form id="syatemsetting-form" method="POST" action="{{ route('admin.systemsettingspost') }}" enctype="multipart/form-data">
        @csrf
        <div class="row ">
            <div class="heading p-2 settingpart">
                <h3>System Settings</h3>
            </div>

            <div class="card col-md-3 ml-2 ">
                <div class="text-center" id="dropZone">
                <img class="img-fluid img-rectangle" id="settingicon" 
     src="{{ $setting && $setting->logo ? url($setting->logo) : url('/img/admin/settingImageIcon.svg') }}" 
     alt="Setting Icon">

                    <i class="fas fa-camera camera-icon" id="cameraIcon"></i>
                    <img class="profile-user-img img-fluid d-none img-rectangle" src="https://bit.ly/dan-abramov" alt="User profile picture" id="uploadPreview"  />
                    <input type="file" id="fileInput" accept="image/*" style="display: none"  name="logo"/>
                </div>
                <p class="profile-username1 text-center">Upload Logo</p>
                <span id="logo_error" class="form-text text-danger ml-5 mb-3"></span>
            </div>
            <div class="card col-md-3 ml-2">
                <div class="text-center" id="dropZone1">
                    <img class="img-fluid img-rectangle" id="settingicon1" src="{{$setting && $setting->favicon ? url($setting->favicon) :  url('/img/admin/settingImageIcon.svg') }}" alt="">
                    <i class="fas fa-camera camera-icon" id="cameraIcon"></i>
                    <img class="profile-user-img img-fluid d-none img-rectangle" src="https://bit.ly/dan-abramov" alt="User profile picture" id="uploadPreview1" />
                    <input type="file" id="fileInput1" accept="image/*" style="display: none" name="favicon"/>
                </div>
                <p class="profile-username1 text-center">Upload Favicon</p>
                <span id="favicon_error" class="form-text text-danger ml-5 mb-3"></span>
            </div>

            <div class="row row1">
                <div class="col-md-3">
                    <button type="button" class="btn btn-block savebutton btn-sm" id="saveButton">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function () {
    // Open file selector on click
    const dropZone = document.getElementById("dropZone");
    const dropZone1 = document.getElementById("dropZone1");
    const fileInput = document.getElementById("fileInput");
    const fileInput1 = document.getElementById("fileInput1");
    const uploadPreview = document.getElementById("uploadPreview");
    const uploadPreview1 = document.getElementById("uploadPreview1");
    const cameraIcon = document.getElementById("cameraIcon");
    const settingicon = document.getElementById("settingicon");
    const settingicon1 = document.getElementById("settingicon1");

    dropZone.addEventListener("click", () => fileInput.click());
    dropZone1.addEventListener("click", () => fileInput1.click());

    // Handle file selection
    fileInput.addEventListener("change", (event) => {
        const files = event.target.files;
        handleFiles(files);
    });
    fileInput1.addEventListener("change", (event) => {
        const files = event.target.files;
        handleFilesFavicon(files);
    });

    // Process files for logo
    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    uploadPreview.src = e.target.result;
                    uploadPreview.classList.remove("d-none");
                    cameraIcon.style.display = "block"; // Hide the camera icon
                    settingicon.style.setProperty('display', 'none', 'important');
                };
                reader.readAsDataURL(file);
            }
        }
    }

    // Process files for favicon
    function handleFilesFavicon(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    uploadPreview1.src = e.target.result;
                    uploadPreview1.classList.remove("d-none");
                    cameraIcon.style.display = "block"; // Hide the camera icon
                    settingicon1.style.setProperty('display', 'none', 'important');
                };
                reader.readAsDataURL(file);
            }
        }
    }

    // AJAX form submission
    $('#saveButton').on('click', function () {
        var formData = new FormData($('#syatemsetting-form')[0]); // Collect form data
        $.ajax({
            url: "{{ route('admin.systemsettingspost') }}", // Your route for form submission
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    sessionStorage.setItem('successMessage', response.message);
                    window.location.reload();  
                }
            },
            error: function (xhr) {
                // Handle validation errors
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors['logo']) {
                        $('#logo_error').text(errors['logo'][0]);
                    }
                    if (errors['favicon']) {
                        $('#favicon_error').text(errors['favicon'][0]);
                    }
                }
            }
        });
    });
});

</script>

@endsection