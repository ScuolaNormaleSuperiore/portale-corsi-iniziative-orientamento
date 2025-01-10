<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {

        $query = "ALTER TABLE pagine MODIFY COLUMN tipo ENUM('standard','blade','orientamento','info') DEFAULT 'standard'";
        \Illuminate\Support\Facades\DB::statement($query);

        Schema::table('users', function (Blueprint $table) {

            $table->text('info')->nullable();

        });
        Schema::table('pagine', function (Blueprint $table) {

            $table->unsignedBigInteger('parent_id')->nullable()->default(null);

        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'info',
            ]);
        });
        Schema::table('pagine', function (Blueprint $table) {
            $table->dropColumn([
                'parent_id',
            ]);
        });
    }
};
