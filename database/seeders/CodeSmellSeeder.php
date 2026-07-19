<?php

namespace Database\Seeders;

use App\Models\CodeSmell;
use Illuminate\Database\Seeder;

class CodeSmellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CodeSmell::query()->create([
            'name' => 'Long Method',
            'slug' => 'long-method',
            'summary' => 'Methods that are too long and try to do too many things.',
            'content' => <<<'TEXT'
A long method is difficult to understand, maintain, and test. It often violates the Single Responsibility Principle because it tries to accomplish multiple tasks instead of focusing on one responsibility.
TEXT,
            'reference_url' => 'https://refactoring.guru/smells/long-method',
        ]);

        CodeSmell::query()->create([
            'name' => 'Clutter',
            'slug' => 'clutter',
            'summary' => 'Unnecessary code and information that make the code harder to read.',
            'content' => <<<'TEXT'
Clutter is anything that adds noise without providing value. This includes dead code, unused variables, excessive comments, commented-out code, and inconsistent formatting.
TEXT,
            'reference_url' => 'https://refactoring.guru/smells/comments',
        ]);

        CodeSmell::query()->create([
            'name' => 'Duplication',
            'slug' => 'duplication',
            'summary' => 'The same or very similar code appears in multiple places.',
            'content' => <<<'TEXT'
Duplicate code occurs when the same logic is copied into multiple methods, classes, or files. Every duplicate increases maintenance because changes must be made in several places instead of one.
TEXT,
            'reference_url' => 'https://refactoring.guru/smells/duplicate-code',
        ]);
    }
}
