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
        Schema::create('keldesa', function (Blueprint $table) {
            $table->string('id', 50)->index('id');
            $table->string('nama_keldesa');
            $table->string('idkecamatan', 50)->index('idkecamatan');
            $table->enum('kategori', ['desa', 'kelurahan']);
            $table->enum('status', ['Y', 'N'])->default('N');
            $table->string('url')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keldesa');
    }
};
