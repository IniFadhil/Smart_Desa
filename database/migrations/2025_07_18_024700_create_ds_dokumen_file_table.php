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
        Schema::create('ds_dokumen_file', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('suket_id', 50);
            $table->string('jenis', 50);
            $table->string('dokumen');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->default('2025-07-09 11:43:41');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_dokumen_file');
    }
};
