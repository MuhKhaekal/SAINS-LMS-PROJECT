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
        Schema::create('pivot_prodi_halaqahs', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('prodi_id')
                  ->constrained('prodis')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        
            $table->foreignId('halaqah_id')
                  ->constrained('halaqahs')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_prodi_halaqahs');
    }
};
