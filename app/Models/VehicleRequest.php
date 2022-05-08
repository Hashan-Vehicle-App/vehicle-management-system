<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id', 'pickup_location_id', 'deliver_location_id', 'pickup_date', 'cost', 'status'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function deliverLocation()
    {
        return $this->belongsTo(Location::class, 'deliver_location_id');
    }
}
