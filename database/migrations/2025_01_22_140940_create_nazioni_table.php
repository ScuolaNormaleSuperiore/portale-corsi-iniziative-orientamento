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
        Schema::create('nazioni', function (Blueprint $table) {
            $table->id();
            $table->string('codice_istat', 3)->unique();
            $table->string('codice_catastale', 4)->nullable()->unique();
            $table->string('codice_iso_2', 2)->nullable()->unique();
            $table->string('codice_iso_3', 3)->nullable()->unique();
            $table->string('nome')->nullable();
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
        Schema::drop('nazioni');
    }

};
