<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessHourRequest;
use App\Models\BusinessHour;
use Illuminate\Http\Request;

class BusinessHourController extends Controller
{
    public function index()
    {
        $businessHours = BusinessHour::all();
        return view('appointments.business_hours', compact('businessHours'));
    }

    public function update(BusinessHourRequest $request)
    {

       BusinessHour::query()->upsert($request->validated()['data'],['day']);

       return back();
    }
}
