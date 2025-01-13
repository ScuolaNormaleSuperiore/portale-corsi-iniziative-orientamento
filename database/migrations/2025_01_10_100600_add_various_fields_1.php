<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {

        $query = "ALTER TABLE iniziative MODIFY COLUMN note TEXT NULL";
        \Illuminate\Support\Facades\DB::statement($query);
        $query = "ALTER TABLE iniziative MODIFY COLUMN posti INT(10) NULL";
        \Illuminate\Support\Facades\DB::statement($query);
        $query = "ALTER TABLE iniziative MODIFY COLUMN posti_onere INT(10) NULL";
        \Illuminate\Support\Facades\DB::statement($query);


        $query = "ALTER TABLE pagine MODIFY COLUMN tipo ENUM('standard','blade','orientamento','info') DEFAULT 'standard'";
        \Illuminate\Support\Facades\DB::statement($query);

        Schema::table('users', function (Blueprint $table) {

            $table->text('info')->nullable();
            $table->string('codice_fiscale')->nullable()->default(null);


        });

        Schema::table('pagine', function (Blueprint $table) {

            $table->unsignedBigInteger('parent_id')->nullable()->default(null);

            $table->dropUnique(['titolo_it']);
            $table->unique(['tipo','titolo_it'],'pag_slug_uq');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'info',
                'codice_fiscale',
            ]);
        });
        Schema::table('pagine', function (Blueprint $table) {
            $table->dropColumn([
                'parent_id',
            ]);
            $table->dropUnique('pag_slug_uq');
            $table->unique('titolo_it');
        });
    }
};
