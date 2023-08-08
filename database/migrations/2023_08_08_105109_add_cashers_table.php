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
        Schema::create('cashers', function (Blueprint $table) {
            $table->id();
            $table->integer('cash');
            $table->integer('cash_found');
            $table->integer('expenses_sum');
            $table->string('status_cash');
            $table->integer('credit');
            $table->integer('credit_trans');
            $table->integer('credit_sum');
            $table->string('credit_status');
            $table->integer('online');
            $table->integer('online_trans');
            $table->integer('online_sum');
            $table->string('online_status');
            $table->integer('point');
            $table->integer('point_trans');
            $table->integer('point_sum');
            $table->string('point_status');
            $table->date('date');
            $table->string('shift_type');
            $table->string('remarks')->nullable();
            $table->foreignId('branch_id')
                ->constrained('branch_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashers');
    }
};
