<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('candidati', function (Blueprint $table) {
            $table->nullableTimestamps();
            $table->nullableOwnerships();
        });
    }

    public function down()
    {
        Schema::table('candidati', function (Blueprint $table) {
            $table->dropColumn([
                'updated_at',
                'created_at',
                'updated_by',
                'created_by',
            ]);
        });
    }
};
