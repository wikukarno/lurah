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
            $table->string('id', 50)->primary();
            $table->string('users_id', 50);
            $table->string('letters_id', 50);
            $table->string('nik', 16);
            $table->string('nama', 30);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 30);

            $table->date('tanggal_lahir');
            $table->string('pekerjaan', 30);
            $table->string('alamat', 50);
            $table->string('rtrw', 10);
            $table->string('kelurahan', 15);

            $table->string('kecamatan', 20);
            $table->string('agama', 10);
            $table->date('tanggal_meninggal');
            $table->string('tempat_pemakaman', 30);
            $table->date('tanggal_dimakamkan');
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
        Schema::dropIfExists('funeral_certifications');
    }
};
