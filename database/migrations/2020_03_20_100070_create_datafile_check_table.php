<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datafile_check', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datafile_table_id')->nullable();
            $table->string('datafile_sheet')->nullable();
            $table->unsignedBigInteger('datafile_id')->nullable();
            $table->string('field_name');
            $table->string('function_name');
            $table->integer('row')->unsigned()->nullable();
            $table->string('value_string')->nullable();
            $table->integer('value_int')->nullable()->unsigned();
            $table->double('value_double')->nullable();
            $table->index(array('datafile_id', 'field_name', 'value_string'));
            $table->index(array('datafile_id', 'field_name', 'value_int'));
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datafile_check');
    }

};
