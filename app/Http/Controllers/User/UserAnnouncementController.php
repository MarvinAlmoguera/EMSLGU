<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class UserAnnouncementController extends Controller
{
    public function index()
    {
        $all_announcements = Announcement::paginate(9);
        return view('User.Announcement.index',compact('all_announcements'));
    }
}
