<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('directories', function (Blueprint $table) {
            $table->id();

            // directories fields
            $table->string('slug')->unique();
            $table->jsonb('properties')->default('{}');

            // nested sets
            $table->nestedSet();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('directory_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('directory_id');
            $table->unique(['directory_id', 'locale']);
            $table->foreign('directory_id')->references('id')->on('directories')->onDelete('cascade');

            // fields to translate
            $table->string('name')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('directory_translations');
        Schema::dropIfExists('directories');
    }
};
