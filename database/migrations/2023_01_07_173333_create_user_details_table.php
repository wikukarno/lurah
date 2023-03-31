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
        Schema::create('user_details', function (Blueprint $table) {
            $table->string('id', 11)->primary();
            $table->string('users_id');
            $table->string('nik')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('jenis_kelamin')->nullable();

            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('rtrw')->nullable();
            $table->string('kelurahan')->nullable();

            $table->string('kecamatan')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();

            $table->string('ktp')->nullable();
            $table->string('kk')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};
