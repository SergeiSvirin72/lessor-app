<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes, HasFactory;

    const TYPE_WORD = 1;
    const TYPE_HTML = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'team_id', 'path'
    ];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }
}
