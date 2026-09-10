<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('product_id');
            $table->foreignId('restaurant_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->string('photo');
            $table->index(['restaurant_id'], 'fk_restaurant_products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
