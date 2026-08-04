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
        CodeSmell::query()->firstOrCreate(
            ['slug' => 'long-method'],
            ['name' => 'Long Method',
                'summary' => 'Methods that are too long and try to do too many things.',
                'content' => <<<'TEXT'
A long method is difficult to understand, maintain, and test. It often violates the Single Responsibility Principle because it tries to accomplish multiple tasks instead of focusing on one responsibility.
TEXT,
                'reference_url' => 'https://refactoring.guru/smells/long-method',
            ]);

        CodeSmell::query()->firstOrCreate(
            ['slug' => 'clutter'],
            ['name' => 'Clutter',
                'summary' => 'Unnecessary code and information that make the code harder to read.',
                'content' => <<<'TEXT'
Clutter is anything that adds noise without providing value. This includes dead code, unused variables, excessive comments, commented-out code, and inconsistent formatting.
TEXT,
                'reference_url' => 'https://refactoring.guru/smells/comments',
            ]);

        CodeSmell::query()->firstOrCreate(
            ['slug' => 'duplication'],
            ['name' => 'Duplication',
                'summary' => 'The same or very similar code appears in multiple places.',
                'content' => <<<'TEXT'
Duplicate code occurs when the same logic is copied into multiple methods, classes, or files. Every duplicate increases maintenance because changes must be made in several places instead of one.
TEXT,
                'reference_url' => 'https://refactoring.guru/smells/duplicate-code',
            ]);

        CodeSmell::query()->firstOrCreate(
            ['slug' => 'nested-conditionals'],
            ['name' => 'Deeply Nested Conditionals',

                'summary' => 'Multiple levels of nested if statements make code difficult to read and follow.',
                'content' => <<<'TEXT'
Deeply nested conditionals, sometimes called "arrow code," reduce readability and make it harder to understand the flow of a method. They can often be simplified using guard clauses, early returns, or by extracting logic into separate methods.
TEXT,
                'reference_url' => 'https://refactoring.guru/replace-nested-conditional-with-guard-clauses',
            ]);

        CodeSmell::query()->firstOrCreate(
            ['slug' => 'long-parameter-list'],
            [
                'name' => 'Long Parameter List',
                'summary' => 'Methods require too many parameters, making them harder to understand and use.',
                'content' => <<<'TEXT'
A long parameter list often indicates that a method is doing too much or that related data should be grouped into an object. Long parameter lists are harder to read, easier to misuse, and make methods more difficult to maintain.
TEXT,
                'reference_url' => 'https://refactoring.guru/smells/long-parameter-list',
            ]
        );

        CodeSmell::query()->firstOrCreate(
            ['slug' => 'magic-numbers'],
            [
                'name' => 'Magic Numbers',
                'summary' => 'Hardcoded numeric values appear without explaining what they represent.',
                'content' => <<<'TEXT'
Magic numbers are literal numeric values used directly in code without meaningful names. Replacing them with named constants or enums makes code easier to understand, maintain, and modify.
TEXT,
                'reference_url' => 'https://refactoring.guru/replace-magic-number-with-symbolic-constant',
            ]
        );
    }
}
