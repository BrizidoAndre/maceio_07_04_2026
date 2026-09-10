<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('order_id');
            $table->foreignId('user_id');
            $table->foreignId('restaurant_id');
            $table->timestamp('order_date')->nullable();
            $table->decimal('total_amount');
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Cancelled']);
            $table->integer('promocode_id')->nullable();
            $table->index(['user_id'], 'fk_user_orders');
            $table->index(['restaurant_id'], 'fk_restaurant_orders');
            $table->index(['promocode_id'], 'fk_promocode_orders');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
