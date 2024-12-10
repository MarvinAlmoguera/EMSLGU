<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){

        $monthly_highlight_events = Event::where('monthly_highlight', true)
                                          ->where('status', 'Approved')->get();
        $all_events = Event::where('status', 'Approved')
                            ->whereDate('date', '>=', Carbon::today())
                            ->paginate(6);
        return view('Admin.Dashboard.index',compact('monthly_highlight_events','all_events'));
    }

    public function EventCalendar(){

        $events_data = Event::where('status', 'Approved')->get()->map(function($event) {
            $event->color = $event->monthly_highlight ? 'red' : 'blue'; // Example colors

            // Assuming `start_time` and `end_time` are in the format `H:i:s`
            $event->start_datetime = $event->date . 'T' . $event->start_time;
            $event->end_datetime = $event->date . 'T' . $event->end_time;

            return $event;
        });
        return view('Admin.Dashboard.event-calendar',compact('events_data'));
    }

}
