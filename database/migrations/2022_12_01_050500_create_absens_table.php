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
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('atm_id');
            // $table->string('nip_teknisi');
            $table->string( 'nama_lengkap');
            $table->string('latitude');
            $table->string('longitude');
            // $table->string('nama_atm');
            $table->enum('kondisi_mesin', ['Menunggu Tindakan', 'Selesai']);
            $table->text('keterangan');
            $table->string('foto');
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
        Schema::dropIfExists('absens');
    }
};
