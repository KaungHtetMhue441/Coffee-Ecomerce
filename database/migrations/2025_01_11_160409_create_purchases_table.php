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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string("supplier");
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Price per item
            $table->timestamp(column: 'purchased_at')->nullable(); // Timestamp of purchase
            $table->timestamps();
            $table->index('purchased_at');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
