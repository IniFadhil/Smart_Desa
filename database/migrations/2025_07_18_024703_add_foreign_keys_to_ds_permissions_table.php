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
        Schema::table('ds_permissions', function (Blueprint $table) {
            $table->foreign(['menu_id'])->references(['id'])->on('ds_menus')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['modul_id'])->references(['id'])->on('ds_modules')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['role_id'])->references(['id'])->on('ds_roles')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_permissions', function (Blueprint $table) {
            $table->dropForeign('ds_permissions_menu_id_foreign');
            $table->dropForeign('ds_permissions_modul_id_foreign');
            $table->dropForeign('ds_permissions_role_id_foreign');
        });
    }
};
