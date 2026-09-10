<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->string('username');
            $table->string('password_hash');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('registration_date')->nullable();
            $table->unique(['email'], 'email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
