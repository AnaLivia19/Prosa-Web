<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('comunidade_user', function (Blueprint $table) {
    $table->foreignId('comunidade_id')->constrained('comunidades')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->primary(['comunidade_id', 'user_id']);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('comunidade_user');
    }
};