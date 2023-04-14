<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->json('alias')->nullable();
            $table->integer('status')->default(0);
            $table->integer('min_players');
            $table->integer('max_players');
            $table->integer('duration')->nullable();
            $table->text('goal')->nullable();
            $table->text('setup')->nullable();
            $table->text('gameplay')->nullable();
            $table->text('end')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
};
