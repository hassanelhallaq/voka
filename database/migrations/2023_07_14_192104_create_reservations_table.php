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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id');
            $table->foreign('table_id')->on('tables')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->date('date');
            $table->string('time');
            $table->string('note')->nullable();
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
