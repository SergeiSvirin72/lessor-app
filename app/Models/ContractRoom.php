<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ContractRoom
 *
 * @property int $id
 * @property int $room_id Идентификатор помещения
 * @property int $price_square_foot Цена помещения за квадратный метр
 * @property string $moved_at Когда арендатор заехал в помещение
 * @property string $pay_start Дата начала расчетного периода
 * @property string|null $paid_till До какого числа оплачена аренда
 * @property int $contract_id Идентификатор договора
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read int $months_delay
 * @property-read int|null $price
 * @property-read \App\Models\Room $room
 * @method static Builder|ContractRoom expiring()
 * @method static Builder|ContractRoom newModelQuery()
 * @method static Builder|ContractRoom newQuery()
 * @method static \Illuminate\Database\Query\Builder|ContractRoom onlyTrashed()
 * @method static Builder|ContractRoom query()
 * @method static Builder|ContractRoom whereContractId($value)
 * @method static Builder|ContractRoom whereCreatedAt($value)
 * @method static Builder|ContractRoom whereDeletedAt($value)
 * @method static Builder|ContractRoom whereId($value)
 * @method static Builder|ContractRoom whereMovedAt($value)
 * @method static Builder|ContractRoom wherePaidTill($value)
 * @method static Builder|ContractRoom wherePayStart($value)
 * @method static Builder|ContractRoom wherePriceSquareFoot($value)
 * @method static Builder|ContractRoom whereRoomId($value)
 * @method static Builder|ContractRoom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ContractRoom withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ContractRoom withoutTrashed()
 * @mixin \Eloquent
 */
class ContractRoom extends Model
{
    const BILL_TIME = 3;

    use SoftDeletes, HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contract_room';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paid_till', 'room_id', 'moved_at', 'pay_start', 'contract_id', 'price_square_foot'
    ];

    public function contract()
    {
        return $this->BelongsTo('App\Models\Contract');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    /**
     * Get the room's price.
     *
     * @return int|null
     */
    public function getPriceAttribute()
    {
        return $this->price_square_foot
            ?: $this->room->price_square_foot
                ?: $this->room->floor->price_square_foot
                    ?: $this->room->floor->estate->price_square_foot;
    }

    /**
     * Scope a query to only include expired contractRooms.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeExpiring($query)
    {
        return $query->where('paid_till', '<=', Carbon::now()->addDays(self::BILL_TIME));
    }

    /**
     * Get the contractRoom's months delay.
     *
     * @return int
     */
    public function getMonthsDelayAttribute()
    {
        $billTime = Carbon::now()->addDays(self::BILL_TIME);
        return $billTime->diffInMonths(Carbon::parse($this->paid_till)) + 1;
    }
}
