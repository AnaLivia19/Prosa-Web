<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->date('data_nascimento')->nullable();
        $table->string('cidade')->nullable();
        $table->string('profissao')->nullable();
        $table->string('passatempo')->nullable();
        $table->text('sobre')->nullable();
        $table->string('foto')->nullable();
        $table->boolean('onboarding_completo')->default(false);
        $table->boolean('is_admin')->default(false);
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['data_nascimento', 'cidade', 'profissao', 'passatempo',
            'sobre', 'foto', 'onboarding_completo', 'is_admin']);
    });
}
};
