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
        Schema::create('sezioni_contenuti', function (Blueprint $table) {
            $table->id();
            $table->string('nome_it');
            $table->text('contenuto_it')->nullable();
            $table->string('slug_it')->nullable();
            $table->integer('ordine')->unsigned();

            $table->nullableMorphs('sezionable');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sezioni_contenuti');
    }

};
