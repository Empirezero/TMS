<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    //
    protected $fillable = [
        'plate_number',
        'model',
        'make',
        'year',
        'passengers',
        'status'
    ];
    // app/Models/Vehicle.php

    public function serviceLogs()
    {
        return $this->hasMany(service::class);
    }

    public function assignments()
    {
        return $this->hasMany(vehicledriver::class);
    }

    public function fuelLogs()
    {
        return $this->hasMany(fuel::class);
    }

    public function services()
    {
        return $this->hasMany(service::class);
    }
    public function currentDriver()
    {

        return $this->hasOne(vehicledriver::class)
            ->whereNull('unassigned_at')
            ->latestOfMany('assigned_at')
            ->with('user');
        //return $this->belongsTo(User::class, 'driver_id');
    }
    public function currentAssignment()
    {
        return $this->hasOne(vehicledriver::class)
            ->whereNull('unassigned_at')
            ->latestOfMany('assigned_at')
            ->with('user');
    }

    public function getCurrentDriverAttribute()
    {
        return $this->currentAssignment?->user;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
