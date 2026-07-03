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
                'title' => 'Get Full Name',
                'explanation' => 'Every obvious action is documented.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// Name Builder
//
// Retrieve the first name.
//
// Retrieve the last name.
//
// Join them together.
//
// Return the full name.
//
// End of method notes.
///////////////////////////////////////////////////////////
public function fullName(User $user): string
{
    return "{$user->first_name} {$user->last_name}";
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Total Price',
                'explanation' => 'Large banner comments hide a tiny implementation.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// PRICE CALCULATION
//
// Add subtotal.
//
// Add tax.
//
// Add shipping.
//
// Return the result.
//
// Calculation complete.
//
// Thank you for reading.
///////////////////////////////////////////////////////////
public function total(float $subtotal, float $tax, float $shipping): float
{
    return $subtotal + $tax + $shipping;
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Send Welcome Email',
                'explanation' => 'Comments simply restate what the code already says.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// Email Process
//
// Get the user's email.
//
// Send the welcome email.
//
// Finish the method.
//
// Nothing else happens.
//
// End.
///////////////////////////////////////////////////////////
public function sendWelcome(User $user): void
{
    Mail::to($user->email)
        ->send(new WelcomeMail($user));
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Count Orders',
                'explanation' => 'A trivial method with an unnecessarily large comment block.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// Order Counter
//
// Get every order.
//
// Count every order.
//
// Return the total.
//
// This method is very important.
//
// End documentation.
///////////////////////////////////////////////////////////
public function countOrders(): int
{
    return Order::count();
}
CODE,
                'answer' => 'Clutter',
            ],
            [
                'title' => 'Save User',
                'explanation' => 'The comments provide no additional value.',
                'code_snippet' => <<<'CODE'
///////////////////////////////////////////////////////////
// User Saving
//
// Save the user.
//
// Return the saved user.
//
// The save operation writes to the database.
//
// End.
//
// Really the end.
///////////////////////////////////////////////////////////
public function save(User $user): User
{
    $user->save();

    return $user;
}
CODE,
                'answer' => 'Clutter',
            ],
        ]);
    }
}
