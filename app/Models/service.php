<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    //
    protected $fillable = [
        'reference_number',
        'vehicle_id',
        'service_date',
        'type',
        'notes',
        'cost'
    ];

    public function vehicle()
    {
        return $this->belongsTo(vehicle::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
