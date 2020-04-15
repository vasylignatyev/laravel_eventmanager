<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'start_date', 'options', 'address', 'latitude', 'longitude'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
    
    public function trainer() {
        return $this->belongsTo(Trainer::class);
    }
}
