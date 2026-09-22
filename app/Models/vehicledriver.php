<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehicledriver extends Model
{
    //
    protected $fillable = [
        'vehicle_id',
        'user_id',
        'assigned_at',
        'unassigned_at'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
