<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $events = Event::orderBy(DB::raw('CAST(start_date as date)'), 'asc')
            ->paginate(5);
        return EventResource::collection($events)
            ->response()
            ->setStatusCode(200);
    }
}
