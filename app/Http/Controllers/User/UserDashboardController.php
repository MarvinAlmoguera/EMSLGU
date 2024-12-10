<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index(){

        $monthly_highlight_events = Event::where('monthly_highlight', true)
                                         ->where('status', 'Approved')->get();
        $all_events = Event::where('status', 'Approved')
                            ->whereDate('date', '>=', Carbon::today())
                            ->paginate(6);

        return view('User.Dashboard.index',compact('monthly_highlight_events','all_events'));
    }
}
