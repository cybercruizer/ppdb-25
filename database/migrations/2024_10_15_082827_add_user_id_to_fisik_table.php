<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fisik', function (Blueprint $table) {
            $table->foreignId('guru_id')->after('non_akademik')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fisik', function (Blueprint $table) {
            $table->dropForeign('fisik_guru_id_foreign');
            $table->dropColumn('guru_id');
        });
    }
};
