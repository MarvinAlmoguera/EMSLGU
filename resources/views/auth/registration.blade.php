@extends('layouts.app')
@section('title')
    Registration
@endsection
@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div id="leftcon" class=" d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <div style="margin-bottom:14rem;" class="d-flex flex-column text-center p-5 p-lg-10 pt-lg-20 justify-content-center align-items-center">
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <img id="logo1" alt="Logo" src="{{ asset('assets/media/logos/favicon.png') }}" class="h-120px w-120px h-lg-100px mb-5"/>
                    <img id="logo2" alt="Logo" src="{{ asset('assets/media/logos/Bulan.png') }}" class="h-120px w-160px h-lg-100px mb-5"/>
                </div>
            </div>
                <div  class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain min-h-100px " style="background-image: url(assets/media/logos/emslbs-orange.png);"></div>
                <p class="text-center d-none d-lg-block fw-semibold fs-5 text-white " Style="margin-top:3rem;">This is User-Friendly Web System Empowers you to Plan, Manage,<br> and Execute all Aspects of your Events in one place.</p>
            </div>
        </div>
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-600px p-10 p-lg-15 mx-auto">
                        <form method="POST" action="{{ route('registration.store') }}" class="form w-100" id="RegisterUserAccount" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-10 text-center">
                                <h1 class="text-light mb-3">Create an Account</h1>
                                <div class="text fw-semibold fs-4" style="color:#c36618">Already have an account?
                                    <a href="{{ route('login') }}" class="link fw-bold" style="color:#fff">Sign in here</a>
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="row fv-row mb-7">
                                <div class="col-xl-6 mt-3">
                                    <label class="form-label fw-bold text-light fs-6">First Name</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="First Name" name="firstname" />
                                    <span class="error-text firstname_error text-danger"></span>
                                </div>

                                <!-- Last Name -->
                                <div class="col-xl-6 mt-3">
                                    <label class="form-label fw-bold text-light fs-6">Last Name</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="Last Name" name="lastname"/>
                                    <span class="error-text lastname_error text-danger"></span>
                                </div>
                            </div>

                            <!-- Age -->
                            <div class="row fv-row mb-7">
                                <div class="col-xl-6">
                                    <label class="form-label fw-bold text-light fs-6">Age</label>
                                    <input class="form-control form-control-lg form-control-solid" type="number" min="1" placeholder="Age" name="age" />
                                    <span class="error-text age_error text-danger"></span>
                                </div>

                                <!-- Gender -->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bold text-light fs-6">Gender</label>
                                    <select class="form-select form-select-solid" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <span class="error-text gender_error text-danger"></span>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row fv-row mb-7">
                                <div class="col-xl-12">
                                    <label class="form-label fw-bold text-light fs-6">Address</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="Address" name="address"/>
                                    <span class="error-text address_error text-danger"></span>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="fv-row mb-7">
                                <label class="form-label fw-bold text-light fs-6">Email</label>
                                <input class="form-control form-control-lg form-control-solid" type="email" placeholder="Email" name="email"/>
                                <span class="error-text email_error text-danger"></span>
                            </div>

                            {{--Profile Picture--}}
                            <div class="fv-row mb-7">
                                <label class="form-label fw-bold text-light fs-6">Profile Picture</label>
                                <input class="form-control form-control-lg form-control-solid" type="file" accept="image/*" name="profile_picture"/>
                                <span class="error-text profile_picture_error text-danger"></span>
                            </div>

                            <!-- Password -->
                            <div class="mb-10 fv-row" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <label class="form-label fw-bold text-light fs-6">Password</label>
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Password" name="password" />
                                    </div>
                                    <span class="error-text password_error text-danger"></span>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="fv-row mb-5">
                                <label class="form-label fw-bold text-light fs-6">Confirm Password</label>
                                <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Confirm Password" name="password_confirmation" />
                                <span class="error-text password_confirmation_error text-danger"></span>
                            </div>

                            <!-- Submit Button -->
                            <div class="fv-row mb-5">
                                <button type="submit" class="btn btn-lg text-white  w-100 mb-5" style="background:#c36618" id="btn_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Bind the form submission to AJAX
            $("#RegisterUserAccount").on('submit', function(e) {
                e.preventDefault();
                $("#btn_submit").html('Submitting <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                $('#btn_submit').attr("disabled", true);

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
                            $.each(response.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                            $("#btn_submit").html('Submit');
                            $('#btn_submit').removeAttr("disabled");
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: response.msg,
                                showConfirmButton: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect; // Redirect after confirmation
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle server errors
                        console.log(xhr.responseText);
                        $("#btn_submit").html('Submit');
                        $('#btn_submit').removeAttr("disabled");
                    }
                });
            });
        });
    </script>


@endsection
