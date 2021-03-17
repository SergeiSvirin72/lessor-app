<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Room
 *
 * @property int $id Идентификатор помещения
 * @property string $name Название помещения
 * @property int $size Размер помещения
 * @property int|null $price_square_foot Цена за квадратный метр
 * @property int $floor_id Идентификатор плана объекта недвижимости
 * @property int $type Тип помещения
 * @property string|null $coordinates Координаты помещения на плане объекта недвижимости
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Balance[] $balances
 * @property-read int|null $balances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContractRoom[] $contractRooms
 * @property-read int|null $contract_rooms_count
 * @property-read \App\Models\Floor $floor
 * @property-read int|null $price
 * @property-read int $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static Builder|Room belongsToTeam($team)
 * @method static Builder|Room newModelQuery()
 * @method static Builder|Room newQuery()
 * @method static \Illuminate\Database\Query\Builder|Room onlyTrashed()
 * @method static Builder|Room query()
 * @method static Builder|Room whereCoordinates($value)
 * @method static Builder|Room whereCreatedAt($value)
 * @method static Builder|Room whereDeletedAt($value)
 * @method static Builder|Room whereFloorId($value)
 * @method static Builder|Room whereId($value)
 * @method static Builder|Room whereName($value)
 * @method static Builder|Room wherePriceSquareFoot($value)
 * @method static Builder|Room whereSize($value)
 * @method static Builder|Room whereType($value)
 * @method static Builder|Room whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Room withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Room withoutTrashed()
 * @mixin \Eloquent
 */
class Room extends Model
{
    use SoftDeletes, HasFactory;

    const STATUS_FREE = 1;
    const STATUS_OCCUPIED = 2;
    const STATUS_DEBTED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'size', 'estate_id', 'price_square_foot', 'coordinates', 'floor_id', 'type'
    ];

    public function contractRooms()
    {
        return $this->hasMany('App\Models\ContractRoom');
    }

    public function balances()
    {
        return $this->hasMany('App\Models\Balance');
    }

    public function floor()
    {
        return $this->belongsTo('App\Models\Floor');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /**
     * Scope a query to only include rooms belonging to team.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeBelongsToTeam($query, $team)
    {
        return $query->whereHas('floor.estate', function (Builder $query) use ($team) {
            $query->where('team_id', $team->id);
        });
    }

    /**
     * Scope a query to only include free rooms.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeFree($query)
    {
        return $query->doesntHave('contractRooms');
    }

    /**
     * Scope a query to only include not free rooms.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeNotFree($query)
    {
        return $query->has('contractRooms');
    }

    /**
     * Get the room's price.
     *
     * @return int|null
     */
    public function getPriceAttribute()
    {
        return $this->price_square_foot
            ?: $this->floor->price_square_foot
            ?: $this->floor->estate->price_square_foot;
    }

    /**
     * Get the room's status.
     *
     * @return int
     */
    public function getStatusAttribute()
    {
        if ($this->contractRooms()->get()->isEmpty()) {
            return self::STATUS_FREE;
        }
        if ($this->contractRooms()->where('paid_till', '<', Carbon::now())->get()->isEmpty()) {
            return self::STATUS_OCCUPIED;
        }
        return self::STATUS_DEBTED;
    }
}
