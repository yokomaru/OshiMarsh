<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOshiSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::create('oshi_schedules', function (Blueprint $table) {
            $table->bigIncrements('id'); //スケジュールID
            $table->string('title'); //スケジュールタイトル
            $table->string('memo')->nullable(); //スケジュールメモ
            $table->date('day');  //スケジュール日
            $table->time('start_time_at')->nullable();  //開始時間
            $table->time('end_time_at')->nullable();  //終了時間
            $table->bigInteger('user_id')->unsigned();//カラム追加
            $table->bigInteger('oshi_id')->unsigned();//カラム追加
            $table->tinyInteger('status')->default(1)->comment('0=下書き, 1=アクティブ, 2=削除済み');
            $table->foreign('oshi_id')->references('id')->on('oshi_infos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('oshi_schedules');
    }
}
