<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessHour extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTimesPeriodAttribute()
    {
        $times = CarbonInterval::minutes($this->step)->toPeriod($this->from, $this->to)->toArray();

        return array_map(function($time)
        {
            if($this->day == today()->format('l') && !$time->isPast())
            {
                return $time->format('g:i A');
            }

            if($this->day != today()->format('l'))
            {
                return $time->format('g:i A');
            }
        }, $times);
    }
}
