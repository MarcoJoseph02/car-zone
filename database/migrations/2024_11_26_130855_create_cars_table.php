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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained("suppliers");
            $table->foreignId('category_id')->constrained("categories");
            $table->foreignId('brand_id')->constrained("brands");
            $table->foreignId('branch_id')->constrained("branches");
            $table->string('model');
            // $table->string('image')->nullable();
            $table->integer('year');
            $table->integer('user_id')->nullable();
            $table->boolean('is_sold')->default(0);
            $table->boolean('is_booked')->default(0);
            $table->float('price');
            $table->integer('doors');
            $table->float('acceleration');
            $table->float('top_speed');
            $table->float('fuel_efficiency');
            $table->string('color');
            $table->string('engine_type');
            $table->float('engine_power');
            $table->float('engine_cylinder');
            $table->integer('engine_cubic_capacity_type');
            $table->string('transmission');

            $table->text('features');
            $table->text('performance');
            $table->text('safety');
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
        Schema::dropIfExists('cars');
    }
};
