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
        Schema::create('candidati_corsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidato_id')->index();
            $table->foreign('candidato_id')->references('id')->on('candidati')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('corso_id')->index();
            $table->foreign('corso_id')->references('id')->on('corsi')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('ordine')->unsigned()->default(0);
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
        Schema::drop('candidati_corsi');
    }

};
