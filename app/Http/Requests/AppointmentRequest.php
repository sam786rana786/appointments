<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\BusinessHour;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->isValid();
    }

    public function rules()
    {
        return [
            'date' => ['required','date_format:Y-m-d'],
            'time' => ['required','date_format:g:i A']
        ];
    }

    private function isValid()
    {
        $dayName = $this->date('date')->format('l');
        $businessHours = BusinessHour::where('day',$dayName)->first()->TimesPeriod;

        if (!in_array($this->input('time'),$businessHours)) {
            abort(422, 'invalid time');
        }

        $isAlreadyExists = Appointment::where('date', $this->input('date'))->where('time', $this->input('time'))->exists();

        if ($isAlreadyExists){
            abort(422, 'already taken');
        }
    }
}
