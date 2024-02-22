<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('selling_price', 10, 2)->nullable(false);
            $table->text('description');
            $table->string('slug');
            $table->string('measurement');
            $table->string('location');
            $table->string('number_of_bedrooms');
            $table->string('all_rooms');
            $table->string('number_of_kitchen');
            $table->string('number_of_bathrooms');
            $table->string('reviews');
            $table->text('image');
            $table->boolean('status');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
