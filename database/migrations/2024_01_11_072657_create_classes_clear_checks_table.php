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
        Schema::create('classes_clear_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uses_id')->nullable('false');
            $table->unsignedBigInteger('class_id')->nullable('false');
            $table->tinyInteger('clear_flag')->nullable('false');
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
        Schema::dropIfExists('classes_clear_checks');
    }
};
