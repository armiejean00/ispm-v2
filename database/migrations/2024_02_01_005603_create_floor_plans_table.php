<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('floor_plans', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            // ... other table columns
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('floor_plans');
    }

    /**
     * Reverse the migrations.
     */
   
};
