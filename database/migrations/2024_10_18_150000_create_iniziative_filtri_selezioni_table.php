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
        Schema::create('iniziative_filtri_selezioni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iniziativa_id')->index();
            $table->foreign('iniziativa_id')->references('id')->on('iniziative')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('filtro_id')->index();
            $table->foreign('filtro_id')->references('id')->on('filtri_selezioni')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iniziative_filtri_selezioni');
    }

};
