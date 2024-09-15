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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'original_title');
            $table->string(column: 'es_title');
            $table->string(column: 'author');
            $table->string(column: 'genre');
            $table->string(column: 'year');
            $table->string(column: 'synopsis');
            $table->string(column: 'cover');
            $table->string(column: 'cover_file_names');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
