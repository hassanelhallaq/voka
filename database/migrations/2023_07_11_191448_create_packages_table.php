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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->foreignId('branch_id');
            $table->foreign('branch_id')->on('branches');
            $table->foreignId('table_id');
            $table->foreign('table_id')->on('tables')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('price');
            $table->integer('time');
            $table->enum('status', ['ACTIVE', 'DEACTIVE'])->default('ACTIVE');
            $table->integer('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
