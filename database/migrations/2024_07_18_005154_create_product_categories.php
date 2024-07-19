<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code', 100);
            $table->string('name', 250)->index();
            $table->text('description')->nullable();

            $table->unique(['code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
