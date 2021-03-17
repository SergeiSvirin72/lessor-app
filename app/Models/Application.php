<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'date', 'room_id', 'status'
    ];

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    /**
     * Scope a query to only include not handled applications.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeNotHandled($query)
    {
        return $query->where('status', true);
    }
}
