<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classi', function (Blueprint $table) {

            $table->string('slug_it')->nullable();
            $table->unique(['nome_it'], 'clas_slug_uq');
        });

        foreach (\App\Models\Classe::all() as $classe) {
            $name = $classe->nome_it;
            $classe->nome_it .= '-';
            $classe->save();
            $classe->nome_it = $name;
            $classe->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classi', function (Blueprint $table) {
            //
        });
    }
};
