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
        Schema::create('permits', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('users_id', 50);
            $table->string('letters_id', 50);
            $table->string('perihal', 30);
            $table->string('tujuan_surat', 30);
            $table->string('nama_izin', 30);

            $table->date('tanggal_izin');
            $table->string('tempat_izin', 30);
            $table->time('waktu_izin');
            $table->string('jumlah_peserta', 5);
            $table->string('hiburan', 20);
            $table->text('surat_rtrw');


            $table->string('alasan_penolakan', 30)->nullable();
            $table->enum('posisi', ['staff', 'lurah'])->default('staff')->nullable();
            $table->enum('status', ['Belum Diproses', 'Sedang Diproses', 'Selesai Diproses', 'Ditolak'])->default('Belum Diproses')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permits');
    }
};
