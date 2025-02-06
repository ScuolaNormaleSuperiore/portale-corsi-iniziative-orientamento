<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {

        Schema::table('iniziative', function (Blueprint $table) {

            $table->unsignedInteger('max_candidature_scuola')->nullable()->default(null);

        });

    }

    public function down()
    {
        Schema::table('iniziative', function (Blueprint $table) {
            $table->dropColumn([
                'max_candidature_scuola',
            ]);
        });
    }
};
