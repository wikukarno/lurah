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
        Schema::create('business_certifications', function (Blueprint $table) {
            $table->string('id', 11)->primary();
            $table->string('users_id');
            $table->string('letters_id');
            $table->string('nama_usaha');
            $table->string('jenis_usaha');
            $table->string('surat_rtrw');
            $table->string('alasan_penolakan')->nullable();
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
        Schema::dropIfExists('business_certifications');
    }
};
