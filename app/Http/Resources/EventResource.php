<?php

namespace App\Http\Resources;

use App\Http\Requests\EventRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Collection $participants
 * @property int $owner_id
 */
class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(EventRequest|Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'owner_id' => $this->owner_id,
            'participants' => UserResource::collection($this->participants)
        ];
    }
}
