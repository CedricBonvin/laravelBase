<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('game_situation', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->index();
            $table->unsignedBigInteger('situation_id')->index();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('situation_id')->references('id')->on('situations')->onDelete('cascade');
            $table->primary(['game_id', 'situation_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_situation');
    }
};
