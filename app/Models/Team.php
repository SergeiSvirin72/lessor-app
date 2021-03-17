<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name Наименование компании
 * @property string $alias Поддомен компании
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Estate[] $estates
 * @property-read int|null $estates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Floor[] $floors
 * @property-read int|null $floors_count
 * @property-read mixed $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invite[] $invites
 * @property-read int|null $invites_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Requisite[] $requisites
 * @property-read int|null $requisites_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Statement[] $statements
 * @property-read int|null $statements_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TeamUser[] $teamUser
 * @property-read int|null $team_user_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenant[] $tenants
 * @property-read int|null $tenants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Query\Builder|Team onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Team withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Team withoutTrashed()
 * @mixin \Eloquent
 */
class Team extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'document_full_name', 'document_short_name', 'document_signature'
    ];

    public function templates()
    {
        return $this->hasMany('App\Models\Template');
    }

    public function teamUser()
    {
        return $this->hasMany('App\Models\TeamUser');
    }

    public function estates()
    {
        return $this->hasMany('App\Models\Estate');
    }

    public function floors()
    {
        return $this->hasManyThrough('App\Models\Floor','App\Models\Estate');
    }

    public function invites()
    {
        return $this->hasMany('App\Models\Invite');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'team_user')->withPivot('role');
    }

    public function requisites()
    {
        return $this->hasMany('App\Models\Requisite');
    }

    public function tenants()
    {
        return $this->hasMany('App\Models\Tenant');
    }

    public function contracts()
    {
        return $this->hasManyThrough('App\Models\Contract','App\Models\Tenant');
    }

    public function statements()
    {
        return $this->hasMany('App\Models\Statement');
    }

    /**
     * Get team's owner.
     *
     * @return mixed
     */
    public function getOwnerAttribute()
    {
        return $this->users()->wherePivot('role', 1)->first();
    }

    /**
     * Get team's URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return env('APP_PROTOCOL').'://' . $this->alias . '.' .env('APP_HOST');
    }

    /**
     * Get team's public URL.
     *
     * @return string
     */
    public function getPublicUrl()
    {
        return 'http://' . $this->alias . '.public.' .env('APP_HOST');
    }
}
