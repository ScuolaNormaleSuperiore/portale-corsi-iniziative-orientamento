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
        Schema::create('eventi', function (Blueprint $table) {
            $table->id();
            $table->date('data')->nullable();
            $table->string('orario')->nullable();
            $table->string('titolo_it')->unique();
            $table->string('sottotitolo_it')->nullable();
            $table->string('slug_it')->nullable();
            $table->date('data_fine')->nullable();
            $table->string('luogo')->nullable();
            $table->boolean('attivo')->default(1);
            $table->integer('evidenza')->unsigned()->nullable();
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
        Schema::drop('eventi');
    }

};
