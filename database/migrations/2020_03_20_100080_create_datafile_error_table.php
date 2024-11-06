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
        Schema::create('datafile_error', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datafile_table_id')->nullable();
            $table->string('datafile_sheet')->nullable();
            $table->string('datafile_table_type')->nullable();
            $table->unsignedBigInteger('datafile_id')->nullable();
            $table->string('field_name');
            $table->string('error_name');
            $table->integer('row')->unsigned()->nullable();
            $table->string('type')->default('error');
            $table->string('value')->nullable();
            $table->boolean('template')->default(0);
            $table->string('param')->nullable();
            $table->index(array('datafile_id', 'row'));
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datafile_error');
    }

};
