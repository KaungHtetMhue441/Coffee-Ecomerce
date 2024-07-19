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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string("admin_id");
            $table->string("customer")->nullable();
            $table->string("total_cost")->nullable();
            $table->string("payment_type")->nullable();
            $table->string("status")->default("incomplete")->comment("incomplete,coomplete");
            $table->timestamps();
        });
        Schema::create('product_sale', function (Blueprint $table) {
            $table->bigInteger("sale_id");
            $table->bigInteger("product_id");
            $table->integer("quantity");
            $table->integer("price");
            $table->string("status")->default("incomplete")->comment("incomplete,coomplete");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
