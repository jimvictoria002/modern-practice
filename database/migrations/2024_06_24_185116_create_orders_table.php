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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers'); // Foreign key for customers table
            $table->foreignId('drink_id')->constrained('drinks'); // Foreign key for drinks table
            $table->integer('quantity')->unsigned();
            $table->decimal('total', 10, 2); // Assuming total is a decimal value with 10 digits in total and 2 decimal places
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
