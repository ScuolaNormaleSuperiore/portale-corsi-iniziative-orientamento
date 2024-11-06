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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end')->nullable();
            $table->integer('error')->unsigned()->default(0);
            $table->text('msg')->nullable();
            $table->string('job_type',255)->nullable();
            $table->text('input_data')->nullable();
            $table->text('output_data')->nullable();
            $table->integer('progress')->unsigned()->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('job_id')->nullable()->index();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('queues');
    }

};
