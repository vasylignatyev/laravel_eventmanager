<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['start_date','address','latitude','longitude','event_id','trainer_id'];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function trainers()
    {
        return $this->belongsToMany('\App\Models\Trainer')
            ->using('\App\Models\ScheduleTrainer')
            ->withPivot(['role']);
    }

/*    public function schedule_trainer()
    {
        return $this->belongsToMany('\App\Models\ScheduleTrainer');
    }*/



}
