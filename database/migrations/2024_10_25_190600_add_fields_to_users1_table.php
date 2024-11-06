<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nome')->nullable();
            $table->string('cognome')->nullable();
//            $table->string('codice_fiscale')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nome',
                'cognome',
//                'codice_fiscale'
            ]);
        });
    }
};
