<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClutterGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deck = Deck::create([
            'name' => 'Clutter Code Detection',
            'description' => 'This deck will allow the user to get better at recognizing excessive and unnecessary clutter.',
            'code_smell_id' => '2',
        ]);

        $deck->cards()->createMany([
            [
                'title' => 'Add Two Numbers',
                'explanation' => 'A simple method buried beneath excessive comments.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// This method adds two numbers together.
//
// It receives two integers.
//
// The first integer is called $a.
//
// The second integer is called $b.
//
// The numbers are added together.
//
// The result is returned.
//
// End of documentation.
///////////////////////////////////////////////////////////
public function add(int $a, int $b): int
{
    return $a + $b;
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'User Login',
                'explanation' => 'Comments narrate every obvious step.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// Login Process
//
// Check if the user exists.
//
// If the user exists, log them in.
//
// After logging them in, redirect them.
//
// End of process.
//
// Do not remove these comments.
//
// Thank you.
///////////////////////////////////////////////////////////
public function login(User $user): RedirectResponse
{
    Auth::login($user);

    return redirect('/dashboard');
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Calculate Tax',
                'explanation' => 'The comments are longer than the implementation.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// Tax Calculation
//
// Receive the subtotal.
//
// Multiply by the tax rate.
//
// Return the calculated amount.
//
// This has been here since 2020.
//
// End.
///////////////////////////////////////////////////////////
public function calculateTax(float $subtotal): float
{
    return $subtotal * 0.13;
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Format Username',
                'explanation' => 'The code is simple but overwhelmed by comments.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// Username Formatting
//
// Remove whitespace.
//
// Convert to lowercase.
//
// Return the result.
//
// Formatting complete.
//
// End of comments.
///////////////////////////////////////////////////////////
public function formatUsername(string $name): string
{
    return strtolower(trim($name));
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Check Adult',
                'explanation' => 'An excessive comment block for one comparison.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// Age Verification
//
// Determine if the user is an adult.
//
// Adults are 18 or older.
//
// Return true if adult.
//
// Return false otherwise.
//
// End.
///////////////////////////////////////////////////////////
public function isAdult(int $age): bool
{
    return $age >= 18;
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Business Rule',
                'explanation' => 'The comment explains a business rule that is not obvious from the implementation.',
                'code_snippet' => <<<'CODE'
public function calculateShipping(float $subtotal): float
{
    if ($subtotal >= 100) {
        return 0;
    }

    return 15;
}
CODE,
                'answer' => 'Clean',
            ],
            [
                'title' => 'Legacy System Workaround',
                'explanation' => 'The comment explains why an unusual condition exists.',
                'code_snippet' => <<<'CODE'
public function isSuccessful(array $response): bool
{
    return $response['status'] !== '0';
}
CODE,
                'answer' => 'Clean',
            ],
            [
                'title' => 'Helpful TODO',
                'explanation' => 'A TODO identifies future work rather than narrating the code.',
                'code_snippet' => <<<'CODE'
public function generateToken(): string
{
    return bin2hex(random_bytes(32));
}
CODE,
                'answer' => 'Clean',
            ],
            [
                'title' => 'Algorithm Explanation',
                'explanation' => 'The comment explains why the guard clause exists.',
                'code_snippet' => <<<'CODE'
public function completionPercentage(int $completed, int $total): float
{
    if ($total === 0) {
        return 0;
    }

    return ($completed / $total) * 100;
}
CODE,
                'answer' => 'Clean',
            ],
            [
                'title' => 'Concise PHPDoc',
                'explanation' => 'The PHPDoc describes the purpose of the method without repeating every line.',
                'code_snippet' => <<<'CODE'

public function currentUser(): User
{
    return auth()->userOrFail();
}
CODE,
                'answer' => 'Clean',
            ],
        ]);
    }
}
