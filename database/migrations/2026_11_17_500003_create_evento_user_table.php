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
Schema::create('evento_user', function (Blueprint $table) {
    $table->foreignId('evento_id')->constrained('eventos')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->primary(['evento_id', 'user_id']);
});
}

public function down(): void
{
    Schema::dropIfExists('interesses');
}
};
