<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned(); //外部キー設定するときは型に注意
            $table->bigInteger('address_id')->unsigned();
            $table->timestamps();

            // userが削除されたとき、それに関連するlikeも一気に削除される
            $table->foreign('user_id')
                ->references('id') //主テーブルのidを指定
                ->on('users') //主テーブルusersを指定
                ->onDelete('cascade'); 

            // addressが削除されたとき、それに関連するlikeも一気に削除される
            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
