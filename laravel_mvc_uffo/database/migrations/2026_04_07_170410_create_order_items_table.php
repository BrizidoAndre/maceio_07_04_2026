<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('order_item_id');
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->integer('quantity');
            $table->decimal('price');
            $table->decimal('subtotal');
            $table->index(['order_id'], 'fk_order_items');
            $table->index(['product_id'], 'fk_product_items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
