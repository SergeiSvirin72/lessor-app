<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Estate
 *
 * @property int $id Идентификатор объекта недвижимости
 * @property string $name Наименование объекта недвижимости
 * @property string|null $info Информация об объекте
 * @property string|null $address Адрес объекта
 * @property string|null $longitude Долгота объекта
 * @property string|null $latitude Широта объекта
 * @property int|null $price_square_foot Цена за квадратный метр
 * @property int $status Статус недвижимости
 * @property int $team_id Идентификатор компании
 * @property string|null $mask Маска договоров
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Balance[] $balances
 * @property-read int|null $balances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Floor[] $floors
 * @property-read int|null $floors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|Estate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Estate newQuery()
 * @method static \Illuminate\Database\Query\Builder|Estate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Estate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereMask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate wherePriceSquareFoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Estate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Estate withoutTrashed()
 * @mixin \Eloquent
 */
class Estate extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'longitude', 'latitude', 'price_square_foot', 'status', 'mask', 'team_id', 'info', 'address'
    ];

    public function balances()
    {
        return $this->hasManyThrough('App\Models\Balance', 'App\Models\Room');
    }

    public function floors()
    {
        return $this->hasMany('App\Models\Floor');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function rooms()
    {
        return $this->hasManyThrough('App\Models\Room','App\Models\Floor');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /**
     * Scope a query to only include active estates.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
