@extends('layouts.user')

@section('title')
    Event Suggestion
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
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Manage Suggested Event</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content pb-0">
                <div class="col-xl-12">
                    <div class="card card-flush h-md-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Suggested Event Records</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                            </h3>
                        </div>
                        <div class="card-body pt-6">
                            <div class="table-responsive" id="suggested_event_record">
                                {{-- Table appear here  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')

        <script type="text/javascript">

            $(document).ready(function() {
                SuggestEventRecord();
                //Get the record in the database
                function SuggestEventRecord() {
                    $.ajax({
                        url: '{{ route('suggest-event.record') }}',
                        method: 'GET',
                        success: function(response) {
                            $("#suggested_event_record").html(response);
                            $("#suggested_event_record_table").DataTable({
                                "order": [
                                    [0, "asc"]
                                ],
                            });
                        }
                    });
                }
            });
        </script>
    @endsection
@endsection
