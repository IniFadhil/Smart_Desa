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
        Schema::create('ds_program_list', function (Blueprint $table) {
            $table->string('id', 50)->index();
            $table->string('desa_id', 50);
            $table->string('kategori_id', 50)->index('ds_program_list_kategori_id_foreign');
            $table->string('name', 191);
            $table->string('description');
            $table->string('short_description', 150);
            $table->string('slug', 191);
            $table->string('img', 191)->nullable();
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->bigInteger('hit')->default(0);
            $table->string('created_by', 191)->nullable();
            $table->string('updated_by', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_program_list');
    }
};
