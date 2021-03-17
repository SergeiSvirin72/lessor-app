<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Act extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id', 'amount', 'path'
    ];

    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    /**
     * Get act document's path.
     *
     * @return string
     */
    public function getDocumentUrlAttribute()
    {
        return isset($this->attributes['path']) ? Storage::url($this->attributes['path']) : null;
    }
}
