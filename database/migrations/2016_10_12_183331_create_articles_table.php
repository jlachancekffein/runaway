<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['draft', 'approved']);
            $table->string('section');
            $table->date('publication_date')->nullable();
            $table->timestamps();

            $table->index(['status', 'section', 'publication_date']);
        });

        Schema::create('article_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->string('locale');

            $table->string('title');
            $table->text('description');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->string('seo_slug');
            $table->string('image');
            $table->text('content');

            $table->unique(['article_id', 'locale']);
            $table->unique(['seo_slug', 'locale']);

            $table->index(['article_id', 'locale', 'seo_slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
        Schema::drop('article_translations');
    }
}
