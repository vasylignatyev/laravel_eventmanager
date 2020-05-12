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

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
/*    public function getDurationAttribute($value)
    {
        return bin2hex($this->attributes['duration']);
    }*/
}
