<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ds_users', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('desa_id', 50)->nullable()->index('fk_ds_users_ds_desa');
            $table->string('nik', 16)->unique();
            $table->string('email', 150)->nullable()->unique('email');
            $table->string('nama_lengkap', 150);
            $table->string('password', 150);
            $table->string('no_telpon', 13);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat');
            $table->string('otp', 4)->nullable()->unique();
            $table->enum('is_verified', ['1', '0'])->default('0');
            $table->string('api_token', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_users');
    }
};
