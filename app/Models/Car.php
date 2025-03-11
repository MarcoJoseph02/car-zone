<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'branch_id',
        'category_id',
        'brand_id',
        'model',//CLA200
        'year',
        'price',
        'is_sold',
        'is_booked',
        'user_id',
        'doors',
        'acceleration',//0-100 in 3 seconds
        'top_speed',
        'fuel_efficiency',//5L/100KM
        'color',
        'engine_type',//petrol
        'engine_power',//100NM
        'engine_cylinder',//4
        'engine_cubic_capacity_type',//cc
        'transmission',//manual
        'features',//sensores camera 360
        'performance',
        'safety',
    ];

    /**
     * Relationships
     */

     public function supplier()
     {
         return $this->belongsTo(Supplier::class);
     }
 
     // Category relationship
     public function category()
     {
         return $this->belongsTo(Category::class);
     }
 
     // Brand relationship
     public function brand()
     {
         return $this->belongsTo(Brand::class);
     }

     public function branch()
     {
         return $this->belongsTo(Branch::class);
     }
}
