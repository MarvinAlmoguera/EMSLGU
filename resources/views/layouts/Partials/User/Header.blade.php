<div id="kt_app_header" class="app-header">
    <!--begin::Header primary-->
    <div class="app-header-primary" data-kt-sticky="true" data-kt-sticky-name="app-header-primary-sticky" data-kt-sticky-offset="{default: 'false', lg: '300px'}">
        <!--begin::Header primary container-->
        <div class="app-container container-xxl d-flex align-items-stretch justify-content-between">
            <!--begin::Logo and search-->
            <div class="d-flex flex-grow-1 flex-lg-grow-0">
                <!--begin::Logo wrapper-->
                <div class="d-flex align-items-center" id="kt_app_header_logo_wrapper">
                    <!--begin::Header toggle-->
                    <button class="d-lg-none btn btn-icon btn-color-white btn-active-color-primary ms-n4 me-sm-2" id="kt_app_header_menu_toggle">
                        <i class="ki-duotone ki-abstract-14 fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <!--end::Header toggle-->
                    <!--begin::Logo-->
                    <a href="#" class="d-flex align-items-center mb-1 mb-lg-0 pt-lg-1 mt-6">
                        <img alt="Logo" src="{{ asset('assets/media/logos/Bulan.png') }}" class="d-block d-sm-none" style="height: 60px; width: auto;" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/Bulan.png') }}" class="d-none d-sm-block" style="height: 60px; width: auto;" />
                        
                    </a>
                    <a href="#" class="d-flex align-items-center mb-1 mb-lg-0 pt-lg-1 mt-6">
                        <img alt="Logo" src="{{ asset('assets/media/logos/favicon.png') }}" class="d-block d-sm-none" style="height: 60px; width: auto;" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/favicon.png') }}" class="d-none d-sm-block" style="height: 60px; width: auto;" />
                        
                    </a>
                    <a href="#" class="d-flex align-items-center mb-0 mb-lg-0 pt-lg-1 mt-6">
                        <img alt="Logo" src="{{ asset('assets/media/logos/emslbs-logo-white.png') }}" class="d-block d-sm-none" style="height: 40px; width: auto;" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/emslbs-logo-white.png') }}" class="d-none d-sm-block" style="height: 40px; width: auto;" />
                        
                    </a>
                    <!--end::Logo-->
                </div>
            </div>
            <div class="app-navbar">
                @if(Auth::check())
                    <div class="app-navbar-item ms-3 me-6" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img class="symbol symbol-35px img-fit" src="{{ asset('storage/profile-picture/images/' . Auth::user()->profile_picture) }}" alt="user" />
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="profile" class="img-fit" src="{{ asset('storage/profile-picture/images/' . Auth::user()->profile_picture) }}" />
                                    </div>

                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bold d-flex align-items-center fs-5">{{Auth::user()->firstname}} {{Auth::user()->lastname}}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"></span></div>
                                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-5">
                                <a class="menu-link {{ request()->routeIs('user-profile-account.index') ? 'active' : '' }}"
                                href="{{ route('user-profile-account.index') }}">
                                    My Profile
                                </a>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title position-relative">Mode
                                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                        <i class="ki-duotone ki-night-day theme-light-show fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                            <span class="path7"></span>
                                            <span class="path8"></span>
                                            <span class="path9"></span>
                                            <span class="path10"></span>
                                        </i>
                                        <i class="ki-duotone ki-moon theme-dark-show fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span></span>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-night-day fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                    <span class="path7"></span>
                                                    <span class="path8"></span>
                                                    <span class="path9"></span>
                                                    <span class="path10"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Light</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-moon fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Dark</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-screen fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">System</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item px-5">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="menu-link px-5" href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Sign Out') }}
                                    </a>
                                </form>
                            </div>
                        </div>           
                    </div>
                @else
                    <a href="{{route('login')}}" class="btn btn-flex btn-center btn-sm align-self-center p-3 px-lg-4 h-35px text-light" style="background:#c36618">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="app-header-secondary">
        <div class="app-container container-xxl d-flex align-items-stretch">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch flex-grow-1" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                    <!--begin:Menu item for Dashboards-->
                    <div class="menu-item {{ request()->routeIs('user.dashboard.index') || request()->routeIs('user.dashboard.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('user.dashboard.index') }}" class="menu-link {{ request()->routeIs('user.dashboard.index') || request()->routeIs('user.dashboard.*') ? 'active' : '' }}">
                            <span class="menu-title">Home</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>

                    <div class="menu-item {{ request()->routeIs('user-announcement.index') || request()->routeIs('user-announcement.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('user-announcement.index') }}" class="menu-link {{ request()->routeIs('user-announcement.index') || request()->routeIs('user-announcement.*') ? 'active' : '' }}">
                            <span class="menu-title">Announcement</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>

                    <div class="menu-item {{ request()->routeIs('suggest-event.index') || request()->routeIs('suggest-event.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('suggest-event.index') }}" class="menu-link {{ request()->routeIs('suggest-event.index') || request()->routeIs('suggest-event.*') ? 'active' : '' }}">
                            <span class="menu-title">Suggested Event</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
