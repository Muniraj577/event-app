<?php

namespace App\Models;

use App\Enum\EventStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'is_completed'
    ];

    public function scopeFilters($query, $filter=null): object
    {
        return $query->when($filter, function($q, $value){
            $q->when($value==EventStatus::FinishedEvents, function ($q){
               $q->whereDate('end_date', '<', Carbon::now());
            })->when($value == EventStatus::UpcomingEvents, function ($q){
                $q->whereDate('start_date', '>', Carbon::now());
            })->when($value == EventStatus::UpcomingEventWithin7Days, function ($q) {
                $q->whereDate('start_date', '>', Carbon::now())
                    ->whereDate('start_date', '<', Carbon::now()->addDays(7));
//                $q->whereBetween(DB::raw('CAST(start_date as datetime)'), [Carbon::now()->addDay(), Carbon::now()->addDays(7)]);
            })->when($value == EventStatus::FinishedEventsOfLast7Days, function ($q){
                $q->whereDate('end_date', '<', Carbon::now())
                    ->whereDate('end_date', '>', Carbon::now()->subDays(7));
            });
        });
    }
}
