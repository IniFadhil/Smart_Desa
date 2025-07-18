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
        Schema::create('ds_permissions', function (Blueprint $table) {
            $table->string('id', 191)->index();
            $table->string('role_id', 191)->index('ds_permissions_role_id_foreign');
            $table->string('modul_id', 191)->index('ds_permissions_modul_id_foreign');
            $table->string('menu_id', 191)->index('ds_permissions_menu_id_foreign');
            $table->enum('read', ['1', '0'])->default('1');
            $table->enum('create', ['1', '0'])->default('1');
            $table->enum('update', ['1', '0'])->default('1');
            $table->enum('delete', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_permissions');
    }
};
