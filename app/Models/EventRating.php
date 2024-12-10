<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRating extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'rating'];

    // A rating belongs to an event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // A rating belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
