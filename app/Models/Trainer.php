<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strlen($value) > 0 ? $value : null;
        return $this;
    }

    public function setSecondNameAttribute($value)
    {
        $this->attributes['second_name'] = strlen($value) > 0 ? $value : null;
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strlen($value) > 0 ? $value : null;
    }

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = strlen($value) > 0 ? $value : null;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strlen($value) > 0 ? $value : null;
    }

    public function schedules()
    {
        return $this->belongsToMany('\App\Models\Schedule')
            ->using('\App\Models\ScheduleTrainer')
            ->withPivot(['role']);
    }

    public function __toString() {
        return(json_encode($this->attributesToArray()));
    }
}
