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
            $table->integer("user_id");
            $table->integer("total_amount")->nullable();
            $table->string("status")->comment("submit,resubmit,reject,processing,delivered,completed")->nullable();
            $table->timestamps();
        });
        
        Schema::create("order_product", function (Blueprint $table) {
            $table->integer("order_id");
            $table->integer("product_id");
            $table->integer("quantity");
            $table->integer("price");
            $table->string("status")->default("approved")->comment("approved:,cancel");
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
