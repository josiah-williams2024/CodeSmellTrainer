<?php

namespace Database\Seeders;

use App\Models\CodeSmell;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

### Why it's a problem
- Difficult to read and understand.
- Harder to test.
- More likely to contain bugs.
- Discourages code reuse.

### How to recognize it
- The method spans many lines.
- Deep nesting of loops or conditionals.
- Multiple responsibilities in one method.
- Large numbers of local variables.

### How to fix it
- Extract Method.
- Break work into smaller helper methods.
- Move responsibilities to other classes when appropriate.

When reviewing code, ask yourself: "Can this method be understood in less than a minute?" If not, it's probably too long.
TEXT,
        ]);


        CodeSmell::query()->create([
            'name' => 'Clutter',
            'slug' => 'clutter',
            'summary' => 'Unnecessary code and information that make the code harder to read.',
            'content' => <<<'TEXT'
Clutter is anything that adds noise without providing value. This includes dead code, unused variables, excessive comments, commented-out code, and inconsistent formatting.

### Why it's a problem
- Makes code harder to read.
- Increases cognitive load.
- Hides important logic.
- Makes maintenance more difficult.

### How to recognize it
- Commented-out code.
- Unused variables or methods.
- Redundant comments.
- Poor or inconsistent formatting.
- Code that no longer serves a purpose.

### How to fix it
- Remove dead code.
- Delete unused variables and methods.
- Keep comments focused on explaining "why" instead of "what."
- Follow consistent formatting and naming conventions.

Clean code communicates its intent clearly. Everything that doesn't contribute to understanding should be removed.
TEXT,
        ]);

        CodeSmell::query()->create([
            'name' => 'Duplication',
            'slug' => 'duplication',
            'summary' => 'The same or very similar code appears in multiple places.',
            'content' => <<<'TEXT'
Duplicate code occurs when the same logic is copied into multiple methods, classes, or files. Every duplicate increases maintenance because changes must be made in several places instead of one.

### Why it's a problem
- Bugs must be fixed multiple times.
- Makes future changes slower.
- Increases the size of the codebase.
- Violates the DRY (Don't Repeat Yourself) principle.

### How to recognize it
- Copy-and-paste code.
- Nearly identical methods.
- Repeated calculations or conditional logic.
- Multiple classes doing the same work.

### How to fix it
- Extract shared methods.
- Create reusable classes or services.
- Use composition or inheritance where appropriate.
- Centralize shared behavior.

If changing one piece of logic requires editing several files, duplication is likely present.
TEXT,
        ]);
    }
}
