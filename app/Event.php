<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'short_desc', 'full_desc', 'options', 'duration'
    ];

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
