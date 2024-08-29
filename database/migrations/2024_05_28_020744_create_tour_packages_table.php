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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            // $table->unsignedBigInteger('hotel_id');
            // $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            // $table->string('name');
            // $table->string('room');
            // $table->integer('capacity')->default(0);
            // $table->integer('duration')->default(0);
            // $table->decimal('price_hotel', 15, 2);
            // $table->decimal('price_package', 15, 2);
            // $table->decimal('price_subtotal', 15, 2);
            // $table->decimal('price_total', 15, 2);
            // $table->integer('discount')->default(0);
            // $table->text('facility');
            // $table->text('description');
            $table->string('package_name');
            $table->integer('capacity')->default(0);
            $table->integer('duration')->default(0);
            $table->decimal('price_hotel', 15, 2);
            $table->decimal('price_tour', 15, 2);
            $table->decimal('price_total', 15, 2);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
