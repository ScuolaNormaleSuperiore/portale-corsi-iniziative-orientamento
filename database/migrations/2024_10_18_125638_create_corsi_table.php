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
        Schema::create('corsi', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->text('descrizione')->nullable();
            $table->date('data_inizio')->nullable();
            $table->date('data_fine')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('iniziativa_id')->index();
            $table->foreign('iniziativa_id')->references('id')->on('iniziative')->onDelete('cascade')->onUpdate('cascade');
            $table->string('luogo')->nullable();
            $table->string('indirizzo')->nullable();
            $table->unsignedBigInteger('provincia_id')->nullable()->index();
            $table->foreign('provincia_id')->references('id')->on('province')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::drop('corsi');
    }

};
