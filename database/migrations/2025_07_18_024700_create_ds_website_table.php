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
        Schema::create('ds_website', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('desa_id', 50)->index('ds_website_desa_id_foreign');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->text('meta_description');
            $table->string('favicon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_website');
    }
};
