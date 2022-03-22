<?php

namespace App\Models;

use App\Models\VehicleCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_no',
        'category_id',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class);
    }
}
