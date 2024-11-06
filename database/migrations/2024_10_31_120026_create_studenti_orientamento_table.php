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
        Schema::create('studenti_orientamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materia_id')->index();
            $table->foreign('materia_id')->references('id')->on('materie_orientamento')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nome');
            $table->string('cognome');
            $table->text('descrizione_it')->nullable();
            $table->string('link')->nullable();
            $table->boolean('attivo')->default(1);
            $table->nullableTimestamps();
            $table->nullableOwnerships();

        });
    }

    /**Mater
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('studenti_orientamento');
    }

};
