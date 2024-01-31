<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');//インクリメント
            $table->string('name');//名前
            $table->string('name_kana');//カナ
            $table->string('email')->unique();//メールアドレス
            $table->string('password');//パスワード
            $table->string('profile_image');//プロフィール画像
            $table->integer('now_class');//クラスID
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
        Schema::dropIfExists('users');
    }
};
