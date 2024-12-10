

<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href=""/>
        <title> @yield('title')</title>
		<meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="Axel admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="keywords" content="Axel theme, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Oswald HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/products/oswald-html-pro" />
		<meta property="og:site_name" content="Keenthemes | Oswald HTML Free" />
		<link rel="canonical" href="https://preview.keenthemes.com/axel-html-free" />
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

		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" data-kt-app-header-stacked="true" data-kt-app-header-primary-enabled="true" data-kt-app-header-secondary-enabled="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>



         @yield('content')



		<script>var hostUrl = "assets/";</script>
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
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

        @yield('script')


	</body>
</html>
