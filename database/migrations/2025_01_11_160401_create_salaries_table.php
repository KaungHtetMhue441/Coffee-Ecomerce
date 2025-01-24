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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string(column: 'description');
            $table->decimal('amount', 10, 2);
            $table->timestamp(column: 'incurred_at')->nullable();
            $table->timestamps();
            // Add foreign key constraint
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade'); // Delete salaries if the employee is deleted
            $table->index(columns: 'incurred_at');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
