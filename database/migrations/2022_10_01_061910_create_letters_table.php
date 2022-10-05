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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('users_id');
            $table->enum('jenis_surat', ['SKU', 'SKTM', 'SKP', 'SKI'])->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt_rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('no_nik')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('alasan_penolakan')->nullable();
            $table->enum('posisi', ['staff', 'lurah'])->default('staff')->nullable();
            $table->enum('status', ['Belum Diproses', 'Sedang Diproses', 'Selesai Diproses', 'Ditolak'])->default('Belum Diproses')->nullable();
            $table->string('hari_meninggal')->nullable();
            $table->string('tanggal_meninggal')->nullable();
            $table->string('nama_pemakaman')->nullable();
            $table->string('tanggal_dimakamkan')->nullable();
            $table->string('tujuan_surat_tidak_mampu')->nullable();
            $table->string('perihal')->nullable();
            $table->string('tujuan_surat_izin')->nullable();
            $table->string('nama_izin')->nullable();
            $table->string('tanggal_pelaksanaan_izin')->nullable();
            $table->string('tempat_pelaksanaan_izin')->nullable();
            $table->string('waktu_pelaksanaan_izin')->nullable();
            $table->string('jumlah_undangan')->nullable();
            $table->string('hiburan')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_surat_rt_rw')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('letters');
    }
};
