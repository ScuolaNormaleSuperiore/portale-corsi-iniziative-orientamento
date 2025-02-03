<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {

        Schema::table('scuole', function (Blueprint $table) {

            $table->unsignedBigInteger('comune_id')->nullable()->default(null)->index();
            $table->foreign('comune_id','scuo_com_fk')->references('id')->on('comuni')->onDelete('restrict')->onUpdate('cascade');

        });

    }

    public function down()
    {
        Schema::table('scuole', function (Blueprint $table) {
            $table->dropForeign('scuo_com_fk');

            $table->dropColumn([
                'comune_id',
            ]);
        });
    }
};
