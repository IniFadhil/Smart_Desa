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
        Schema::create('ds_visitor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('ip', 191);
            $table->bigInteger('hit')->default(0);
            $table->string('online', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ds_visitor');
    }
};
