<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'inspected_by',
        'inspection_date',
        'expiry_date',
        'certificate_number',
        'status',
        'expiry_notified_at',
        'certificate_file',
        'notes',
    ];

    protected $casts = [
        'inspection_date' => 'date',
        'expiry_date' => 'date',
        'expiry_notified_at' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }

    public function getEffectiveStatusAttribute(): string
    {
        if ($this->status === 'valid' && $this->expiry_date->isPast()) {
            return 'expired';
        }

        return $this->status;
    }
}
