<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href=""/>
        <title> @yield('title')</title>
		<meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description"/>
		<meta name="keywords"/>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Event Management System" />
		<meta property="og:url" />
		<meta property="og:site_name"/>
		<link rel="canonical"/>
		<link rel="shortcut icon" href="{{ URL::to('assets/media/logos/favicon.png')}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{ URL::to('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::to('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ URL::to('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::to('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<style>
			 .img-fit {
				object-fit: cover; 
				width: 100%;        
				height: 100%;       
			}
			.label-span-danger{
			 color: red;
			}
			.dropzone .dz-details {

				display: hidden !important;
			}

			.modal_image {
				max-width: 100%;
				height: auto;
			}
			
			.star-rating input[type="radio"] {
				 display: none;
			}
			.star-rating label.rating-star {
				font-size: 24px;
				color: #ccc;
				cursor: pointer;
			}
			.star-rating label.rating-star:hover,
			.star-rating input[type="radio"]:checked ~ label {
				color: #f39c12;
			}
			.comment-box {
				background-color: #f8f9fa;
				border-radius: 15px;
				padding: 15px;
			}
			.comments-section textarea {
				border-radius: 0.5rem;
			}
		
			.comments-section button {
				border-radius: 0.5rem;
				padding: 0.5rem 1rem;
			}

		</style>
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" data-kt-app-header-stacked="true" data-kt-app-header-primary-enabled="true" data-kt-app-header-secondary-enabled="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>

		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">

                @include('layouts.Partials.User.Header')

                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    <div class="app-container container-xxl d-flex flex-row flex-column-fluid">
                         @yield('content')
                    </div>
                </div>
			</div>
		</div>


		<script>var hostUrl = "assets/";</script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="{{ URL::to('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ URL::to('assets/js/scripts.bundle.js')}}"></script>

		<script src="{{ URL::to('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="{{ URL::to('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

		<script src="{{ URL::to('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/create-project/type.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/create-project/budget.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/create-project/settings.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/create-project/team.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/create-project/targets.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/create-project/files.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/create-project/main.js')}}"></script>
		<script src="{{ URL::to('assets/js/custom/utilities/modals/users-search.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            @if (Session::has('message'))
            toastr.options.progressBar = false;
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
            @endif
        </script>
        @yield('script')


	</body>
</html>
