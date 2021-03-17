<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Floor
 *
 * @property int $id
 * @property int $estate_id Идентификатор объекта недвижимости
 * @property string $name Наименование плана
 * @property string $img Путь к изображению плана
 * @property int|null $price_square_foot Цена за квадратный метр
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Estate $estate
 * @property-read string $image_url
 * @property-read int|null $price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $rooms
 * @property-read int|null $rooms_count
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Floor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereEstateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor wherePriceSquareFoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Floor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Floor withoutTrashed()
 * @mixin \Eloquent
 */
class Floor extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estate_id', 'name', 'img', 'price_square_foot'
    ];

    public function estate()
    {
        return $this->belongsTo('App\Models\Estate');
    }

    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

    /**
     * Get the floor's price.
     *
     * @return int|null
     */
    public function getPriceAttribute()
    {
        return $this->price_square_foot
            ?: $this->estate->price_square_foot;
    }

    /**
     * Get floor image's path.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return isset($this->attributes['img']) ? Storage::url($this->attributes['img']) : null;
    }
}
