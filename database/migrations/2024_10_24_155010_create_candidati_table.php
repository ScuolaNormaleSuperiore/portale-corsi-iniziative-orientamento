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
        Schema::create('candidati', function (Blueprint $table) {
            $table->id();
            $table->integer('anno')->unsigned()->index();
            $table->unsignedBigInteger('iniziativa_id')->unsigned()->index();
            $table->string('nome');
            $table->string('cognome');
            $table->string('codice_fiscale')->nullable();
            $table->string('emails')->nullable();
            $table->string('sesso')->nullable();
            $table->string('luogo_nascita')->nullable();
            $table->date('data_nascita')->nullable();
            $table->string('indirizzo')->nullable();
            $table->string('comune')->nullable();
            $table->string('cap', 5)->nullable();
            $table->unsignedBigInteger('provincia_id')->nullable()->index();
            $table->foreign('provincia_id')->references('id')->on('province')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('regione_id')->nullable()->index();
            $table->foreign('regione_id')->references('id')->on('regioni')->onDelete('restrict')->onUpdate('cascade');
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('scuola_id')->nullable()->index();
            $table->foreign('scuola_id')->references('id')->on('scuole')->onDelete('restrict')->onUpdate('cascade');
            $table->string('scuola_estera')->nullable();
            $table->string('classe')->nullable();
            $table->string('sezione')->nullable();
            $table->unsignedBigInteger('gen1_titolo_studio_id')->nullable()->index();
            $table->foreign('gen1_titolo_studio_id')->references('id')->on('titoli_studio')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('gen2_titolo_studio_id')->nullable()->index();
            $table->foreign('gen2_titolo_studio_id')->references('id')->on('titoli_studio')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('gen1_professione_id')->nullable()->index();
            $table->foreign('gen1_professione_id')->references('id')->on('professioni')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('gen2_professione_id')->nullable()->index();
            $table->foreign('gen2_professione_id')->references('id')->on('professioni')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gen1_professione_altro')->nullable();
            $table->string('gen2_professione_altro')->nullable();
            $table->text('note')->nullable();

            $table->string('olimpiadi_matematica')->nullable()->default(null);
            $table->string('olimpiadi_fisica')->nullable()->default(null);

            $table->text('partecipazione_concorsi')->nullable();
            $table->unsignedBigInteger('inglese_livello_linguistico_id')->nullable()->index();
            $table->foreign('inglese_livello_linguistico_id')->references('id')->on('livelli_linguistici')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('francese_livello_linguistico_id')->nullable()->index();
            $table->foreign('francese_livello_linguistico_id')->references('id')->on('livelli_linguistici')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('tedesco_livello_linguistico_id')->nullable()->index();
            $table->foreign('tedesco_livello_linguistico_id')->references('id')->on('livelli_linguistici')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('spagnolo_livello_linguistico_id')->nullable()->index();
            $table->foreign('spagnolo_livello_linguistico_id')->references('id')->on('livelli_linguistici')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('cinese_livello_linguistico_id')->nullable()->index();
            $table->foreign('cinese_livello_linguistico_id')->references('id')->on('livelli_linguistici')->onDelete('cascade')->onUpdate('cascade');
            $table->string('altre_competenze_linguistiche')->nullable();
            $table->mediumText('profilo')->nullable();
            $table->text('esperienze_estere')->nullable();
            $table->text('settore_professionale')->nullable();
            $table->text('materie_preferite')->nullable();
            $table->text('motivazioni')->nullable();
            $table->unsignedBigInteger('modalita_conoscenza_sns_id')->nullable()->index();
            $table->foreign('modalita_conoscenza_sns_id')->references('id')->on('modalita_conoscenza_sns')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('informativa');
            $table->decimal('media', 4, 2)->nullable();
            $table->string('tipo')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('info')->nullable();

            $table->date('data_candidatura')->nullable();
            $table->string('status')->nullable();
            $table->longText('status_history')->nullable();

            $table->string('albergo')->nullable();
            $table->boolean('conferma')->default(0);
            $table->boolean('pagamento')->default(0);

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
        Schema::drop('candidati');
    }

};
