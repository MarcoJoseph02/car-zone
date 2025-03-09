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
        'description',
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
