<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('game_equipment', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->index();
            $table->unsignedBigInteger('equipment_id')->index();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->primary(['game_id', 'equipment_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_equipment');
    }
};
