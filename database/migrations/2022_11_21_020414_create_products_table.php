<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name');
            $table->text('image')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('price');
            $table->json('color')->nullable();
            $table->string('created_user')->nullable();
            $table->string('updated_user')->nullable();
            $table->string('deleted_user')->nullable();
            $table->foreignId('maker_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
