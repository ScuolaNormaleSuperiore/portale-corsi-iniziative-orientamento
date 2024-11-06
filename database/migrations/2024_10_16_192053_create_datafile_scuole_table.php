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
        Schema::create('datafile_scuole', function (Blueprint $table) {
            $table->id();

            $table->integer('row')->unsigned()->nullable();
            $table->string('datafile_sheet')->nullable();
            $table->integer('datafile_id')->unsigned()->nullable();

            $table->string('ANNOSCOLASTICO')->nullable();
            $table->string('AREAGEOGRAFICA')->nullable();
            $table->string('REGIONE')->nullable();
            $table->string('PROVINCIA')->nullable();
            $table->string('CODICEISTITUTORIFERIMENTO')->nullable();
            $table->string('DENOMINAZIONEISTITUTORIFERIMENTO')->nullable();
            $table->string('CODICESCUOLA')->nullable();
            $table->string('DENOMINAZIONESCUOLA')->nullable();
            $table->string('INDIRIZZOSCUOLA')->nullable();
            $table->string('CAPSCUOLA')->nullable();
            $table->string('CODICECOMUNESCUOLA')->nullable();
            $table->string('DESCRIZIONECOMUNE')->nullable();
            $table->string('DESCRIZIONECARATTERISTICASCUOLA')->nullable();
            $table->string('DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA')->nullable();
            $table->string('INDICAZIONESEDEDIRETTIVO')->nullable();
            $table->string('INDICAZIONESEDEOMNICOMPRENSIVO')->nullable();
            $table->string('INDIRIZZOEMAILSCUOLA')->nullable();
            $table->string('INDIRIZZOPECSCUOLA')->nullable();
            $table->string('SITOWEBSCUOLA')->nullable();
            $table->string('SEDESCOLASTICA')->nullable();

            $table->integer('regione_id')->nullable();
            $table->integer('provincia_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datafile_scuole');
    }

};
