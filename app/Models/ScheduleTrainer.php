<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ScheduleTrainer extends Pivot
{
    protected $fillable = ['role',];
    protected $table = 'schedule_trainer';
    public $incrementing = true;

}
