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
        Schema::create('pivot_class_pai_faculties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_pai_id')
                  ->constrained('class_pais')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        
            $table->foreignId('faculty_id')
                  ->constrained('faculties')
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
        Schema::dropIfExists('pivot_class_pai_faculties');
    }
};
