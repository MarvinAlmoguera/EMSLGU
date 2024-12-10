@extends('layouts.admin')
@section('title')
    Manage User
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
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">User</li>
                                <li class="breadcrumb-item">
                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                </li>
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Account</li>
                            </ul>
                        </div>
{{--                        <div class="d-flex align-items-center gap-3 gap-lg-5">--}}
{{--                            <div class="m-0">--}}
{{--                                <a href="#" class="btn btn-flex btn-sm btn-color-gray-700 bg-body fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modal_create_announcement">--}}

{{--                                    <i class="ki-duotone ki-plus-square fs-2 p-0 m-1">--}}
{{--                                        <span class="path1"></span>--}}
{{--                                        <span class="path2"></span>--}}
{{--                                        <span class="path3"></span>--}}
{{--                                    </i>--}}
{{--                                    New User Account--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content pb-0">
                <div class="col-xl-12">
                    <div class="card card-flush h-md-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Manage Account</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                            </h3>
                        </div>
                        <div class="card-body pt-6">
                            <div class="table-responsive" id="user_record">
                                {{-- Table appear here  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Modal for edit the user account--}}
    <div class="modal fade" id="edit_user_account_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="edit_user_account_close_header_btn">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y pt-0 pb-15">
                    <div class="mb-13">
                        <h1 class="text-center mb-5">Edit User Account</h1>
                        <form action="{{route('user-account.update')}}" method="POST" id="UpdateUserAccount"
                              enctype="multipart/form-data">
                            @csrf

                            <input type="text" name="id" id="id" hidden readonly>

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label"> FirstName
                                        <span class="label-span-danger">*</span></label>
                                    <input type="text" name="firstname" class="form-control form-control-solid" placeholder="FirstName" id="edit_firstname">
                                </div>
                                <span class="text-danger error-text firstname_error"></span>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> LastName
                                        <span class="label-span-danger">*</span></label>
                                    <input type="text" name="lastname" class="form-control form-control-solid" placeholder="LastName" id="edit_lastname">
                                </div>
                                <span class="text-danger error-text lastname_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Age
                                        <span class="label-span-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" min="1" placeholder="Age" id="edit_age" name="age">
                                </div>
                                <span class="text-danger error-text age_error"></span>
                            </div>


                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label for="subject_code" class="form-label">Gender <span
                                            class="login-danger">*</span></label>
                                    <select class="form-select form-select-solid" id="edit_gender" name="gender">
                                        <option value="">Select Gender </option>
                                        <option value="Male">Male</option>
                                        <option value="Female">No</option>
                                    </select>
                                    <span class="text-danger error-text gender_error"></span>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Address
                                        <span class="label-span-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid"  placeholder="Address" id="edit_address" name="address">
                                </div>
                                <span class="text-danger error-text address_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Email
                                        <span class="label-span-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid"  placeholder="Email" id="edit_email" name="email">
                                </div>
                                <span class="text-danger error-text email_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> New Password
                                        <span class="label-span-danger">*</span></label>
                                    <input type="password" class="form-control form-control-solid"  placeholder="New Password" name="password">
                                </div>
                                <span class="text-danger error-text password_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label for="subject_code" class="form-label">Profile Picture <span
                                            class="login-danger">*</span></label>
                                    <input type="file" class="form-control form-control-solid"  placeholder=""  accept="image/*"  name="profile_picture">
                                    <span class="text-danger error-text profile_picture_error"></span>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Previous Image
                                        <span class="label-span-danger">*</span></label>
                                    <div class="justify-content-center image-container" id="previous_profile_picture">
                                        {{-- Profile Will Appear Hear--}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 float-end">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"  id="edit_user_account_close_btn">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary" id="edit_user_account_btn_submit">Update </button>
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

                AllUserRecords();
                //Get the record in the database
                function AllUserRecords() {
                    $.ajax({
                        url: '{{route('user-account.record')}}',
                        method: 'GET',
                        success: function(response) {
                            $("#user_record").html(response);
                            $("#all_user_record_table").DataTable({
                                "order": [
                                    [0, "asc"]
                                ],
                            });
                        }
                    });
                }

                $(document).on('click', '.edit_user', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('user-account.edit') }}',
                        method: 'GET',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },

                        success: function(response) {

                            $("#id").val(response.id);
                            $("#edit_firstname").val(response.firstname);
                            $("#edit_lastname").val(response.lastname);
                            $("#edit_age").val(response.age);
                            $("#edit_gender").val(response.gender);
                            $("#edit_address").val(response.address);
                            $("#edit_email").val(response.email);
                            $("#previous_profile_picture").html(
                                `<img src="storage/profile-picture/images/${response.profile_picture}" class="modal_image">`
                            );
                        }
                    });
                });

                //to clear the data in edit modal if the user close it
                $('#edit_user_account_modal').on('hide.bs.modal', function () {
                    $("#edit_events_id").val('');
                    $("#edit_firstname").val('');
                    $("#edit_lastname").val('');
                    $("#edit_age").val('');
                    $("#edit_gender").val('');
                    $("#edit_address").val('');
                    $("#edit_email").val('');
                    $("#previous_profile_picture").html('');
                });

                $("#UpdateUserAccount").on('submit', function(e) {
                    e.preventDefault();
                    $("#edit_user_account_btn_submit").html('Updating <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                    $('#edit_user_account_btn_submit').attr("disabled", true);
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
                                $('#edit_user_account_btn_submit').removeAttr("disabled");

                                $.each(response.error, function(prefix, val) {
                                    $(form).find('span.' + prefix + '_error').text(val[0]);
                                });

                                $("#edit_user_account_btn_submit").text('Update');

                            } else {

                                $(form)[0].reset();
                                $('#edit_user_account_btn_submit').removeAttr("disabled");
                                $('#edit_user_account_btn_submit').text('Update');
                                AllUserRecords();
                                $("#edit_user_account_modal").modal('hide'); //hide the modal

                                // SWEETALERT
                                Swal.fire({
                                    icon: 'success',
                                    title: 'User Account updated successfully',
                                    showConfirmButton: true,

                                })
                            }
                            // Event binding for close button inside modal
                            $('#edit_user_accooount_close_btn').on('click', function() {
                                $("#UpdateUserAccount").find('span.text-danger').text('');
                            });

                            $('#edit_user_account_close_header_btn').on('click', function() {
                                $("#UpdateUserAccount").find('span.text-danger').text('');
                            });

                        }
                    });
                });

            });
        </script>
    @endsection
@endsection

