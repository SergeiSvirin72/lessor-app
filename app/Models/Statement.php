<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Statement
 *
 * @property int $id
 * @property int $team_id Идентификатор компании
 * @property string $date Дата проводки
 * @property string $debet_account Счет дебет
 * @property string $credit_account Счет кредит
 * @property float|null $debet_amount Сумма по дебету
 * @property float|null $credit_amount Сумма по кредиту
 * @property int $document_number Номер документа
 * @property int $vo ВО
 * @property string $bank Банк
 * @property string $purpose Назначение платежа
 * @property int $status Статус назначения выписки
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder|Statement newModelQuery()
 * @method static Builder|Statement newQuery()
 * @method static Builder|Statement notActive()
 * @method static \Illuminate\Database\Query\Builder|Statement onlyTrashed()
 * @method static Builder|Statement query()
 * @method static Builder|Statement whereBank($value)
 * @method static Builder|Statement whereCreatedAt($value)
 * @method static Builder|Statement whereCreditAccount($value)
 * @method static Builder|Statement whereCreditAmount($value)
 * @method static Builder|Statement whereDate($value)
 * @method static Builder|Statement whereDebetAccount($value)
 * @method static Builder|Statement whereDebetAmount($value)
 * @method static Builder|Statement whereDeletedAt($value)
 * @method static Builder|Statement whereDocumentNumber($value)
 * @method static Builder|Statement whereId($value)
 * @method static Builder|Statement wherePurpose($value)
 * @method static Builder|Statement whereStatus($value)
 * @method static Builder|Statement whereTeamId($value)
 * @method static Builder|Statement whereUpdatedAt($value)
 * @method static Builder|Statement whereVo($value)
 * @method static \Illuminate\Database\Query\Builder|Statement withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Statement withoutTrashed()
 * @mixin \Eloquent
 */
class Statement extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id', 'date', 'debet_account', 'credit_account', 'amount', 'document_number', 'vo', 'bank', 'purpose', 'status',
    ];

    /**
     * Scope a query to only include not active statements.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeNotActive($query)
    {
        return $query->where('status', false);
    }
}
