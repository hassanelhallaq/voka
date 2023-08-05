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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lounge_id');
            $table->foreign('lounge_id')->on('lounges')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('qr')->nullable();
            $table->enum('status', ['available', 'in_service', 'reserved', 'late']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
