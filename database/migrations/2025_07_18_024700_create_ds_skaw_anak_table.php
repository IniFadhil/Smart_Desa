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
        Schema::create('ds_skaw_anak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('skaw_id', 50)->index('ds_skaw_anak_skaw_id_foreign');
            $table->string('nama', 150);
            $table->string('tempat_lahir', 150);
            $table->date('tgl_lahir');
            $table->enum('kewarganegaraan', ['indonesia', 'wna']);
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_skaw_anak');
    }
};
