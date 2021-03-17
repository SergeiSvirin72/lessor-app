<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id', 'name', 'measure', 'quantity', 'price'
    ];

    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    /**
     * Get the service's amount.
     *
     * @return float
     */
    public function getAmountAttribute()
    {
        return $this->price * $this->quantity;
    }
}
