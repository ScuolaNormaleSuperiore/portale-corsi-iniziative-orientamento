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
        Schema::create('comuni', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('codice_istat');
            $table->string('codice_catastale');
            $table->unsignedBigInteger('provincia_id')->nullable()->index();
            $table->foreign('provincia_id')->references('id')->on('province')->onDelete('restrict')->onUpdate('cascade');
            $table->string('sigla_provincia', 2)->nullable();
            $table->unsignedBigInteger('regione_id')->nullable()->index();
            $table->foreign('regione_id')->references('id')->on('regioni')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('nazione_id')->nullable()->index();
            $table->foreign('nazione_id')->references('id')->on('nazioni')->onDelete('restrict')->onUpdate('cascade');
            $table->string('cap', 6)->nullable();
            $table->string('prefisso', 6)->nullable();
            $table->boolean('attivo')->default(1);

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
        Schema::drop('comuni');
    }

};
