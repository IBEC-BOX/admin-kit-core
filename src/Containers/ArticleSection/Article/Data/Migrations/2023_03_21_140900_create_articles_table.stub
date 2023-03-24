<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->boolean('pinned')->default(0)->index();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('article_id');
            $table->unique(['article_id', 'locale']);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            // fields to translate
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('short_content')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_translations');
        Schema::dropIfExists('articles');
    }
};
