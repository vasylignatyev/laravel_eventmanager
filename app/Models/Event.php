<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'short_desc', 'full_desc', 'options', 'duration'
    ];
    private $duration;
    private $title;
    private $short_desc;
    private $full_desc;

    public function getDurationAttribute()
    {
        return bin2hex($this->attributes['duration']);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

    public function __toString() {
        return( json_encode($this->attributesToArray()) );
        //return( "Hello, World" );
    }
}
