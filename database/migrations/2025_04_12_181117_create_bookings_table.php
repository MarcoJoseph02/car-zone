<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('bookings', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('car_id')->constrained()->onDelete('cascade');
        //     $table->decimal('deposit_amount', 10, 2)->nullable(); // 10% of car price
        //     $table->boolean('deposit_paid')->default(false);
        //     $table->timestamp('deposit_charged_at')->nullable();
        //     $table->boolean('refund_processed')->default(false);
        //     $table->timestamp('cancelled_at')->nullable();
        //     $table->decimal('refund_amount', 10, 2)->nullable(); // 8% refund
        //     $table->unique(['car_id', 'status'])->where('status', 'active');
        //     $table->timestamps();
        // });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            
            // Payment Fields
            $table->decimal('deposit_amount', 10, 2);
            $table->string('payment_intent_id')->nullable();
            $table->boolean('deposit_paid')->default(false);
            $table->timestamp('deposit_charged_at')->nullable();
            
            // Status Tracking
            $table->string('status')->default('pending_payment');
            $table->timestamp('cancelled_at')->nullable();
            
            // Refund Handling
            $table->boolean('refund_processed')->default(false);
            $table->decimal('refund_amount', 10, 2)->nullable();
            
            // Maintenance
            $table->timestamp('maintenance_reminder')->nullable();
            $table->string('maintenance_type')->nullable();
            
            // Booking Period
            $table->timestamp('starts_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('ends_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->unique(['car_id', 'status'])->where('status', 'active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
