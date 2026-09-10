<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('category_id');
            $table->string('name');
            $table->unique(['name'], 'name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
