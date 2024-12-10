@extends('layouts.user')

@section('title')
      Homepage
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
                                            <!--begin::Title-->
                                            <!--end::Title-->
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
                                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Home</li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item">
                                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item text-gray-500">Events</li>
                                                <!--end::Item-->
                                            </ul>
                                            <!--end::Breadcrumb-->
                                        </div>
                                      
                                        <div class="d-flex align-items-center gap-3 gap-lg-5">
                                            <div class="m-0">
                                                @if(Auth::check())
                                                    <a href="#" class="btn btn-flex btn-sm btn-color-gray-700 bg-body fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modal_suggest_event">
                                                        <i class="ki-duotone ki-plus-square fs-2 p-0 m-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                        Suggest Event
                                                    </a>
                                                @else
                                                    <a href="{{route('login')}}" class="btn btn-flex btn-sm btn-color-gray-700 bg-body fw-bold px-4">
                                                        <i class="ki-duotone ki-plus-square fs-2 p-0 m-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                        Suggest Event
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Toolbar wrapper-->
                                </div>
                                <!--end::Toolbar container-->
                            </div>
                            <div id="kt_app_content" class="app-content pb-0">
                                <div class="row g-6 g-xl-9">
                                    <div class="col-lg-6 col-xxl-12">
                                        <div class="card h-100">
                                            <div class="card-header pt-7">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-light">Monthly Event Highlights</span>
                                                </h3>
                                            </div>
                                    
                                            <div class="card-body p-9">
                                                @if($monthly_highlight_events->count() > 0)
                                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
                                                        <div class="carousel-inner">
                                                            @foreach ($monthly_highlight_events as $event)
                                                                <div class="carousel-item @if($loop->first) active @endif">
                                                                    <img src="{{ asset('storage/event/images/' . $event->picture) }}"
                                                                         class="d-block w-100"
                                                                         alt="{{ $event->title }}"
                                                                         data-bs-toggle="modal"
                                                                         data-bs-target="#modal{{ $loop->index }}"
                                                                         style="object-fit: cover; height: auto; max-height: 400px; width: 100%;">
                                                                    <div class="mt-3 border border-gray-300 border-dashed rounded py-2 px-3 mb-3">
                                                                        <div class="fs-6 text-gray-800 fw-bold text-center" style="text-transform: uppercase;">{{ $event->title }}</div>
                                                                        <div class="fw-semibold text-gray-400 text-center">Event Title</div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <!-- Carousel Controls -->
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="d-flex flex-wrap justify-content-between align-items-center my-5">
                                    <h2 class="fs-2 fw-semibold my-2">Upcoming Events</h2>
                                </div>
                                
                                <div class="row g-6 g-xl-9">
                                    @if($all_events->isEmpty())
                                        <div class="col-12 text-center my-5">
                                            <h4>No Upcoming Events</h4>
                                        </div>
                                    @else
                                        @foreach($all_events as $event)
                                            <div class="col-md-6 col-xl-4 mb-4">
                                                <!-- Event Card -->
                                                <div class="card border-hover-primary h-100 d-flex flex-column shadow-sm rounded-3">
                                                    <!-- Event Image -->
                                                    <div class="card-header border-0 p-0 position-relative">
                                                        <div class="w-100 h-200px bg-light overflow-hidden rounded-top">
                                                            <img src="{{ asset('storage/event/images/' . $event->picture) }}" alt="Event Image" class="w-100 h-100 object-cover rounded-top" />
                                                        </div>
                                                    </div>
                                
                                                    <!-- Card Body -->
                                                    <div class="card-body d-flex flex-column flex-grow-1 p-4">
                                                        <!-- Event Title -->
                                                        <div class="fs-4 fw-bold text-dark mb-2 text-center" style="text-transform: uppercase;">{{ $event->title }}</div>
                                
                                                        <!-- Event Details -->
                                                        <div class="d-flex justify-content-between mb-2">
                                                            <div class="border border-gray-300 border-dashed rounded py-2 px-3">
                                                                <div class="fs-6 text-gray-800 fw-bold">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</div>
                                                                <div class="fw-semibold text-gray-400">Event Date</div>
                                                            </div>
                                
                                                            <div class="border border-gray-300 border-dashed rounded py-2 px-3">
                                                                <div class="fs-6 text-gray-800 fw-bold">{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</div>
                                                                <div class="fw-semibold text-gray-400">Start Time</div>
                                                            </div>
                                
                                                            <div class="border border-gray-300 border-dashed rounded py-2 px-3">
                                                                <div class="fs-6 text-gray-800 fw-bold">{{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}</div>
                                                                <div class="fw-semibold text-gray-400">End Time</div>
                                                            </div>
                                                        </div>
                                
                                                        <!-- Venue -->
                                                        <div class="border border-gray-300 border-dashed rounded py-2 px-3 mb-3 text-center">
                                                            <div class="fs-6 text-gray-800 fw-bold">{{ $event->venue }}</div>
                                                            <div class="fw-semibold text-gray-400">Venue</div>
                                                        </div>
                                
                                                        <!-- Event Description -->
                                                        <div class="border border-gray-300 border-dashed rounded py-2 px-3 mb-3 text-center">
                                                            <p class="text-gray-800 fs-6 mb-4" style="text-align: justify;">{{ $event->description }}</p>
                                                        </div>
                                
                                                        <!-- Star Rating -->
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <div class="star-rating">
                                                                <form action="{{ route('feedback.events.rate', $event->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="d-flex justify-content-start">
                                                                        @for($i = 5; $i >= 1; $i--)
                                                                            <input type="radio" id="star{{ $i }}-{{ $event->id }}" name="rating" value="{{ $i }}" />
                                                                            <label for="star{{ $i }}-{{ $event->id }}" class="rating-star">&#9733;</label>
                                                                        @endfor
                                                                    </div>
                                                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Rate</button>
                                                                </form>
                                                            </div>
                                                            <small class="d-block text-muted mt-2">Average Rating: {{ round($event->averageRating(), 1) }} stars</small>
                                                        </div>
                                
                                                        <!-- Comments Section -->
                                                        <div class="comments-section">
                                                            <!-- Add Comment Form -->
                                                            <form action="{{ route('feedback.events.comment', $event->id) }}" method="POST" class="mb-3">
                                                                @csrf
                                                                <div class="d-flex">
                                                                    <!-- Comment Textarea -->
                                                                    <textarea name="comment" class="form-control me-2" rows="1" placeholder="Write your comment here..." style="resize: none; flex: 1;"></textarea>
                                                
                                                                    <!-- Post Comment Button -->
                                                                    <button type="submit" class="btn btn-primary btn-sm align-self-start d-flex flex-column align-items-center">
                                                                        <i class="bi bi-send mt-1"></i> 
                                                                    </button>
                                                                </div>
                                                            </form>
                                                
                                                            <!-- Display Comments -->
                                                            <div class="mt-3" @if($event->comments->count() > 5) style="max-height: 250px; overflow-y: auto; padding-right: 8px;" @endif>
                                                                @if($event->comments->isEmpty())
                                                                    <p class="text-muted text-center">No comments yet. Be the first to comment!</p>
                                                                @else
                                                                    @foreach($event->comments->whereNull('parent_id') as $comment)
                                                                        <div class="d-flex align-items-start mb-3" id="comment-{{ $comment->id }}">
                                                                            <!-- User Profile Picture -->
                                                                            <img src="{{ asset('storage/profile-picture/images/' . $comment->user->profile_picture) }}" alt="User Avatar" class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
                                                                            
                                                                            <!-- Comment Box -->
                                                                            <div class="flex-grow-1 bg-light p-3 rounded">
                                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                                    <strong class="text-dark">{{ $comment->user->firstname }} {{ $comment->user->lastname }}</strong>
                                                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                                                </div>
                                                                                <p class="mb-0 text-muted" style="word-wrap: break-word;">{{ $comment->comment }}</p>
                                
                                                                                <!-- Reply Button (toggle reply form) -->
                                                                                <button class="btn btn-link btn-sm mt-2" data-bs-toggle="collapse" data-bs-target="#reply-form-{{ $comment->id }}" aria-expanded="false" aria-controls="reply-form-{{ $comment->id }}">
                                                                                    Reply
                                                                                </button>
                                
                                                                                <!-- Reply Form (visible when Reply button is clicked) -->
                                                                                <div class="collapse" id="reply-form-{{ $comment->id }}">
                                                                                    <form action="{{ route('feedback.events.comment', $event->id) }}" method="POST" class="mt-3">
                                                                                        @csrf
                                                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                                        <textarea name="comment" class="form-control" rows="2" placeholder="Write your reply..." style="resize: none;"></textarea>
                                                                                        <button type="submit" class="btn btn-primary btn-sm mt-2">Post Reply</button>
                                                                                    </form>
                                                                                </div>
                                
                                                                                <!-- Display Replies for this specific comment -->
                                                                                <div class="mt-3" id="replies-{{ $comment->id }}">
                                                                                    @if($comment->replies->isNotEmpty())
                                                                                        @foreach($comment->replies as $reply)
                                                                                            <div class="d-flex align-items-start mb-3">
                                                                                                <!-- User Profile Picture -->
                                                                                                <img src="{{ asset('storage/profile-picture/images/' . $reply->user->profile_picture) }}" alt="User Avatar" class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
                                                                                                
                                                                                                <!-- Reply Box -->
                                                                                                <div class="flex-grow-1 bg-light p-3 rounded">
                                                                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                                                                        <strong class="text-dark">{{ $reply->user->firstname }} {{ $reply->user->lastname }}</strong>
                                                                                                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                                                                    </div>
                                                                                                    <p class="mb-0 text-muted" style="word-wrap: break-word;">{{ $reply->comment }}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Card Body -->
                                                </div>
                                                <!-- End of Event Card -->
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                

                                @if($all_events->count() > 0)
                                    <div class="d-flex flex-stack flex-wrap pt-10 mb-5">
                                        <!-- Pagination Display Text -->
                                        <div class="fs-6 fw-semibold text-gray-700">
                                            Showing {{ $all_events->firstItem() }} to {{ $all_events->lastItem() }} of {{ $all_events->total() }} entries
                                        </div>

                                        <!-- Pagination Links -->
                                        <ul class="pagination">
                                            <!-- Previous Button -->
                                            @if ($all_events->onFirstPage())
                                                <li class="page-item disabled">
                                                    <a href="#" class="page-link">
                                                        <i class="previous"></i>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item previous">
                                                    <a href="{{ $all_events->previousPageUrl() }}" class="page-link">
                                                        <i class="previous"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            <!-- Page Numbers -->
                                            @for ($i = 1; $i <= $all_events->lastPage(); $i++)
                                                <li class="page-item {{ $i == $all_events->currentPage() ? 'active' : '' }}">
                                                    <a href="{{ $all_events->url($i) }}" class="page-link">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            <!-- Next Button -->
                                            @if ($all_events->hasMorePages())
                                                <li class="page-item next">
                                                    <a href="{{ $all_events->nextPageUrl() }}" class="page-link">
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

    {{--Modal For Slider--}}
    @foreach ($monthly_highlight_events as $event)
        <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" aria-labelledby="modal{{ $loop->index }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <h1 class="modal-title" style="font-size: 24px; font-weight: bold; text-transform: uppercase">{{ $event->title }}</h1>
                        </div>
                        <div class="text-center mb-3">
                            <h2 class="fw-bold">{{ $event->venue }}</h2>
                        </div>
                        <div class="text-center mb-4">
                            <p>
                                {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                            </p>
                            <p class="">
                                {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/event/images/' . $event->picture) }}" class="img-fluid" alt="{{ $event->title }}">
                        </div>
                        <p  style="text-align: justify; text-indent: 25px; font-size: 16px;">{{ $event->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

 
    {{-- Modal For Suggest Event--}}
    <div class="modal fade" id="modal_suggest_event" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="close_header_btn">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y pt-0 pb-15">
                    <div class="mb-13">
                        <h1 class="text-center mb-5">Suggest Event</h1>
                        <form action="{{route('suggest-event.store')}}" method="POST" id="SuggestEvent"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Title
                                        <span class="label-span-danger">*</span></label>
                                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Title">
                                </div>
                                <span class="text-danger error-text title_error"></span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label"> Event Description
                                        <span class="label-span-danger">*</span></label>
                                    <textarea class="form-control form-control-solid"  name="description"  cols="20" rows="5" placeholder="Type here ..."></textarea>
                                </div>
                                <span class="text-danger error-text description_error"></span>
                            </div>
                            <div class="mt-4 float-end">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"  id="close_btn">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary" id="btn_submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @section('script')
    {{--AJAX--}}
    <script type="text/javascript">
        $(document).ready(function (){

            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
            //to store or insert it to the database
            $("#SuggestEvent").on('submit', function(e) {
                e.preventDefault();
                $("#btn_submit").html('Submitting <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
                $('#btn_submit').attr("disabled", true);
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data:  new FormData(form),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(response) {
                        if (response.status == 0) {
                            $('#btn_submit').removeAttr("disabled");

                            $.each(response.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });

                            $("#btn_submit").text('Submit');
                        } else {
                            $(form)[0].reset();
                            $('#btn_submit').removeAttr("disabled");
                            $('#btn_submit').text('Submit');
                            $("#modal_suggest_event").modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Event Suggestion Created Successfully!',
                                showConfirmButton: true,
                            });
                        }

                        $('#close_btn').on('click', function() {
                            $("#SuggestEvent").find('span.text-danger').text('');
                        });

                        $('#close_header_btn').on('click', function() {
                            $("#SuggestEvent").find('span.text-danger').text('');
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle any error that occurred during the request
                        console.error('Error:', error);
                        $('#btn_submit').removeAttr("disabled");
                        $("#btn_submit").text('Submit');
                    }
                });
            });
        });
    </script>



    @endsection

@endsection
