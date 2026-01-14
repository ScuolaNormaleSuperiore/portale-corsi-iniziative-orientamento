<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up()
    {

        Schema::table('scuole', function (Blueprint $table) {

            //$table->dropForeign('provincia_id');
            $table->unsignedBigInteger('provincia_id')->nullable(true)->change();
            //$table->foreign('provincia_id')->references('id')->on('province')->onDelete('restrict')->onUpdate('cascade')->change();
        });
    }

    public function down() {}
};
