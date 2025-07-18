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
        Schema::create('ds_admin_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admin_id', 191)->index('ds_admin_roles_admin_id_foreign');
            $table->string('role_id', 191)->index('ds_admin_roles_role_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_admin_roles');
    }
};
