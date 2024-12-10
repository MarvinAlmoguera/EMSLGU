<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table ='events';
    protected $fillable = [

        'user_id',
        'title',
        'picture',
        'description',
        'date',
        'start_time',
        'end_time',
        'venue',
        'monthly_highlight',
        'status',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

      //additional
    public function comments()
    {
        return $this->hasMany(EventComment::class);
    }

    // An event has many ratings
    public function ratings()
    {
        return $this->hasMany(EventRating::class);
    }

    // To get the average rating for the event
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
