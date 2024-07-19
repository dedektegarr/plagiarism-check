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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->integer('pages')->nullable();
            $table->string('cover');
            $table->string('file');
            $table->timestamp('creation_date')->nullable();
            $table->timestamp('mod_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
