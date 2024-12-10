@extends('layouts.admin')
@section('title')
    Event Calendar
@endsection
@section('content')


    <style>
        .legend {
            margin: 1em 0;
        }
        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5em;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 0.5em;
            border-radius: 4px;
        }
        .legend-label {
            font-size: 1em;
        }
    </style>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar pt-lg-9 pt-6">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                    <div class="d-flex flex-stack flex-wrap gap-4 w-100">
                        <div class="page-title d-flex flex-column gap-3 me-3">
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                    <a href="../dist/index.html" class="text-gray-500">
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
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Dashboard</li>
                              
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-3 gap-lg-5">
                             <div class="m-0">
                                <a href="{{route('dashboard.index')}}" class="btn btn-flex btn-sm btn-color-gray-700 bg-body fw-bold px-4">
                                    <i class="ki-duotone ki-double-left">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content pb-0">
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                    <div class="col-xl-12">
                        <div class="card card-flush h-md-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-white">Event Highlights</span>
                                </h3>
                            </div>
                            <div class="card-body pt-6">
                                <div class="legend">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: white;"></div>
                                        <div class="legend-label">Monthly Event Highlight</div>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: blue;"></div>
                                        <div class="legend-label">Regular Event</div>
                                    </div>
                                    <!-- Add more legend items as needed -->
                                </div>

                                <div id="event-calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('event-calendar');

            var data = @json($events_data);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'title',
                    center: 'dayGridMonth,listMonth',
                    right: 'prev,next'
                },
                events: data.map(event => ({
                    title: event.title,
                    start: event.start_datetime,
                    end: event.end_datetime,
                    color: event.color // Optional: Use color if desired
                }))
            });

            calendar.render();
        });
    </script>


@endsection
