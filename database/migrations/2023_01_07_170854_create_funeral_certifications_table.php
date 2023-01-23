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
        Schema::create('funeral_certifications', function (Blueprint $table) {
            $table->id();
            $table->string('users_id');
            $table->string('letters_id');
            $table->string('nik');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');

            $table->dateTime('tanggal_lahir');
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->string('rtrw');
            $table->string('kelurahan');

            $table->string('kecamatan');
            $table->string('agama');
            $table->dateTime('tanggal_meninggal');
            $table->string('tempat_pemakaman');
            $table->dateTime('tanggal_dimakamkan');
            $table->string('surat_rtrw');

            $table->string('alasan_penolakan')->nullable();
            $table->enum('posisi', ['user', 'staff', 'lurah'])->default('staff')->nullable();
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
        Schema::dropIfExists('funeral_certifications');
    }
};