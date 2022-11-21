<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->primary(['category_id', 'product_id']);
            $table->unique(['category_id', 'product_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_product');
    }
};
