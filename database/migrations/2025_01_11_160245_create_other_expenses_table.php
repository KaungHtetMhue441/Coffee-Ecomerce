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
        Schema::create('other_expenses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('description')->nullable();
            $table->decimal("price", 10, 2);
            $table->timestamp("incurred_at");
            $table->timestamps();
            $table->index(columns: 'incurred_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_expenses');
    }
};
