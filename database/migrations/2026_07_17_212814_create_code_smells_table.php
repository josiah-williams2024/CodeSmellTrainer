<?php

use App\Models\CodeSmell;
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
        Schema::create('code_smells', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('content');
            $table->string('reference_url')->nullable();
            $table->timestamps();
        });

        Schema::table('decks', function (Blueprint $table) {
            $table->foreignIdFor(CodeSmell::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_smells');
    }
};
