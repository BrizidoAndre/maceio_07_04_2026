<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->integer('promocode_id');
            $table->foreignId('restaurant_id');
            $table->string('code');
            $table->decimal('discount');
            $table->integer('max_uses');
            $table->integer('current_uses')->nullable();
            $table->timestamp('expires_at');
            $table->index(['restaurant_id'], 'fk_restaurant_promocodes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promocodes');
    }
};
