<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer('review_id');
            $table->foreignId('user_id');
            $table->integer('restaurant_id');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->timestamp('date_created')->nullable();
            $table->index(['user_id'], 'fk_user_reviews');
            $table->index(['restaurant_id'], 'fk_restaurant_reviews');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
