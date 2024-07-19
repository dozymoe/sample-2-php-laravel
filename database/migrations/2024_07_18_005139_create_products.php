<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->index();
            $table->string('code', 100);
            $table->string('name', 250)->index();
            $table->text('description')->nullable();
            $table->integer('stock')->index()->default('0');
            $table->decimal('price', 11, 2)->index()->default('0');
            $table->string('image_path', 250)->nullable();
            $table->text('image_alt')->nullable();
            $table->string('image_mimetype', 100)->nullable();

            $table->unique(['code']);
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
