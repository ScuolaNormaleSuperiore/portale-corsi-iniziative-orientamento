<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::table('candidati', function (Blueprint $table) {

            $table->string('olimpiadi_matematica_squadre')->nullable();
            $table->string('olimpiadi_matematica_squadre_femminili')->nullable();
            $table->string('olimpiadi_fisica_squadre_miste')->nullable();
            $table->string('olimpiadi_scienze_naturali')->nullable();
            $table->string('giochi_chimica')->nullable();
            $table->string('olimpiadi_informatica')->nullable();

            $table->string('stages')->nullable();
            $table->string('gare_internazionali')->nullable();

        });
    }

    public function down()
    {
        Schema::table('candidati', function (Blueprint $table) {
            $table->dropColumn([
                'olimpiadi_matematica_squadre',
                'olimpiadi_matematica_squadre_femminili',
                'olimpiadi_fisica_squadre_miste',
                'olimpiadi_scienze_naturali',
                'giochi_chimica',
                'olimpiadi_informatica',

                'stages',
                'gare_internazionali',
            ]);
        });
    }
};
