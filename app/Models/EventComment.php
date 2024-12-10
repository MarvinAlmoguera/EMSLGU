<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'comment', 'parent_id'];

    // A comment belongs to an event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // A comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A comment may have a reply (self-referencing relationship)
    public function replies()
    {
        return $this->hasMany(EventComment::class, 'parent_id');
    }

    // A comment may be a reply to another comment     
    public function parent()
    {
        return $this->belongsTo(EventComment::class, 'parent_id');
    }
}
