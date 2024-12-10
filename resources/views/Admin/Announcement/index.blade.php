@extends('layouts.admin')
@section('title')
   Manage Announcement
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
                                <a href="#" class="text-gray-500">
                                    <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Manage Announcement</li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-3 gap-lg-5">
                        <div class="m-0">
                            <a href="#" class="btn btn-flex btn-sm btn-color-gray-700 bg-body fw-bold px-4"style="background-color:#c36618" data-bs-toggle="modal" data-bs-target="#modal_create_announcement">

                                <i class="ki-duotone ki-plus-square fs-2 p-0 m-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                New Announcement
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content pb-0">
                <div class="col-xl-12">
                    <div class="card card-flush h-md-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Announcement Records</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                            </h3>
                        </div>
                        <div class="card-body pt-6">
                            <div class="table-responsive" id="announcement_record">
                                {{-- Table appear here  --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Modal For Create of Annoucement--}}
<div class="modal fade" id="modal_create_announcement" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="announcement_close_header_btn">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y pt-0 pb-15">
                <div class="mb-13">
                    <h1 class="text-center mb-5">Create New Announcement</h1>
                    <form action="{{route('admin-announcement.store')}}" method="POST" id="CreateAnnouncement"
                          enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Title
                                    <span class="label-span-danger">*</span></label>
                                <input type="text" name="title" class="form-control form-control-solid" placeholder="Title">
                            </div>
                            <span class="text-danger error-text title_error"></span>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-12">
                                <label class="form-label"> Description
                                    <span class="label-span-danger">*</span></label>
                                <textarea class="form-control form-control-solid"  name="description"  cols="20" rows="5" placeholder="Type here ..."></textarea>
                            </div>
                            <span class="text-danger error-text description_error"></span>
                        </div>

                        <div class="mt-4 float-end">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"  id="announcement_close_btn">Close</button>
                            <button type="submit" class="btn btn-sm" style="color:#3b5b50" id="announcement_btn_submit">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal For Viewing of Annoucement--}}
<div class="modal fade" id="view_announcement_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y pt-0 pb-15">
                <div class="mb-13">
                    <h1 class="text-center mb-5">View Announcement</h1>
                    <form action="{{route('admin-announcement.view')}}" method="POST"
                          enctype="multipart/form-data">
                        <input type="text" name="announcement_id" id="announcement_id" readonly hidden>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Title
                                    <span class="label-span-danger">*</span></label>
                                <input type="text" name="title" class="form-control form-control-solid" placeholder="Title" id="view_announcement_title" readonly>
                            </div>
                            <span class="text-danger error-text title_error"></span>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-12">
                                <label class="form-label"> Description
                                    <span class="label-span-danger">*</span></label>
                                <textarea class="form-control form-control-solid"  name="description"  id="view_announcement_description" cols="20" rows="5" placeholder="Type here ..." readonly></textarea>
                            </div>
                            <span class="text-danger error-text description_error"></span>
                        </div>

                        <div class="mt-4 float-end">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"  id="announcement_close_btn">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal For Edit of Annoucement--}}
<div class="modal fade" id="edit_announcement_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="edit_announcement_close_header_btn">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y pt-0 pb-15">
                <div class="mb-13">
                    <h1 class="text-center mb-5">Edit Announcement</h1>
                    <form action="{{route('admin-announcement.update')}}" method="POST" id="UpdateAnnouncement"
                          enctype="multipart/form-data">
                        <input type="text" name="edit_announcement_id" id="edit_announcement_id" readonly hidden>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Title
                                    <span class="label-span-danger">*</span></label>
                                <input type="text" name="title" class="form-control form-control-solid" placeholder="Title" id="edit_announcement_title">
                            </div>
                            <span class="text-danger error-text title_error"></span>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-12">
                                <label class="form-label"> Description
                                    <span class="label-span-danger">*</span></label>
                                <textarea class="form-control form-control-solid"  name="description"  id="edit_announcement_description" cols="20" rows="5" placeholder="Type here ..."></textarea>
                            </div>
                            <span class="text-danger error-text description_error"></span>
                        </div>

                        <div class="mt-4 float-end">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"  id="edit_announcement_close_btn">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary" id="edit_announcement_btn_submit">Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')

    <script type="text/javascript">
        $(document).ready(function (){

            AllAnnouncementRecords();

            //Get the record in the database
            function AllAnnouncementRecords() {
                $.ajax({
                    url: '{{route('admin-announcement.announcement-record')}}',
                    method: 'GET',
                    success: function(response) {
                        $("#announcement_record").html(response);
                        $("#all_announcement_table").DataTable({
                            "order": [
                                [0, "asc"]
                            ],
                        });
                    }
                });
            }

            //to store or insert it to the database
            $("#CreateAnnouncement").on('submit', function(e) {
                e.preventDefault();
                $("#announcement_btn_submit").html('Submitting <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                $('#announcement_btn_submit').attr("disabled", true);
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data:  new FormData(form),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(response) {
                        if (response.status == 0) {
                            $('#announcement_btn_submit').removeAttr("disabled");

                            $.each(response.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });

                            $("#announcement_btn_submit").text('Submit');
                        } else {
                            $(form)[0].reset();
                            $('#announcement_btn_submit').removeAttr("disabled");
                            $('#announcement_btn_submit').text('Submit');
                            AllAnnouncementRecords();
                            $("#modal_create_announcement").modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Announcement Created Successfully!',
                                showConfirmButton: true,
                            });
                        }

                        $('#announcement_close_btn').on('click', function() {
                            $("#CreateAnnouncement").find('span.text-danger').text('');
                        });

                        $('#announcement_close_header_btn').on('click', function() {
                            $("#CreateAnnouncement").find('span.text-danger').text('');
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle any error that occurred during the request
                        console.error('Error:', error);
                        $('#announcement_btn_submit').removeAttr("disabled");
                        $("#announcement_btn_submit").text('Submit');
                    }
                });
            });

            //View the announcement
            $(document).on('click', '.view_announcement', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('admin-announcement.view') }}',
                    method: 'GET',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Log raw response data for debugging
                        console.log('response data:', response);

                        // Set values in the modal
                        $("#announcement_id").val(response.id);
                        $("#view_announcement_title").val(response.announcement_title);
                        $("#view_announcement_description").val(response.announcement_description);

                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });

            //View the announcement
            $(document).on('click', '.edit_announcement', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('admin-announcement.edit') }}',
                    method: 'GET',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Log raw response data for debugging
                        console.log('response data:', response);

                        // Set values in the modal
                        $("#edit_announcement_id").val(response.id);
                        $("#edit_announcement_title").val(response.announcement_title);
                        $("#edit_announcement_description").val(response.announcement_description);

                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });


            //To update the record
            $("#UpdateAnnouncement").on('submit', function(e) {
                e.preventDefault();
                $("#edit_announcement_btn_submit").html('Updating <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                $('#edit_announcement_btn_submit').attr("disabled", true);
                var form = this;

                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(response) {

                        if (response.status == 0) {
                            $('#edit_announcement_btn_submit').removeAttr("disabled");

                            $.each(response.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });

                            $("#edit_announcement_btn_submit").text('Update');

                        } else {

                            $(form)[0].reset();
                            $('#edit_announcement_btn_submit').removeAttr("disabled");
                            $('#edit_announcement_btn_submit').text('Update');
                            AllAnnouncementRecords();
                            $("#edit_announcement_modal").modal('hide'); //hide the modal

                            // SWEETALERT
                            Swal.fire({
                                icon: 'success',
                                title: 'Announcement updated successfully',
                                showConfirmButton: true,

                            })
                        }
                        // Event binding for close button inside modal
                        $('#edit_announcement_close_btn').on('click', function() {
                            $("#UpdateAnnouncement").find('span.text-danger').text('');
                        });

                        $('#edit_announcement_close_header_btn').on('click', function() {
                            $("#UpdateAnnouncement").find('span.text-danger').text('');
                        });

                    }
                });
            });

            // To delete the event
            $(document).on('click', '.delete_announcement', function(e) {
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
                            url: '{{ route('admin-announcement.delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Announcement Deleted Successfully.',
                                    showConfirmButton: true,

                                })
                                AllAnnouncementRecords();

                            }
                        });
                    }
                })

            });

        });
    </script>
@endsection
@endsection

