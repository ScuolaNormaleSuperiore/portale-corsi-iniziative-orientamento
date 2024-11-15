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
        Schema::create('pagine', function (Blueprint $table) {
            $table->id();
            $table->string('titolo_it')->unique();
            $table->string('sottotitolo_it')->nullable();
            $table->integer('ordine')->unsigned()->nullable();
            $table->boolean('attivo')->default(1);
            $table->boolean('homepage')->default(0);
            $table->string('slug_it')->nullable();
            $table->enum('tipo',['standard','blade','orientamento'])->default('standard');
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
        Schema::drop('pagine');
    }

};
