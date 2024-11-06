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
        Schema::create('candidati_voti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidato_id')->index();
            $table->foreign('candidato_id')->references('id')->on('candidati')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('materia_id')->index();
            $table->foreign('materia_id')->references('id')->on('materie')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('voto_anno_2', 3, 1)->default(0);
            $table->decimal('voto_anno_1', 3, 1)->default(0);
            $table->decimal('voto_primo_quadrimestre', 3, 1)->default(0);
            $table->nullableTimestamps();
            $table->nullableOwnerships();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('candidati_voti');
    }

};
