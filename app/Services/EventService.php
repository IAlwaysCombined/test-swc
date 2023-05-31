<?php

namespace App\Services;

use App\Exceptions\DeleteEventException;
use App\Exceptions\HasEventAuthorException;
use App\Exceptions\IsParticipantException;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\UserEvent;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventService
{
    private Event $event;
    private UserEvent $userEvent;

    public function __construct(Event $event, UserEvent $userEvent)
    {
        $this->event = $event;
        $this->userEvent = $userEvent;
    }

    /**
     * @return array|Collection
     */
    public function index(): array|Collection
    {
        return $this->event::query()->get()->all();
    }

    /**
     * @param EventRequest $request
     * @return Event
     * @throws Exception
     */
    public function create(EventRequest $request): Event
    {
        $this->event->fill($request->all());
        $this->event->owner_id = auth()->user()->getAuthIdentifier();
        if (!$this->event->save()) {
            throw new Exception('Save new event = false');
        }

        return $this->event;
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws HasEventAuthorException
     * @throws IsParticipantException
     */
    public function addToEvent(int $id): JsonResponse
    {
        $event = $this->event::findOrFail($id);

        if (!$event) {
            throw new NotFoundHttpException('Event not found');
        }

        if ($event->owner_id === auth()->user()->getAuthIdentifier()) {
            throw new HasEventAuthorException();
        }

        $userEvent = $this->userEvent::query()->whereUserId(auth()->user()->getAuthIdentifier())->whereEventId($event->id)->first();

        if ($userEvent) {
            throw new IsParticipantException();
        }

        $this->userEvent->user_id = auth()->user()->getAuthIdentifier();
        $this->userEvent->event_id = $event->id;
        $this->userEvent->save();

        return response()->json(['message' => 'You have been added to the event']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function removeFromEvent(int $id): JsonResponse
    {
        $event = $this->event::findOrFail($id);
        if (!$event) {
            throw new NotFoundHttpException('Event not found');
        }

        $this->userEvent::query()->whereEventId($id)->delete();

        return response()->json(['message' => 'You have left the event']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws DeleteEventException
     */
    public function delete(int $id): JsonResponse
    {
        $event = $this->event::query()->findOrFail($id);
        if (!$event->owner_id === auth()->user()->getAuthIdentifier()) {
            throw new DeleteEventException();
        }
        $event->delete();
        return response()->json(['message' => 'Delete successful']);
    }
}
