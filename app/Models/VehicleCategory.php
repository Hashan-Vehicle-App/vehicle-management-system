<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'category_id');
    }

    public function hasActiveVehicles()
    {
        return $this->hasMany(Vehicle::class, 'id')->where('status', 'available');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($vehicleCategory) { // before delete() method call this
            $vehicleCategory->vehicles()->each(function ($vehicle) {
                $vehicle->delete(); // <-- direct deletion
            });
        });
    }
}
