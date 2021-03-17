<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Balance
 *
 * @property int $id
 * @property int $tenant_id Идентификатор арендатора
 * @property int $type Тип платежа: дебит, кредит
 * @property int $amount Сумма платежа
 * @property int|null $act_id Идентификатор акта
 * @property int $status Статус платежа
 * @property string|null $comment Комментарий к платежу
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bill|null $act
 * @property-read \App\Models\Tenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Balance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance newQuery()
 * @method static \Illuminate\Database\Query\Builder|Balance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereActId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Balance withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Balance withoutTrashed()
 * @mixin \Eloquent
 */
class Balance extends Model
{
    use SoftDeletes, HasFactory;

    const STATUS_DONE = 1;
    const STATUS_CANCELLED = 2;

    const TYPE_DEBIT = 1;
    const TYPE_CREDIT = 2;

    protected $attributes = [
        'type' => self::TYPE_DEBIT,
        'status' => self::STATUS_DONE,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id', 'amount', 'comment', 'status', 'bill_id', 'type'
    ];

    public function tenant()
    {
        return $this->belongsTo('App\Models\Tenant');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }
}
