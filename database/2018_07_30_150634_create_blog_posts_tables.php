<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config()->get('blog.database.connection'))->create('posts', function ($table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();

            $table->timestamps();
        });


        Schema::connection(config()->get('blog.database.connection'))->create('post_translations', function ($table) {
            $table->increments('id');

            $table->integer('post_id')->unsigned();
            $table->string('lang')->index();

            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->longText('quill_content')->nullable();

            $table->boolean('isFeatured')->default(false);
            $table->boolean('isIndexed')->default(false);

            $table->text('hyperlink')->nullable();
            $table->text('excerpt')->nullable();

            $table->json('seo')->nullable();

            $table->boolean('isPublished')->default(false);
            $table->datetime('published_at')->nullable();

            $table->unique(['post_id', 'lang']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

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
        Schema::connection(config()->get('blog.database.connection'))->dropIfExists('post_translations');
        Schema::connection(config()->get('blog.database.connection'))->dropIfExists('posts');
    }
}
