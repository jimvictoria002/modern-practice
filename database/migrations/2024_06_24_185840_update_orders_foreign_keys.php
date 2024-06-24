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
        Schema::table('orders', function (Blueprint $table) {
             // Drop existing foreign keys (if any)
             $table->dropForeign(['customer_id']);
             $table->dropForeign(['drink_id']);
 
             // Add new foreign keys with ON UPDATE CASCADE and ON DELETE RESTRICT
             $table->foreign('customer_id')
                 ->references('id')->on('customers')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');
 
             $table->foreign('drink_id')
                 ->references('id')->on('drinks')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the foreign keys
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['drink_id']);

            // Re-add foreign keys without constraints (or specify your original constraints)
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('drink_id')->constrained('drinks');
        });
    }
};
