<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->foreignId('node_id');
            $table->foreignId('next_node_id')->nullable();
            $table->string('code_object')->nullable();
            $table->string('code_inventory')->nullable();
            $table->string('answer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('responses');
    }
};
