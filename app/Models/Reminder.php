<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'for_me',
        'car_id',
        'part_name',
        'maintenance_interval',
        'next_reminder_date',
        'notified' //0-1
    ];


    // 🔹 Static list of fixed maintenance intervals
    public static function getFixedIntervals()
{
    return [
        'for_me' => [
            'interval' => 1, // 1 hour
            'unit' => 'minute' // Specify the unit as 'hour'
        ],
        'Oil Filter' => [
            'interval' => 3, // 3 months
            'unit' => 'month' // Specify the unit as 'month'
        ],
        'Brake Pads' => [
            'interval' => 12, // 12 months
            'unit' => 'month' // Specify the unit as 'month'
        ],
        'Tires' => [
            'interval' => 6, // 6 months
            'unit' => 'month' // Specify the unit as 'month'
        ],
        'Air Filter' => [
            'interval' => 6, // 6 months
            'unit' => 'month' // Specify the unit as 'month'
        ],
        'Battery' => [
            'interval' => 12, // 12 months
            'unit' => 'month' // Specify the unit as 'month'
        ],
    ];
}


    // 🔹 Automatically assign the correct interval based on the part name
    public static function getIntervalForPart($part_name)
    {
        $intervals = self::getFixedIntervals();
        return $intervals[$part_name] ?? 6; // Default: 6 months
    }
}
