<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {

        Schema::table('candidati', function (Blueprint $table) {

            $table->unsignedBigInteger('comune_id')->nullable()->default(null)->index();
            $table->foreign('comune_id','cand_com_fk')->references('id')->on('comuni')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('nazione_id')->nullable()->default(null)->index();
            $table->foreign('nazione_id','cand_naz_fk')->references('id')->on('nazioni')->onDelete('restrict')->onUpdate('cascade');

            $table->string('comune_estero')->nullable()->default(null);

        });

        Schema::table('candidati', function (Blueprint $table) {
            $table->dropColumn([
                'comune',
            ]);
        });

        Schema::table('corsi', function (Blueprint $table) {

            $table->boolean('homepage')->default(0);

        });
    }

    public function down()
    {
        Schema::table('corsi', function (Blueprint $table) {
            $table->dropColumn([
                'homepage',
            ]);
        });
        Schema::table('candidati', function (Blueprint $table) {
            $table->dropForeign('cand_naz_fk');
            $table->dropForeign('cand_com_fk');

            $table->dropColumn([
                'comune_id','nazione_id','comune_estero'
            ]);
            $table->string('comune')->nullable()->default(null);
        });
    }
};
