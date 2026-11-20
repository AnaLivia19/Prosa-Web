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
Schema::create('eventos', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->text('descricao')->nullable();
    $table->string('local');
    $table->dateTime('data_hora');
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('comunidade_id')->nullable()->constrained('comunidades')->nullOnDelete();
    $table->timestamps();
});
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('eventos');
        }
    };
