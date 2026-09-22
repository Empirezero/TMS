<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceStation extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function servicerequest()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
