<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\DeleteEventException;
use App\Exceptions\HasEventAuthorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends Controller
{
    private EventService $eventService;

    /**
     * @param EventService $eventService
     */
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return EventResource::collection($this->eventService->index());
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws HasEventAuthorException
     */
    public function addToEvent(int $id): JsonResponse
    {
        return $this->eventService->addToEvent($id);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function removeFormEvent(int $id): JsonResponse
    {
        return $this->eventService->removeFromEvent($id);
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(EventRequest $request): EventResource
    {
        return new EventResource($this->eventService->create($request));
    }

    /**
     * Remove the specified resource from storage.
     * @throws DeleteEventException
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->eventService->delete($id);
    }
}
