@extends('layouts.user')
@section('title')
     Announcement
@endsection
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Wrapper container-->
                <div class="app-container container-xxl d-flex flex-row flex-column-fluid">
                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">

                            <div id="kt_app_toolbar" class="app-toolbar pt-lg-9 pt-6">
                                <!--begin::Toolbar container-->
                                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                                    <!--begin::Toolbar wrapper-->
                                    <div class="d-flex flex-stack flex-wrap gap-4 w-100">
                                        <!--begin::Page title-->
                                        <div class="page-title d-flex flex-column gap-3 me-3">
                                            <!--begin::Breadcrumb-->
                                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                                    <a href="{{route('user.dashboard.index')}}" class="text-gray-500">
                                                        <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                                    </a>
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item">
                                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">User</li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item">
                                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item text-gray-500">All Announcements</li>
                                                <!--end::Item-->
                                            </ul>
                                            <!--end::Breadcrumb-->
                                        </div>
                                    </div>
                                    <!--end::Toolbar wrapper-->
                                </div>
                                <!--end::Toolbar container-->
                            </div>
                            <div id="kt_app_content" class="app-content pb-0">
                                <div class="row g-6 g-xl-9">
                                    @if($all_announcements->isEmpty())
                                        <div class="col-12 text-center my-5 mt-5">
                                            <h4>No Upcoming Announcements</h4>
                                        </div>
                                    @else
                                        @foreach($all_announcements as $data)
                                            <div class="col-md-6 col-xl-4">
                                                <a href="#" class="card border-hover-primary h-100 d-flex flex-column">

                                                    <div class="card-body d-flex flex-column flex-grow-1">
                                                        <div class="border border-gray-300 border-dashed rounded py-2 px-3 mb-5">
                                                            <div class="fs-4 fw-bold text-dark mb-2 text-center" style="text-transform: uppercase;">{{ $data->announcement_title }}</div>
                                                        </div>
                                                        <p class="text-gray-800 fw-semibold fs-6 fw-bold" style="text-align: justify; text-indent: 20px;">
                                                            {{ $data->announcement_description }}
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                @if($all_announcements->count() > 0)
                                    <div class="d-flex flex-stack flex-wrap pt-10 mb-5">
                                        <!-- Pagination Display Text -->
                                        <div class="fs-6 fw-semibold text-gray-700">
                                            Showing {{ $all_announcements->firstItem() }} to {{ $all_announcements->lastItem() }} of {{ $all_announcements->total() }} entries
                                        </div>

                                        <!-- Pagination Links -->
                                        <ul class="pagination">
                                            <!-- Previous Button -->
                                            @if ($all_announcements->onFirstPage())
                                                <li class="page-item disabled">
                                                    <a href="#" class="page-link">
                                                        <i class="previous"></i>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item previous">
                                                    <a href="{{ $all_announcements->previousPageUrl() }}" class="page-link">
                                                        <i class="previous"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            <!-- Page Numbers -->
                                            @for ($i = 1; $i <= $all_announcements->lastPage(); $i++)
                                                <li class="page-item {{ $i == $all_announcements->currentPage() ? 'active' : '' }}">
                                                    <a href="{{ $all_announcements->url($i) }}" class="page-link">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            <!-- Next Button -->
                                            @if ($all_announcements->hasMorePages())
                                                <li class="page-item next">
                                                    <a href="{{ $all_announcements->nextPageUrl() }}" class="page-link">
                                                        <i class="next"></i>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <a href="#" class="page-link">
                                                        <i class="next"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @include('layouts.Partials.User.Footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
