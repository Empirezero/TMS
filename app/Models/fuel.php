<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fuel extends Model
{
    //
    protected $fillable = [
        'vehicle_id',
        'user_id',
        'date',
        'liters',
        'cost',
        'station',
        'receipt'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
