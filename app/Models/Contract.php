<?php

namespace App\Models;

use App\Exports\Exportable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Contract
 *
 * @property int $id Идентификатор договора
 * @property string $number Номер договора
 * @property int $tenant_id Идентификатор арендатора
 * @property string $date_start Начало срока действия договора
 * @property string $date_end Окончание срока действия договора
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bill[] $bills
 * @property-read int|null $acts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContractRoom[] $contractRooms
 * @property-read int|null $contract_rooms_count
 * @property-read \App\Models\Tenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Query\Builder|Contract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Contract withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Contract withoutTrashed()
 * @mixin \Eloquent
 */
class Contract extends Model implements Exportable
{
    use SoftDeletes, HasFactory;

    const STORAGE_PATH = 'public/contracts/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id', 'number', 'date_start', 'date_end', 'security_payment'
    ];

    public function tenants()
    {
        return $this->belongsToMany('App\Models\Tenant');
    }

    public function contractRooms()
    {
        return $this->hasMany('App\Models\ContractRoom');
    }

    public function contractTenants()
    {
        return $this->hasMany('App\Models\ContractTenant');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    public function export($template)
    {
        return 'Export';
    }

    /**
     * Scope a query to only include active contracts.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where([
            ['date_start', $this->date_start <= Carbon::today()],
            ['date_end', $this->date_end >= Carbon::today()]
        ]);
    }

    /**
     * Scope a query to only include debtor contracts.
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
