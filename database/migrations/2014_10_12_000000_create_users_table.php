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
            $table->string('id', 11)->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('roles')->default('User');
            $table->bigInteger('tele_id')->nullable();
            $table->string('tele_name')->nullable();
            $table->string('tele_notif')->nullable();
            $table->string('login_with')->nullable();
            $table->string('login_ip')->nullable();
            $table->string('auth_status')->nullable();
            $table->enum('status_account', ['none', 'pending', 'ditolak', 'blokir', 'verifikasi'])->default('none');
            $table->string('alasan_penolakan')->nullable();
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
