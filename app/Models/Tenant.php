<?php

namespace App\Models;

use App\Gateways\BalanceGateway;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tenant
 *
 * @property int $id Идентификатор арендатора
 * @property int $team_id Идентификатор владельца недвижимости
 * @property int|null $security_payment Обеспечительный платеж арендатора
 * @property string $inn ИНН арендатора
 * @property string|null $kpp КПП арендатора
 * @property string|null $ogrn ОГРН арендатора
 * @property string|null $status Статус арендатора
 * @property string|null $full_name Полное наименование арендатора
 * @property string|null $short_name Краткое наименование арендатора
 * @property string|null $address Адрес арендатора
 * @property string|null $okpo ОКПО арендатора
 * @property string|null $okato ОКАТО арендатора
 * @property string|null $oktmo ОКТМО арендатора
 * @property string|null $okogu ОКОГУ арендатора
 * @property string|null $okfs ОКФС арендатора
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bill[] $bills
 * @property-read int|null $acts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Balance[] $balances
 * @property-read int|null $balances_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContractRoom[] $contractRooms
 * @property-read int $contract_rooms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contract[] $contracts
 * @property-read int|null $contracts_count
 * @property-read int $balance
 * @property-read int $debt
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newQuery()
 * @method static \Illuminate\Database\Query\Builder|Tenant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereKpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereOgrn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereOkato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereOkfs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereOkogu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereOkpo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereOktmo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereSecurityPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Tenant withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Tenant withoutTrashed()
 * @mixin \Eloquent
 */
class Tenant extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id', 'document_full_name', 'document_short_name',
        'inn', 'kpp', 'ogrn', 'status', 'full_name', 'short_name', 'address', 'okpo', 'okato', 'oktmo', 'okogu', 'okfs'
    ];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function balances()
    {
        return $this->hasMany('App\Models\Balance');
    }

    public function contact()
    {
        return $this->hasOne('App\Models\Contact');
    }

    public function contracts()
    {
        return $this->belongsToMany('App\Models\Contract');
    }

    public function services()
    {
        return $this->hasManyThrough('App\Models\Service','App\Models\Bill');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    /**
     * Get the tenants's contractRooms count.
     *
     * @return int
     */
    public function getContractRoomsCountAttribute()
    {
        return ContractRoom::whereHas('contract.contractTenants', function (Builder $query) {
            $query->where('tenant_id', $this->id);
        })->count();
    }

    /**
     * Get the tenants's balance.
     *
     * @return int
     */
    public function getBalanceAttribute()
    {
        $balanceGateway = new BalanceGateway();
        return $balanceGateway->countAmount($this->balances()->get());
    }

    /**
     * Get the tenants's debt.
     *
     * @return int
     */
    public function getDebtAttribute()
    {
        $amount = 0;
        $this->services()
            ->whereHas('bill', function (Builder $query) {
                $query->notPaid();
            })
            ->each(function($service) use (&$amount) {
                $amount += $service->amount;
            });
        return $amount;
    }

    /**
     * Get the tenants's contract's security payments sum.
     *
     * @return int
     */
    public function getSecurityPaymentAttribute()
    {
        return $this->contracts->sum('security_payment');
    }

    /**
     * Scope a query to only include debtor tenants.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeDebtor($query)
    {
        return $query->whereHas('bills', function (Builder $query) {
            $query->where('status', false);
        });
    }
}
