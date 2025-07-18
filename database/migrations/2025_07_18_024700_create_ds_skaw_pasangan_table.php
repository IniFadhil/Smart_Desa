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
        Schema::create('ds_skaw_pasangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('skaw_id', 50)->index('ds_skaw_pasangan_skaw_id_foreign');
            $table->string('nama', 150);
            $table->enum('jk_alm', ['laki-laki', 'perempuan']);
            $table->string('tempat_lahir', 150);
            $table->date('tgl_lahir');
            $table->string('pekerjaan_id', 50)->index('ds_skaw_pasangan_pekerjaan_id_foreign');
            $table->string('jk', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_skaw_pasangan');
    }
};
