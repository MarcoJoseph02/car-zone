<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_id', 'part_name', 'maintenance_interval', 'next_reminder_date', 
        'next_reminder_km', 'reminder_type', 'notified'
    ];
    

     // 🔹 Static list of fixed maintenance intervals
     public static function getFixedIntervals()
     {
         return [
             'Oil Filter' => 3, // 3 months
             'Brake Pads' => 12, // 12 months
             'Tires' => 6, // 6 months
             'Air Filter' => 6, // 6 months
             'Battery' => 12, // 12 months
         ];
     }
 
     // 🔹 Automatically assign the correct interval based on the part name
     public static function getIntervalForPart($part_name)
     {
         $intervals = self::getFixedIntervals();
         return $intervals[$part_name] ?? 6; // Default: 6 months
     }
}
