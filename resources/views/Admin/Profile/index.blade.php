@extends('layouts.admin')
@section('title')
    Profile Account
@endsection
@section('content')
    <div id="kt_app_content" class="app-content pb-0 col-12">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Profile Details</h3>
                </div>
            </div>
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form id="" class="form" action="{{route('profile-account.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Profile Picture</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{asset('assets/media/svg/avatars/blank.svg')}}')">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px"
                                         style="background-image: url('{{ asset('storage/profile-picture/images/' . Auth::user()->profile_picture) }}');">
                                    </div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="profile_picture" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                @error('profile_picture')
                                     <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                            <div class="col-lg-8">
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-6 fv-row">
                                        <input type="text" name="firstname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{Auth::user()->firstname}}" />
                                        @error('firstname')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 fv-row">
                                        <input type="text" name="lastname" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="{{Auth::user()->lastname}}" />
                                        @error('lastname')
                                           <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Address</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Address" value="{{Auth::user()->address}}" />
                                @error('address')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Age</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="number" min="1" name="age" class="form-control form-control-lg form-control-solid" placeholder="Age" value="{{Auth::user()->age}}" />
                                @error('age')
                                     <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Gender</span>
                            </label>
                            <div class="col-lg-8 fv-row">

                                <select class="form-control form-control-lg form-control-solid"  name="gender">
                                    <option value="">Select</option>
                                    <option value="Male" {{ Auth::user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ Auth::user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                     <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">
                                    Email Address
                                </span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{Auth::user()->email}}" />
                                @error('email')
                                     <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">
                                    New Password
                                </span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="New Password" />
                                @error('password')
                                     <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Confirm Password</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Confirm New Password" />
                                @error('password_confirmation')
                                <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" >Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
