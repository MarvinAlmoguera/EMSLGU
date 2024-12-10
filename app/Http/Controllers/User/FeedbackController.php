<?php
namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\EventRating;
use App\Models\EventComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function StoreComment(Request $request, Event $event)
    {
        $request->validate([
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:event_comments,id', // for replies
        ]);

        // If a parent_id is present, create a reply, otherwise create a regular comment
        EventComment::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'parent_id' => $request->parent_id, // Store the parent ID for replies
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    // Store a rating
    public function StoreRating(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        EventRating::updateOrCreate(
            ['event_id' => $event->id, 'user_id' => auth()->id()],
            ['rating' => $request->rating]
        );

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }
}
