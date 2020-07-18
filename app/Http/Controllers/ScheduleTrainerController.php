<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\Trainer;
use Illuminate\Validation\ValidationData;

class ScheduleTrainerController extends Controller
{
    public function detach(Request $request)
    {
        $validatedData = $request->validate([
            'trainer_id' => 'required|integer',
            'schedule_id' => 'required|integer',
        ]);
        $schedule = Schedule::find($validatedData['schedule_id']);
   
        $schedule->trainers()->wherePivot('trainer_id', '=', $validatedData['trainer_id'])->detach();
        return true;
    }

    public function attach(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required|max:128',
            'trainer_id' => 'required|integer',
            'schedule_id' => 'required|integer',
        ]);
        
        $role = $validatedData['role'];
        $trainer_id = $validatedData['trainer_id'];
        $schedule_id = $validatedData['schedule_id'];

        $schedule = Schedule::find($schedule_id);
        $schedule->trainers()->sync([$trainer_id => ['role' => $role]]);

        return response(['status' => 'success']);

    }
}
