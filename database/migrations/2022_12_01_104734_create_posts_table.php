<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text("title")->nullable(false);
            $table->longText("content")->nullable(false);
            $table->text("short_content")->nullable(false);
            $table->json("category")->nullable(false);
            $table->text("featured_image")->nullable(true);
            $table->boolean("published")->default(false);
            $table->json("tags")->nullable(true);
            $table->text('slug')->nullable(false);
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
        Schema::dropIfExists('posts');
    }
};
