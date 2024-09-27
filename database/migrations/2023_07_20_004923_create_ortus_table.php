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
        Schema::create('ortus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('nama_ayah');
            $table->string('telp');
            $table->text('alamat_ortu');
            $table->tinyInteger('kerjaayah_id');
            $table->tinyInteger('gajiayah_id');
            $table->string('nama_ibu');
            $table->tinyInteger('kerjaibu_id');
            $table->tinyInteger('gajiibu_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ortus');
    }
};
