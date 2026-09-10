<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->integer('restaurant_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->integer('category_id');
            $table->string('login');
            $table->string('password_hash');
            $table->string('photo');
            $table->unique(['login'], 'login');
            $table->index(['category_id'], 'fk_category');
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
