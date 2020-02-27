<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'client'])->default('client');
            $table->string('password');
            $table->boolean('activity')->default(true)->nullable();
            $table->binary('photo')->nullable();
            $table->timestamp('deleted_at')->nullable();

//            $table->rememberToken();
//            $table->timestamp('email_verified_at')->nullable();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
