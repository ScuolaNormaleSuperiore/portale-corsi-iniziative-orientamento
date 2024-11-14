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
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('titolo_it')->unique();
            $table->mediumText('descrizione_it')->nullable();
            $table->enum('tipo', ['youtube', 'vimeo'])->nullable();
            $table->string('video_id');
            $table->boolean('attivo')->default(1);
            $table->integer('ordine')->unsigned()->default(0);
            $table->boolean('homepage')->default(0);
            $table->string('slug_it')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable()->index();
            $table->foreign('categoria_id')->references('id')->on('categorie_video')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('video');
    }

};
