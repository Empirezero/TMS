<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    //
    protected $fillable = [
        'request_date',
        'reference_no',
        'reg_no',
        'make',
        'model',
        'engine_cc',
        'fuel_type',
        'previous_km',
        'current_km',
        'assigned_driver',
        'service_station',
        'service_type',
        'service_type_other',
        'description',
        'vehicle_drivable',
        'warning_lights',
        'body_damage',
        'fluid_leaks',
        'tyre_condition',
        'driver_name',
        'driver_id',
        'driver_signature',
        'driver_date',
        //Transport officer fields
        'inspection_findings',
        'status',
        'approved_by',
        'approver_signature',
        'approved_at',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    protected $casts = [
        'approved_at' => 'datetime',
    ];
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
