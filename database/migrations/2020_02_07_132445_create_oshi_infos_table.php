<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOshiInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oshi_infos', function (Blueprint $table) {
            $table->bigIncrements('id'); //推しID
            $table->string('name'); //推しの名前
            $table->string('belong_team')->nullable(); //推しの所属チーム
            $table->tinyInteger('sex')->default(1)->comment('0=男, 1=女, 2=その他'); //推しの性別
            $table->date('birthday')->nullable();  //推しの誕生日
            $table->date('start_recomend_at')->nullable();  //推し始めた日付
            $table->string('color')->nullable();  //推し担当カラー
            $table->string('image')->nullable(); 
            $table->tinyInteger('status')->default(1)->comment('0=下書き, 1=アクティブ, 2=削除済み');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oshi_infos');
    }
}
