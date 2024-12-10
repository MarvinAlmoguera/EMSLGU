<div id="kt_app_header" class="app-header">
<div class="app-header-primary" data-kt-sticky="true" data-kt-sticky-name="app-header-primary-sticky" data-kt-sticky-offset="{default: 'false', lg: '300px'}">
        <div class="app-container container-xxl d-flex align-items-stretch justify-content-between">
            <div class="d-flex flex-grow-1 flex-lg-grow-0">
                <div class="d-flex align-items-center" id="kt_app_header_logo_wrapper">
                    <button class="d-lg-none btn btn-icon btn-color-white btn-active-color-primary ms-n4 me-sm-2" id="kt_app_header_menu_toggle">
                        <i class="ki-duotone ki-abstract-14 fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <a href="#" class="d-flex align-items-center mb-1 mb-lg-0 pt-lg-1 mt-6">
                        <img alt="Logo" src="{{ asset('assets/media/logos/Bulan.png') }}" class="d-block d-sm-none" style="height: 60px; width: auto;" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/Bulan.png') }}" class="d-none d-sm-block" style="height: 60px; width: auto;" />
                        
                    </a>
                    <a href="#" class="d-flex align-items-center mb-1 mb-lg-0 pt-lg-1 mt-6">
                        <img alt="Logo" src="{{ asset('assets/media/logos/favicon.png') }}" class="d-block d-sm-none" style="height: 60px; width: auto;" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/favicon.png') }}" class="d-none d-sm-block" style="height: 60px; width: auto;" />
                        
                    </a>
                    <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 pt-lg-1 mt-6">
                        <img alt="Logo" src="{{ asset('assets/media/logos/emslbs-logo-white.png') }}" class="d-block d-sm-none" style="height: 40px; width: auto;" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/emslbs-logo-white.png') }}" class="d-none d-sm-block" style="height: 40px; width: auto;" />
                        
                    </a>
                </div>
            </div>
            <div class="app-navbar">
                <div class="app-navbar-item ms-3 me-6" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    
                        <img 
                            alt="profile" 
                            class="symbol symbol-35px img-fit"
                            src="{{ Auth::user()->profile_picture ? asset('storage/profile-picture/images/' . Auth::user()->profile_picture) : asset('assets/media/avatars/blank.png') }}" 
                        />

                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                {{-- <div class="symbol symbol-50px me-5">
                                    <img alt="profile" class="img-fit" src="{{ asset('storage/profile-picture/images/' . Auth::user()->profile_picture) }}" />
                                </div> --}}
                                <div class="symbol symbol-50px me-5">
                                    <img 
                                        alt="profile" 
                                        class="img-fit" 
                                        src="{{ Auth::user()->profile_picture ? asset('storage/profile-picture/images/' . Auth::user()->profile_picture) : asset('assets/media/avatars/blank.png') }}" 
                                    />
                                </div>
                                
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"></span>
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a class="menu-link {{ request()->routeIs('profile-account.index') ? 'active' : '' }}" href="{{ route('profile-account.index') }}">
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
                                    </span>
                                </span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
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
                                <a class="menu-link px-5" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sign Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-header-secondary">
        <div class="app-container container-xxl d-flex align-items-stretch">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch flex-grow-1" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">

                <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                    <div class="menu-item {{ request()->routeIs('dashboard.index') || request()->routeIs('dashboard.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('dashboard.index') }}" class="menu-link {{ request()->routeIs('dashboard.index') || request()->routeIs('dashboard.*') ? 'active' : '' }}">
                            <span class="menu-title">Dashboard</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('admin-announcement.index') || request()->routeIs('admin-announcement.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('admin-announcement.index') }}" class="menu-link {{ request()->routeIs('admin-announcement.index') || request()->routeIs('admin-announcement.*') ? 'active' : '' }}">
                            <span class="menu-title">Announcement</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin-announcement.index') ? 'active' : '' }}" href="{{ route('admin-announcement.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Manage Announcement</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('admin-event.index') || request()->routeIs('admin-event.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('admin-event.index') }}" class="menu-link {{ request()->routeIs('admin-event.index') || request()->routeIs('admin-event.*') ? 'active' : '' }}">
                            <span class="menu-title">Events</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin-event.index') ? 'active' : '' }}" href="{{ route('admin-event.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Manage Events</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('suggested-event.index') || request()->routeIs('suggested-event.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('suggested-event.index') }}" class="menu-link {{ request()->routeIs('suggested-event.index') || request()->routeIs('suggested-event.*') ? 'active' : '' }}">
                            <span class="menu-title">Event Suggestion</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('suggested-event.index') ? 'active' : '' }}" href="{{ route('suggested-event.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Manage Event Suggestion</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('user-account.index') || request()->routeIs('user-account.*') ? 'menu-here-bg' : '' }} me-0 me-lg-2">
                        <a href="{{ route('user-account.index') }}" class="menu-link {{ request()->routeIs('user-account.index') || request()->routeIs('user-account.*') ? 'active' : '' }}">
                            <span class="menu-title">Users</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('user-account.index') ? 'active' : '' }}" href="{{ route('user-account.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Manage Users</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
