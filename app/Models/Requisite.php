<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Requisite
 *
 * @property int $id Идентификатор реквизитов
 * @property string $name Наименование
 * @property string $inn ИНН
 * @property string $bik БИК
 * @property string $account Номер счета
 * @property int $team_id Идентификатор компании
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bill[] $bills
 * @property-read int|null $acts_count
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite newQuery()
 * @method static \Illuminate\Database\Query\Builder|Requisite onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereBik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Requisite withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Requisite withoutTrashed()
 * @mixin \Eloquent
 */
class Requisite extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'account', 'inn', 'bik', 'team_id'
    ];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Bill');
    }
}
