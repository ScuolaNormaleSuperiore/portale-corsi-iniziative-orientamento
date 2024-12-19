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
		Schema::create('copertine', function(Blueprint $table)
		{
            			$table->id();
			$table->string('titolo_it')->nullable();
			$table->string('sottotitolo_it')->nullable();
            $table->string('call_to_action')->nullable();
			$table->string('link')->nullable();
			$table->boolean('homepage')->default(0);
			$table->integer('ordine')->unsigned()->nullable();
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
		Schema::drop('copertine');
	}

};
