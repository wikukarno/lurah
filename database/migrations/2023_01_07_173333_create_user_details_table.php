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
            $table->string('id', 50)->primary();
            $table->string('users_id', 50);
            $table->string('nik', 16)->unique()->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('jenis_kelamin', 10)->nullable();

            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('pekerjaan', 30)->nullable();
            $table->string('rtrw', 10)->nullable();
            $table->string('kelurahan', 15)->nullable();

            $table->string('kecamatan', 20)->nullable();
            $table->string('agama', 10)->nullable();
            $table->string('status_perkawinan', 15)->nullable();
            $table->string('address', 50)->nullable();
            $table->text('avatar')->nullable();

            $table->text('ktp')->nullable();
            $table->text('kk')->nullable();
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
