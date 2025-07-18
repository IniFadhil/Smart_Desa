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
        Schema::table('ds_admin_roles', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'ds_admin_roles_ibfk_1')->references(['id'])->on('ds_admins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['role_id'], 'ds_admin_roles_ibfk_2')->references(['id'])->on('ds_roles')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ds_admin_roles', function (Blueprint $table) {
            $table->dropForeign('ds_admin_roles_ibfk_1');
            $table->dropForeign('ds_admin_roles_ibfk_2');
        });
    }
};
