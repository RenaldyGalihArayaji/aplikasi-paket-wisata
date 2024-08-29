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
        Schema::create('order_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tourPackage_id');
            $table->foreign('tourPackage_id')->references('id')->on('tour_packages')->onDelete('cascade');
            $table->string('code_order');
            $table->integer('quantity_package');
            $table->date('order_date');
            $table->date('departure_date');
            $table->string('image')->nullable();
            $table->string('account_owner')->nullable();
            $table->string('bank_name')->nullable();
            $table->enum('payment_status', ['unpaid', 'process', 'paid'])->default('unpaid');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_packages');
    }
};
