<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Bill
 *
 * @property int $id
 * @property int $contract_id Идентификатор договора
 * @property int $price Сумма к оплате
 * @property string|null $comment Комментарий к оплате
 * @property int|null $requisite_id Идентификатор реквизитов
 * @property int $status Статус акта
 * @property int $type Тип акта
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Balance[] $balances
 * @property-read int|null $balances_count
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\Requisite|null $requisite
 * @method static Builder|Bill auto()
 * @method static Builder|Bill newModelQuery()
 * @method static Builder|Bill newQuery()
 * @method static Builder|Bill notPaid()
 * @method static \Illuminate\Database\Query\Builder|Bill onlyTrashed()
 * @method static Builder|Bill query()
 * @method static Builder|Bill whereComment($value)
 * @method static Builder|Bill whereContractId($value)
 * @method static Builder|Bill whereCreatedAt($value)
 * @method static Builder|Bill whereDeletedAt($value)
 * @method static Builder|Bill whereId($value)
 * @method static Builder|Bill wherePrice($value)
 * @method static Builder|Bill whereRequisiteId($value)
 * @method static Builder|Bill whereStatus($value)
 * @method static Builder|Bill whereType($value)
 * @method static Builder|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Bill withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Bill withoutTrashed()
 * @mixin \Eloquent
 */
class Bill extends Model
{
    use SoftDeletes, HasFactory;

    const TYPE_AUTO = 1;
    const TYPE_MANUALLY = 2;

    protected $attributes = [
        'type' => self::TYPE_MANUALLY,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contract_id', 'requisite_id', 'status', 'type', 'tenant_id', 'number'
    ];

    public function contract()
    {
        return $this->belongsTo('App\Models\Contract');
    }

    public function tenant()
    {
        return $this->belongsTo('App\Models\Tenant');
    }

    public function requisite()
    {
        return $this->belongsTo('App\Models\Requisite');
    }

    public function balances()
    {
        return $this->hasMany('App\Models\Balance');
    }

    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    public function act()
    {
        return $this->hasOne('App\Models\Act');
    }

    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    /**
     * Scope a query to only include not paid bills.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeAuto($query)
    {
        return $query->where('type', self::TYPE_AUTO);
    }

    /**
     * Scope a query to only include bills created automatically.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeNotPaid($query)
    {
        return $query->where('status', false);
    }

    /**
     * Scope a query to only include bills belonging user's active team.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeBelongingTeam($query)
    {
        return $query->whereHas('tenant', function (Builder $query) {
            $query->where('team_id', Auth::user()->team_id);
        });
    }

    /**
     * Is act auto-created.
     *
     * @return bool
     */
    public function isTypeAuto()
    {
        return $this->type == self::TYPE_AUTO;
    }

    /**
     * Get the bill's amount.
     *
     * @return float
     */
    public function getAmountAttribute()
    {
        $amount = 0;
        $this->services()->each(function($service) use (&$amount) {
            $amount += $service->amount;
        });
        return $amount;
    }
}
