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
        Schema::create('ds_suket_log', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('desa_id', 50)->index('ds_suket_log_desa_id_foreign');
            $table->string('suket_id', 50);
            $table->string('jenis_suket', 191);
            $table->string('pesan', 191);
            $table->string('keterangan', 191);
            $table->enum('status', ['terima', 'tolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_suket_log');
    }
};
