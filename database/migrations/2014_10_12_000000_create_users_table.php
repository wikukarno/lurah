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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('nama', 30);
            $table->string('email', 30)->unique();
            $table->string('roles', 6)->default('User');

            $table->string('nik', 16)->unique()->nullable();
            $table->string('no_telepon', 12)->nullable();
            $table->string('jenis_kelamin', 10)->nullable();

            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('pekerjaan', 30)->nullable();
            $table->string('rtrw', 10)->nullable();
            $table->string('kelurahan', 15)->nullable();

            $table->string('kecamatan', 20)->nullable();
            $table->string('agama', 10)->nullable();
            $table->string('status_perkawinan', 15)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->text('foto')->nullable();

            $table->text('ktp')->nullable();
            $table->text('kk')->nullable();

            $table->enum('status_account', ['none', 'pending', 'ditolak', 'blokir', 'verifikasi'])->default('none');
            $table->string('alasan_penolakan', 30)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
