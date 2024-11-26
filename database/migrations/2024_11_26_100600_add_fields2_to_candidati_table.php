<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('candidati', function (Blueprint $table) {
            $table->string('sezione')->nullable();
            $table->mediumText('profilo')->nullable();
            $table->string('scuola_estera')->nullable();

        });
    }

    public function down()
    {
        Schema::table('candidati', function (Blueprint $table) {
            $table->dropColumn([
                'sezione',
                'profilo',
                'scuola_estera',
            ]);
        });
    }
};
