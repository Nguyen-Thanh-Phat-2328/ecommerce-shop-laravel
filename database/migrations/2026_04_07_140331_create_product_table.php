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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_brand');
            $table->text('detail');
            $table->unsignedBigInteger('id_user');
            $table->string('image')->nullable();
            $table->unsignedInteger('status')->default(0)->comment='1:sale 0:new';
            $table->integer('sale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
