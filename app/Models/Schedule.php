<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function trainer()
    {
        return $this->belongsToMany('\App\Mdeles\Trainer');
    }

}
