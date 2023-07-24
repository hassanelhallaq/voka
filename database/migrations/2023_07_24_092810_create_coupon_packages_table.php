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
        Schema::create('coupon_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')
                ->constrained('package_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('coupon_id')
                ->constrained('coupon_id')
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
        Schema::dropIfExists('coupon_packages');
    }
};
