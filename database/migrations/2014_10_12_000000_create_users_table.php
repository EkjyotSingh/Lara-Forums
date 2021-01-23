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
            $table->id();
            $table->string('name');
            $table->enum('role',['admin','writer'])->default('writer');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->integer('provider_id')->nullable();
            $table->boolean('discussion_status')->default(1);
            $table->boolean('reply_status')->default(1);
            $table->timestamp('last_discussion_at')->nullable();
            $table->timestamp('last_reply_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
