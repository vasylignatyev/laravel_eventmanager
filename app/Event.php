<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'title', 'short_desc', 'full_desc', 'options', 'duration'
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
