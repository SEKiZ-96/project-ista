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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_name')->default('null');
            $table->string('monday')->default('null');
            $table->string('tuesday')->default('null');
            $table->string('wednesday')->default('null');
            $table->string('thursday')->default('null');
            $table->string('friday')->default('null');
            $table->string('saturday')->default('null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
