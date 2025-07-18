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
        Schema::create('ds_slider', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('desa_id', 50)->index('ds_slider_desa_id_foreign');
            $table->text('description');
            $table->string('img', 191)->nullable();
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->string('uploaded_by', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_slider');
    }
};
