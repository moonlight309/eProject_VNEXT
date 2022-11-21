<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('makers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name');
            $table->text('logo')->nullable();
            $table->string('address')->nullable();
            $table->longText('description')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('created_user')->nullable();
            $table->string('updated_user')->nullable();
            $table->string('deleted_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('makers');
    }
};
