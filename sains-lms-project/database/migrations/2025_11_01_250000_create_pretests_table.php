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
        Schema::create('pretests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('halaqah_id')
            ->constrained('halaqahs')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('kbq')->default(0);
            $table->integer('hb')->default(0);
            $table->integer('mh')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pretests');
    }
};
