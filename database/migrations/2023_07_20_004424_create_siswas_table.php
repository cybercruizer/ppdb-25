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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaf');
            $table->string('nama');
            $table->string('nisn');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['L','P']);
            $table->enum('agama',['Islam','Kristen','Katholik','Hindu','Budha']);
            $table->tinyInteger('anak_ke');
            $table->tinyInteger('dari');
            $table->string('alamat');
            $table->string('asal_sekolah');
            $table->string('alamat_sekolah');
            $table->string('no_ijazah');
            $table->string('no_telp');
            $table->tinyInteger('hobi');
            $table->tinyInteger('jarak');
            $table->tinyInteger('transport');
            $table->tinyInteger('informasi');
            $table->tinyInteger('jurusan');
            $table->string('alasan');
            $table->integer('ortu_id');
            $table->string('kategori');

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
        Schema::dropIfExists('siswas');
    }
};
