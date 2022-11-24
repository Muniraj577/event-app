<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function store(EventRequest $request)
    {
        try{
            DB::beginTransaction();
            $event = Event::create($request->all());
            DB::commit();
            return response()->json([
               'success' => true,
               'message' => 'Event created successfully',
            ]);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json([
               'message' => 'Something went wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
