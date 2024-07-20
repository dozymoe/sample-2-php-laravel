<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quantity')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('product_category_id')->index();
            $table->unsignedBigInteger('buyer_id')->index();
            $table->unsignedBigInteger('seller_id')->index();

            $table->string('product_name', 250)->index()->nullable();
            $table->integer('product_stock')->index()->nullable();
            $table->decimal('product_price', 11, 2)->index()->nullable();
            $table->string('category_name', 250)->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('seller_name')->nullable();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('product_category_id')
                ->references('id')
                ->on('product_categories')
                ->onDelete('cascade');
            $table->foreign('buyer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('seller_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
