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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->enum('coupon_type', ['percent', 'value']);
            $table->integer('coupon_discount');
            $table->integer('count_use');
            $table->integer('customer_use');
            $table->tinyInteger('is_customer');
            $table->date('from');
            $table->date('to');
            $table->foreignId('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id');
            $table->foreign('product_id')->on('products')->references('product_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
