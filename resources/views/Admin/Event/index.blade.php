@extends('layouts.admin')
@section('title')
   Manage Events
@endsection
@section('content')

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar pt-lg-9 pt-6">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                    <div class="d-flex flex-stack flex-wrap gap-4 w-100">
                        <div class="page-title d-flex flex-column gap-3 me-3">
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                    <a href="../dist/index.html" class="text-gray-500">
                                        <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                </li>
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Manage Events</li>
                                <li class="breadcrumb-item">
                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-3 gap-lg-5">
                            <div class="m-0">
                                <a href="#" class="btn btn-flex btn-sm btn-color-gray-700 bg-body fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modal_create_event">

                                    <i class="ki-duotone ki-plus-square fs-2 p-0 m-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    New Events
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content pb-0 mb-5">
                    <div class="col-xl-12">
                        <div class="card card-flush h-md-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Events Records</span>
                                    <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                                </h3>
                            </div>
                            <div class="card-body pt-6">
                                <div class="table-responsive" id="all_record">
                                    {{-- Table appear here  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal For Create of Event--}}
    <div class="modal fade" id="modal_create_event" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="event_close_header_btn">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y pt-0 pb-15">
                    <div class="mb-13">
                        <h1 class="text-center mb-5">Create New Event</h1>
                        <form action="{{route('admin-event.store')}}" method="POST" id="CreateEvent"
                            enctype="multipart/form-data">

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Title
                                         <span class="label-span-danger">*</span></label>
                                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Title">
                                </div>
                                <span class="text-danger error-text title_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Date
                                         <span class="label-span-danger">*</span></label>
                                    <input type="date" name="date" class="form-control form-control-solid  event-date" placeholder="Date">
                                </div>
                                <span class="text-danger error-text date_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Start Time
                                         <span class="label-span-danger">*</span></label>
                                    <input type="Time" name="start_time" class="form-control form-control-solid timePicker" placeholder="Start Time">
                                </div>
                                <span class="text-danger error-text start_time_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event End Time
                                         <span class="label-span-danger">*</span></label>
                                    <input type="time" name="end_time" class="form-control form-control-solid timePicker" placeholder="End Time">
                                </div>
                                <span class="text-danger error-text end_time_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Description
                                         <span class="label-span-danger">*</span></label>
                                   <textarea class="form-control form-control-solid"  name="description"  cols="20" rows="5" placeholder="Type here ..."></textarea>
                                </div>
                                <span class="text-danger error-text description_error"></span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Venue
                                         <span class="label-span-danger">*</span></label>
                                    <input type="text" name="venue" class="form-control form-control-solid" placeholder="Venue">
                                </div>
                                <span class="text-danger error-text venue_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label for="subject_code" class="form-label">Monthly Highlight <span
                                            class="login-danger">*</span></label>
                                    <select class="form-select form-select-solid" id="" name="monthly_highlight">
                                        <option value="">Select </option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-danger error-text monthly_highlight_error"></span>
                                </div>

                            </div>

                            <div class="row g-3 mt-1">
                                <div class="fv-row mb-8">
                                    <div class="dropzone dz-clickable" id="eventDropzone">
                                        <div class="dz-message needsclick">
                                            <i class="ki-duotone ki-file-up fs-3hx text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="ms-4">
                                                <h3 class="dfs-3 fw-bold text-gray-900 mb-1">Drop picture here or click to upload.</h3>
                                                <span class="fw-semibold fs-4 text-muted">Upload Pictures Here</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger mt-1 error-text image_error"></span>
                                </div>
                            </div>
                            <div class="mt-4 float-end">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"  id="event_close_btn">Close</button>
                                <button type="submit" class="btn btn-sm" style="color:#3b5b50" id="event_btn_submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


   {{-- Modal For Viewing of event --}}
    <div class="modal fade" id="view_event_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                </div>
                <div class="modal-body scroll-y pt-0 pb-15">
                    <div class="mb-13">
                        <form action="" method="" id="" enctype="multipart/form-data">
                            <input type="text" name="events_id" id="events_id" readonly hidden>

                            <!-- Title -->
                            <div class="text-center mb-3">
                                <h1 class="modal-title" id="view_title" style="font-size: 24px; font-weight: bold;"></h1>
                            </div>

                            <!-- Venue -->
                            <div class="text-center mb-3">
                                <h2 id="view_venue" style="font-size: 20px;"></h2>
                            </div>

                            <!-- Time Range and Date -->
                            <div class="text-center mb-4">
                                <p id="view_time_range" style="font-size: 18px; margin-bottom: 5px;"></p>
                                <p id="view_date" style="font-size: 16px;"></p>
                            </div>

                            <!-- Image -->
                            <div class="text-center mb-5">
                                <div class="justify-content-center image-container" id="view_picture">
                                    <!-- Image will appear here -->
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="modal-description">
                                <h3 id="view_description" style="text-align: justify; text-indent: 25px; font-size: 16px;"></h3>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Modal for edit the event--}}
    <div class="modal fade" id="edit_event_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="edit_event_close_header_btn">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y pt-0 pb-15">
                    <div class="mb-13">
                        <h1 class="text-center mb-5">Edit Event</h1>
                        <form action="{{route('admin-event.update')}}" method="POST" id="UpdateEvent"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="text" name="edit_events_id" id="edit_events_id" hidden readonly>

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Title
                                         <span class="label-span-danger">*</span></label>
                                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Title" id="edit_title">
                                </div>
                                <span class="text-danger error-text title_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Date
                                         <span class="label-span-danger">*</span></label>
                                    <input type="date" name="date" class="form-control form-control-solid event-date" placeholder="Date" id="edit_date">
                                </div>
                                <span class="text-danger error-text date_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Start Time
                                         <span class="label-span-danger">*</span></label>
                                    <input type="Time" name="start_time" class="form-control form-control-solid timePicker" placeholder="Start Time" id="edit_start_time">
                                </div>
                                <span class="text-danger error-text start_time_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event End Time
                                         <span class="label-span-danger">*</span></label>
                                    <input type="time" name="end_time" class="form-control form-control-solid timePicker" placeholder="End Time" id="edit_end_time">
                                </div>
                                <span class="text-danger error-text end_time_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Description
                                         <span class="label-span-danger">*</span></label>
                                   <textarea class="form-control form-control-solid"  name="description"  cols="20" rows="5" placeholder="Type here ..." id="edit_description"></textarea>
                                </div>
                                <span class="text-danger error-text description_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Venue
                                         <span class="label-span-danger">*</span></label>
                                    <input type="text" name="venue" class="form-control form-control-solid" placeholder="Venue" id="edit_venue">
                                </div>
                                <span class="text-danger error-text venue_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label for="subject_code" class="form-label">Monthly Highlight <span
                                            class="login-danger">*</span></label>
                                    <select class="form-select form-select-solid" id="edit_monthly_highlight" name="monthly_highlight">
                                        <option value="">Select </option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-danger error-text monthly_highlight_error"></span>
                                </div>

                            </div>


                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Previous Image
                                        <span class="label-span-danger">*</span></label>
                                        <div class="justify-content-center image-container" id="previous_picture">
                                        {{-- Image Will Appear Hear--}}
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="fv-row mb-8">
                                    <div class="dropzone dz-clickable" id="UpdateEventDropzone">
                                        <div class="dz-message needsclick">
                                            <i class="ki-duotone ki-file-up fs-3hx text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="ms-4">
                                                <h3 class="dfs-3 fw-bold text-gray-900 mb-1">Upload here if you want to change the picture</h3>
                                                <span class="fw-semibold fs-4 text-muted">Upload Pictures Here</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger mt-1 error-text image_error"></span>
                                </div>
                            </div>
                            <div class="mt-4 float-end">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"  id="edit_event_close_btn">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary" id="edit_event_btn_submit">Update </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  



    @section('script')
        <script type="text/javascript">

              // Disable Dropzone's auto-discovery
            Dropzone.autoDiscover = false;

            $(document).ready(function() {

                AllEventRecord();

                //Get the record in the database
                function AllEventRecord() {
                    $.ajax({
                        url: '{{ route('admin-event.allrecord') }}',
                        method: 'GET',
                        success: function(response) {
                            $("#all_record").html(response);
                            $("#all_record_table").DataTable({
                                "order": [
                                    [0, "asc"]
                                ],
                            });
                        }
                    });
                }

                $(document).on('click', '.view_event', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('admin-event.view') }}',
                        method: 'GET',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Log raw response data for debugging
                            console.log('response data:', response);

                            // Function to format time in 'h:mm A' format (e.g., 8:00 PM)
                            function formatTime(timeString) {
                                try {
                                    // Split the time string into hours and minutes
                                    let [hours, minutes] = timeString.split(':');
                                    hours = parseInt(hours, 10);
                                    minutes = parseInt(minutes, 10);

                                    // Convert to 12-hour format
                                    let ampm = hours >= 12 ? 'PM' : 'AM';
                                    hours = hours % 12;
                                    hours = hours || 12; // the hour '0' should be '12'

                                    return `${hours}:${minutes.toString().padStart(2, '0')} ${ampm}`;
                                } catch (error) {
                                    console.error('Error formatting time:', timeString, error);
                                    return 'Invalid time';
                                }
                            }

                            // Format start and end times
                            const startTime = formatTime(response.start_time);
                            const endTime = formatTime(response.end_time);
                            const timeRange = `${startTime} to ${endTime}`;

                            // Format date
                            let date = new Date(response.date);
                            let dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
                            let formattedDate = date.toLocaleDateString('en-US', dateOptions);

                            // Set values in the modal
                            $("#events_id").val(response.id);
                            $("#view_title").html(`${response.title}`);
                            $("#view_time_range").html(timeRange); // Display the time range on a single line
                            $("#view_date").html(formattedDate);
                            $("#view_venue").html(`${response.venue}`);
                            $("#view_description").html(`${response.description}`);
                            $("#view_picture").html(
                                `<img src="storage/event/images/${response.picture}" class="modal_image" alt="Event Image">`
                            );
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                });

                // Clear the data of view modal when hidden
                $('#view_event_modal').on('hide.bs.modal', function () {
                    $("#events_id").val('');
                    $("#view_title").html('');
                    $("#view_time_range").html(''); // Clear the time range
                    $("#view_date").html('');
                    $("#view_venue").html('');
                    $("#view_description").html('');
                    $("#view_picture").html('');
                });



                // // Initialize Dropzone and insert the event in the database
                var myDropzone = new Dropzone("#eventDropzone", {
                    url: $("#CreateEvent").attr('action'), // URL for form submission
                    method: 'POST',
                    paramName: 'file', // The name of the file upload parameter
                // maxFilesize: 5, // MB
                    acceptedFiles: 'image/*', // Only accept images
                    addRemoveLinks: true,
                    maxFiles: 1, // Limit to 1 file
                    autoProcessQueue: true, // Disable auto-processing
                    init: function() {
                        var dz = this;

                        // Handle form submission
                        $("#CreateEvent").on('submit', function(e) {
                            e.preventDefault();
                            $("#event_btn_submit").html('Submitting <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                            $('#event_btn_submit').attr("disabled", true);
                            var form = this;

                            // Collect form data
                            var formData = new FormData(form);

                            // Add Dropzone file to form data (if any)
                            if (dz.getAcceptedFiles().length > 0) {
                                formData.append('file', dz.getAcceptedFiles()[0]);
                            }

                            $.ajax({
                                url: $(form).attr('action'),
                                method: $(form).attr('method'),
                                data: formData,
                                processData: false,
                                dataType: "json",
                                contentType: false,
                                beforeSend: function() {
                                    $(form).find('span.error-text').text('');
                                },
                                success: function(response) {
                                    if (response.status == 0) {
                                        $('#event_btn_submit').removeAttr("disabled");

                                        $.each(response.error, function(prefix, val) {
                                            $(form).find('span.' + prefix + '_error').text(val[0]);
                                        });

                                        if (dz.getAcceptedFiles().length === 0) {
                                            $(form).find('span.image_error').text('An image is required.');
                                        } else if (dz.getAcceptedFiles().length > 1) {
                                            $(form).find('span.image_error').text('1 image is allowed to upload.');
                                        }
                                        $("#event_btn_submit").text('Submit');
                                    } else {
                                        $(form)[0].reset();
                                        dz.removeAllFiles(); // Clear Dropzone files
                                        $('#event_btn_submit').removeAttr("disabled");
                                        $('#event_btn_submit').text('Submit');
                                        AllEventRecord();
                                        $("#modal_create_event").modal('hide');
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Event Created Successfully!',
                                            showConfirmButton: true,
                                        });
                                    }

                                    $('#event_close_btn').on('click', function() {
                                        $("#CreateEvent").find('span.text-danger').text('');
                                    });

                                    $('#event_close_header_btn').on('click', function() {
                                        $("#CreateEvent").find('span.text-danger').text('');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Handle any error that occurred during the request
                                    console.error('Error:', error);
                                    $('#event_btn_submit').removeAttr("disabled");
                                    $("#event_btn_submit").text('Submit');
                                }
                            });
                        });
                    }
                });

                //to view the record in edit event
                $(document).on('click', '.edit_event', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('admin-event.edit') }}',
                        method: 'GET',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },

                        success: function(response) {
                        //  console.log(response);
                            let date = new Date(response.date);
                            let options = { year: 'numeric', month: 'long', day: 'numeric' };
                            let formattedDate = date.toLocaleDateString('en-US', options);

                            $("#edit_events_id").val(response.id);
                            $("#edit_title").val(response.title);
                            $("#edit_date").val(response.date);
                            $("#edit_start_time").val(response.start_time);
                            $("#edit_end_time").val(response.end_time);
                            $("#edit_venue").val(response.venue);
                            $("#edit_description").val(response.description);
                            $("#edit_monthly_highlight").val(response.monthly_highlight);
                            $("#previous_picture").html(
                                `<img src="storage/event/images/${response.picture}" class="modal_image">`
                            );
                        }
                    });
                });

                //to clear the data in edit modal if the user close it
                $('#edit_event_modal').on('hide.bs.modal', function () {
                    $("#edit_events_id").val('');
                    $("#edit_title").val('');
                    $("#edit_date").val('');
                    $("#edit_monthly_highlight").val('');
                    $("#edit_description").val('');
                    $("#previous_picture").html('');
                });

                var myDropzoneUpdate = new Dropzone("#UpdateEventDropzone", {
                    url: $("#UpdateEvent").attr('action'), // URL for form submission
                    method: 'POST',
                    paramName: 'file', // The name of the file upload parameter
                    // maxFilesize: 5, // MB
                    acceptedFiles: 'image/*', // Only accept images
                    addRemoveLinks: true,
                    maxFiles: 1, // Limit to 1 file
                    autoProcessQueue: true, // Disable auto-processing so we can handle it manually
                    init: function() {
                        var dz = this;

                        // Handle form submission
                        $("#UpdateEvent").on('submit', function(e) {
                            e.preventDefault();
                            $("#edit_event_btn_submit").html('Updating <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                            $('#edit_event_btn_submit').attr("disabled", true);

                            var form = this;
                            var formData = new FormData(form);

                            // Add Dropzone file to form data (if any)
                            if (dz.getAcceptedFiles().length > 0) {
                                formData.append('file', dz.getAcceptedFiles()[0]);
                            }

                            $.ajax({
                                url: $(form).attr('action'),
                                method: $(form).attr('method'),
                                data: formData,
                                processData: false,
                                dataType: "json",
                                contentType: false,
                                beforeSend: function() {
                                    $(form).find('span.error-text').text('');
                                },
                                success: function(response) {
                                    if (response.status == 0) {
                                        $('#edit_event_btn_submit').removeAttr("disabled");

                                        $.each(response.error, function(prefix, val) {
                                            $(form).find('span.' + prefix + '_error').text(val[0]);
                                        });

                                        $("#edit_event_btn_submit").text('Update');
                                    } else {
                                        $(form)[0].reset();
                                        dz.removeAllFiles(); // Clear Dropzone files
                                        $('#edit_event_btn_submit').removeAttr("disabled");
                                        $('#edit_event_btn_submit').text('Update');
                                        AllEventRecord();
                                        $("#edit_event_modal").modal('hide'); // Hide the modal

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Event Updated Successfully',
                                            showConfirmButton: true,
                                        });
                                    }

                                    $('#edit_event_close_btn').on('click', function() {
                                        $("#UpdateEvent").find('span.text-danger').text('');
                                    });

                                    $('#edit_event_close_header_btn').on('click', function() {
                                        $("#UpdateEvent").find('span.text-danger').text('');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    $('#edit_event_btn_submit').removeAttr("disabled");
                                    $("#edit_event_btn_submit").text('Update');
                                }
                            });
                        });
                    }
                });

                // To delete the event
                $(document).on('click', '.delete_event', function(e) {

                    e.preventDefault();
                    let id = $(this).attr('id');
                    let csrf = '{{ csrf_token() }}';
                    Swal.fire({
                        title: 'Are you sure you want to delete this event?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('admin-event.delete') }}',
                                method: 'delete',
                                data: {
                                    id: id,
                                    _token: csrf
                                },
                                success: function(response) {
                                    console.log(response);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Event Deleted Successfully.',
                                        showConfirmButton: true,

                                    })
                                    AllEventRecord();

                                }
                            });
                        }
                    })

                });

            });
        </script>

    @endsection

@endsection
