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
        Schema::create('datafiles', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('datafile_id');
            $table->text('datafile_sheet')->nullable();
            $table->string('datafile_type')->nullable();
            $table->text('data')->nullable();
            $table->nullableTimestamps();
            $table->nullableOwnerships();
            $table->unique(['datafile_id', 'datafile_type']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datafiles');
    }

};
