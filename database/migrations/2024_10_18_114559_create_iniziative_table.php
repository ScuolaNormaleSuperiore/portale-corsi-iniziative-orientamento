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
        Schema::create('iniziative', function (Blueprint $table) {

            $table->id();
            $table->integer('anno')->unsigned();
            $table->string('titolo');
            $table->text('descrizione')->nullable();
            $table->date('data_apertura');
            $table->date('data_chiusura');
            $table->unsignedInteger('posti');
            $table->unsignedInteger('posti_onere');
            $table->text('note');
            $table->string('modalita_candidatura'); //scuole, singola, scuole_singola
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
        Schema::drop('iniziative');
    }

};
