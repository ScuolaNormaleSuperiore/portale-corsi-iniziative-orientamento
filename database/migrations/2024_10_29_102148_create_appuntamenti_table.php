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
        Schema::create('appuntamenti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settore_id')->nullable()->index();
            $table->foreign('settore_id')->references('id')->on('settori')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nome');
            $table->string('cognome');
            $table->text('descrizione')->nullable();
            $table->string('link')->nullable();
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
        Schema::drop('appuntamenti');
    }

};
