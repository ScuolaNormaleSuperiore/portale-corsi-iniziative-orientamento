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
        Schema::create('scuole', function (Blueprint $table) {
            $table->id();
            $table->integer('anno')->unsigned()->index();
            $table->string('area_geografica')->nullable();
            $table->unsignedBigInteger('regione_id')->index();
            $table->foreign('regione_id')->references('id')->on('regioni')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('provincia_id')->index();
            $table->foreign('provincia_id')->references('id')->on('province')->onDelete('restrict')->onUpdate('cascade');
            $table->string('codice_istituto_riferimento')->nullable();
            $table->string('denominazione_istituto_riferimento')->nullable();
            $table->string('codice')->nullable();
            $table->string('denominazione');
            $table->string('indirizzo')->nullable();
            $table->string('cap')->nullable();
            $table->string('catastale_comune')->nullable();
            $table->string('comune')->nullable();
            $table->string('caratteristica')->nullable();
            $table->string('tipologia_grado_istruzione')->nullable();
            $table->boolean('indicazione_sede_direttivo')->nullable();
            $table->string('indicazione_sede_omnicomprensivo')->nullable();
            $table->string('email')->nullable();
            $table->string('pec')->nullable();
            $table->string('web')->nullable();
            $table->boolean('sede_scolastica')->nullable();
            $table->string('email_riferimento')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->string('tipo')->nullable();
            $table->text('info')->nullable();
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
        Schema::drop('scuole');
    }

};
