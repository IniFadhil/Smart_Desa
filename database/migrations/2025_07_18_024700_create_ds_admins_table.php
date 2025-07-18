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
        Schema::create('ds_admins', function (Blueprint $table) {
            $table->string('id', 191)->index();
            $table->string('desa_id', 191)->index('index 4');
            $table->string('nik', 16)->nullable();
            $table->string('name', 191);
            $table->string('email', 191)->unique();
            $table->string('username', 191)->unique();
            $table->string('password', 191);
            $table->string('phone_number', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('img', 191)->nullable();
            $table->string('api_token', 191)->nullable();
            $table->enum('status', ['1', '0'])->default('1');
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
        Schema::dropIfExists('ds_admins');
    }
};
