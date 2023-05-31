<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $owner_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static EventFactory factory($count = null, $state = [])
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereDescription($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event whereOwnerId($value)
 * @method static Builder|Event whereTitle($value)
 * @method static Builder|Event whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'owner_id'
    ];

    /**
     * Relation to User entity
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'owner_id');
    }

    /**
     * Relation to User entity (many to many)
     * @return BelongsToMany
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_events');
    }
}
