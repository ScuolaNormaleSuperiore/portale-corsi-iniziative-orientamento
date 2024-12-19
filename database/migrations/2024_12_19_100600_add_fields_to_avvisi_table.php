<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('avvisi', function (Blueprint $table) {
            $table->string('tipo')->nullable();
        });
    }

    public function down()
    {
        Schema::table('avvisi', function (Blueprint $table) {
            $table->dropColumn([
                'tipo',
            ]);
        });
    }
};
