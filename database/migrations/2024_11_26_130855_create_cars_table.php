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
            $table->float('price');
            $table->text('description');
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
