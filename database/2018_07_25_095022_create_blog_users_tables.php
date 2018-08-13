<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config()->get('blog.database.connection'))->create('users', function ($table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('picture')->nullable();
            $table->text('biography')->nullable();
            $table->string('lang')->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->string('password');
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
        Schema::connection(config()->get('blog.database.connection'))->dropIfExists('users');
    }
}
