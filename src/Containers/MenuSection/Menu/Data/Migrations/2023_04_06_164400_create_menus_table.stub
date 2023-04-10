<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            // menus fields
            $table->string('slug')->unique();
            $table->string('url')->nullable();
            $table->boolean('url_in_new_window')->default(0);
            $table->boolean('is_active')->default(0)->index();

            // nested sets
            $table->nestedSet();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('menu_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('menu_id');
            $table->unique(['menu_id', 'locale']);
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            // fields to translate
            $table->string('title')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_translations');
        Schema::dropIfExists('menus');
    }
};
