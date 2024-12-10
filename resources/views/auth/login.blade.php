@extends('layouts.app')
@section('title')
  Login
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
        <div id="rightcon"  class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <form action="{{route('login')}}" method="POST" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="" action="#">
                        @csrf
                        <div class="text-center mb-10">
                            <h1 class="text-light mb-3" style="font-size: 3rem;">Sign In </h1>
                            <div class="text-gray-400 fw-semibold fs-4">New Here?
                            <a href="{{route('registration.index')}}" class="link fw-bold text-white">Create an Account</a></div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bold text-light">Email</label>
                            <input class="form-control form-control-lg form-control-solid  @error('email') is-invalid @enderror" type="email" name="email" autocomplete="off" value="{{ old('email') }}" />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bold text-white fs-6 mb-0">Password</label>
                            </div>
                            <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off" />
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg w-100 mb-5 text-white" style="background-color: #c36618; text-white">Login </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
