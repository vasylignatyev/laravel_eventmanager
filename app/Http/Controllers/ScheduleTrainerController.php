<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\Trainer;


class ScheduleTrainerController extends Controller
{
    public function detach(Schedule $schedule, Trainer $trainer)
    {
        $schedule->trainers()->wherePivot('trainer_id', '=', $trainer->id)->detach();
        return true;
    }
}
