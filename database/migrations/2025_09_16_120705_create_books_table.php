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
            $table->string('title')->index();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('writers')->onDelete('cascade');
            $table->string('image_path')->nullable();
            $table->string('iban');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->string('genre')->nullable();
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