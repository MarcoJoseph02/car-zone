<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'category_id',
        'brand_id',
        'model',
        'year',
        'price',
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
}
