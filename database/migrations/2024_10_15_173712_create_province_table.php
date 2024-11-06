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
        Schema::create('province', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('sigla', 2)->unique();
            $table->string('codice', 3)->nullable()->unique();
            $table->boolean('attivo')->default(1);
            $table->unsignedBigInteger('regione_id')->index();
            $table->foreign('regione_id')->references('id')->on('regioni')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('province');
    }

};
