<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up()
    {

        Schema::table('scuole', function (Blueprint $table) {

            $table->dropForeign('regione_id');
            $table->unsignedBigInteger('regione_id')->nullable(true)->change();
            $table->foreign('regione_id')->references('id')->on('regioni')->onDelete('restrict')->onUpdate('cascade');

        });

    }

    public function down()
    {

    }
};
