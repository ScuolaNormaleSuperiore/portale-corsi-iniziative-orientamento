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
		Schema::create('attachments', function(Blueprint $table)
		{
			$table->id();
			$table->string('ext', 6);
			$table->string('nome')->nullable();
			$table->text('descrizione')->nullable();
			$table->boolean('reserved')->nullable();
            $table->integer('ordine')->nullable()->default(0);
            $table->string('mediable_type')->nullable();
            $table->unsignedBigInteger('mediable_id');
            $table->timestamps();
            $table->nullableOwnerships();
//            $table->unique(['mediable_type','mediable_id','ordine']);
            $table->index(['mediable_type','mediable_id','ordine']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachments');
	}

};
