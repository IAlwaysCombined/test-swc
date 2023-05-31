<?php

namespace App\Models;

use Database\Factories\UserEventFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserEvent
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $event_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static UserEventFactory factory($count = null, $state = [])
 * @method static Builder|UserEvent newModelQuery()
 * @method static Builder|UserEvent newQuery()
 * @method static Builder|UserEvent query()
 * @method static Builder|UserEvent whereCreatedAt($value)
 * @method static Builder|UserEvent whereEventId($value)
 * @method static Builder|UserEvent whereId($value)
 * @method static Builder|UserEvent whereUpdatedAt($value)
 * @method static Builder|UserEvent whereUserId($value)
 * @mixin Eloquent
 */
class UserEvent extends Model
{
    use HasFactory;
}
