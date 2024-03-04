<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use App\Models\Appointment;
use App\Models\BusinessHour;
use Illuminate\Http\Request;
use App\Services\AppointmentService;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    public function index()
    {
        $datePeriod = CarbonPeriod::create(now(), now()->addDays(6));

        $appointments = [];

        foreach($datePeriod as $date){
            $appointments [] = (new AppointmentService)->generateTimeData($date);
        }

        return view('appointments.reserve', compact('appointments'));
    }

    public function reserve(AppointmentRequest $request)
    {
        $data = $request->merge(['user_id' => auth()->id()])->toArray();
        $time = \Carbon\Carbon::createFromFormat('g:i A', $request->time);
        $data['time'] = $time->format('His');
        Appointment::create($data);

        return 'created';
    }
}
