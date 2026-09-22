<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehiclerequests extends Model
{
    //
    protected $fillable = [
        'requestor_id',
        'activity_name',
        'start_date',
        'end_date',
        'participants',
        'preferred_vehicle_id',
        'attachment',
        'days',
        'transport_mode',
        'vehicle_id',
        'driver_id',
        'assigned_by',
        'fare_cost',
        'work_ticket',
        'status'
    ];

    public function requestor()
    {
        return $this->belongsTo(User::class, 'requestor_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function refundedBy()
    {
        return $this->belongsTo(User::class, 'refunded_by');
    }
    public function preferredVehicle()
    {
        return $this->belongsTo(vehicle::class, 'preferred_vehicle_id');
    }
}
