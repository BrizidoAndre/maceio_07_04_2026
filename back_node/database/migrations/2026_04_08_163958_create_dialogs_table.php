<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dialogs', function (Blueprint $table) {
            $table->string('id')->primary()->unique();
            $table->foreignId('node_id');
            $table->foreignId('tag_id');
            $table->text('notes');
            $table->string('protagonist_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dialogs');
    }
};
