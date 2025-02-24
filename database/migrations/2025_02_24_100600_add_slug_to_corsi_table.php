<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::table('corsi', function (Blueprint $table) {

            $table->string('slug_it')->nullable();
            $table->unique(['iniziativa_id','titolo'],'cor_slug_uq');

        });

        foreach (\App\Models\Corso::all() as $corso) {
            $titolo = $corso->titolo;
            $corso->titolo .= '-';
            $corso->save();
            $corso->titolo = $titolo;
            $corso->save();
        }
    }

    public function down()
    {
        Schema::table('corsi', function (Blueprint $table) {
            $table->dropColumn([
                'slug_it',
            ]);
            $table->dropUnique('cor_slug_uq');

        });
    }
};
