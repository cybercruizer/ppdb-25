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
        Schema::create('fisik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained();
            $table->float('tinggi');
            $table->float('berat');
            $table->enum('mata',['N','BW','RD','RJ','P','M']);
            $table->enum('telinga',['N','KNK','KRK']);
            $table->boolean('obat');
            $table->string('penyakit')->nullable();
            $table->enum('tato',['N','TA','TI']);
            $table->enum('disabilitas', ['N', 'TW','TR','TN','TD','TG']);
            $table->enum('ibadah',['B','C','K']);
            $table->enum('alquran',['S','B','T']);
            $table->enum('ukuran_baju',['S','M','L','XL','XXL']);
            $table->text('akademik')->nullable();
            $table->text('non_akademik')->nullable();
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
        Schema::dropIfExists('fisik');
    }
};
