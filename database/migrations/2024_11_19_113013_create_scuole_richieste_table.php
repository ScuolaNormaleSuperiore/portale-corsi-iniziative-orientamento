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
        Schema::create('scuole_richieste', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('scuola_id')->index();
            $table->foreign('scuola_id')->references('id')->on('scuole')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nome')->nullable();
            $table->string('cognome')->nullable();
            $table->string('telefono')->nullable();
            $table->text('note')->nullable();
            $table->string('password')->nullable();
            $table->boolean('approvata')->default(0);
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
        Schema::drop('scuole_richieste');
    }

};
