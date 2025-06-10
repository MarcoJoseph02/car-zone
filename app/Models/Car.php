<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
https://www.postman.com/workspace/CarZone-isa-Workspace~bb0078a2-ad39-4487-81ce-025f7ef46657/request/39813466-ed93c62e-ba6a-4866-8aaa-6093b2f76ac1
class Car extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images'); // Or remove singleFile() for multiple images
    }
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
     public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function booking_user()
    {
        return $this->hasOne(Booking::class, 'car_id')->where('status', 'Booked');
    }
}
