<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id'); // Link to the car
            $table->string('part_name'); // e.g., "Oil Filter"
            $table->integer('maintenance_interval')->default(6); // Interval in months (Default: 6 months)
            $table->date('next_reminder_date')->nullable();
            $table->integer('next_reminder_km')->nullable(); // If usage-based
            $table->enum('reminder_type', ['time', 'usage', 'condition']);
            $table->boolean('notified')->default(false); // Track if notification was sent
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminders');
    }
};
