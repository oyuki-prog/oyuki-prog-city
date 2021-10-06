<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->unsignedTinyInteger('prefecture_id');
            $table->foreign('prefecture_id')
                ->references('id')->on('prefectures')
                ->onDelete('restrict');
            $table->string('city_name');
            $table->unsignedTinyInteger('category_id');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('restrict');
            $table->text('body');
            $table->string('bg_img_path')->nullable();
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('articles_prefecture_id_foreign');
            $table->dropForeign('articles_category_id_foreign');
            $table->dropForeign('articles_user_id_foreign');
            $table->dropIfExists('articles');
        });
    }
}
