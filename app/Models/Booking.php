<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'car_id',
        'deposit_amount',
        'payment_intent_id',
        'deposit_paid',
        'deposit_charged_at',
        'status',
        'cancelled_at',
        'refund_processed',
        'refund_amount',
        'maintenance_reminder',
        'maintenance_type',
        'starts_at',
        'ends_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
