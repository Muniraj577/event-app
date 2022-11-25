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
        $events = Event::query();
        $events = $events->orderBy('start_date', 'asc') //DB::raw('CAST(start_date as date)')
            ->paginate(20);
        return EventResource::collection($events)
            ->response()
            ->setStatusCode(200);
    }

    public function store(EventRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $event = Event::create($request->all());
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Event created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong',
                'success' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)->firstOrFail();
        return (new EventResource($event))
            ->response()
            ->setStatusCode(200);
    }

    public function update(EventRequest $request, Event $event): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $event->update($data);
            DB::commit();
            return response()->json([
                'message' => 'Event updated successfully',
                'success' => true,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something Went Wrong',
                'success' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Event $event): JsonResponse
    {
        try {
            DB::beginTransaction();
            $event->delete();
            DB::commit();
            return response()->json([
                'message' => 'Event deleted !!!',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong',
                'success' => false,
            ]);
        }
    }
}
