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
        Schema::create('ds_menus', function (Blueprint $table) {
            $table->string('id', 191)->index();
            $table->string('name', 191);
            $table->text('description')->nullable();
            $table->string('modul_id', 191)->index('ds_menus_modul_id_foreign');
            $table->string('route', 191);
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_menus');
    }
};
