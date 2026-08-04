<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Database\Seeder;

class MagicNumberGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deck = Deck::firstOrCreate([
            'name' => 'Magic Numbers Code Detection',
        ], [
            'description' => 'This deck helps users recognize hardcoded numeric values and distinguish them from named constants.',
            'code_smell_id' => 6,
        ]);

        $deck->cards()->createMany([
            [
                'title' => 'Adult Age Check',
                'explanation' => 'The age requirement is hardcoded instead of using a named constant.',
                'code_snippet' => <<<'CODE'
public function isAdult(User $user): bool
{
    return $user->age >= 18;
}
CODE,
                'answer' => 'Magic Numbers',
            ],
            [
                'title' => 'Free Shipping',
                'explanation' => 'The free shipping threshold appears as a literal value.',
                'code_snippet' => <<<'CODE'
public function shippingCost(float $subtotal): float
{
    if ($subtotal >= 100) {
        return 0;
    }

    return 15;
}
CODE,
                'answer' => 'Magic Numbers',
            ],
            [
                'title' => 'Maximum Login Attempts',
                'explanation' => 'The maximum number of retries is embedded directly in the code.',
                'code_snippet' => <<<'CODE'
public function isLockedOut(User $user): bool
{
    return $user->failed_attempts >= 5;
}
CODE,
                'answer' => 'Magic Numbers',
            ],
            [
                'title' => 'Order Status',
                'explanation' => 'The numeric status value does not explain its meaning.',
                'code_snippet' => <<<'CODE'
public function isCompleted(Order $order): bool
{
    return $order->status === 4;
}
CODE,
                'answer' => 'Magic Numbers',
            ],
            [
                'title' => 'Password Length',
                'explanation' => 'The minimum password length is hardcoded.',
                'code_snippet' => <<<'CODE'
public function passwordIsValid(string $password): bool
{
    return strlen($password) >= 8;
}
CODE,
                'answer' => 'Magic Numbers',
            ],
            [
                'title' => 'Adult Age Constant',
                'explanation' => 'A named constant clearly communicates the minimum age.',
                'code_snippet' => <<<'CODE'
class UserPolicy
{
    private const ADULT_AGE = 18;

    public function isAdult(User $user): bool
    {
        return $user->age >= self::ADULT_AGE;
    }
}
CODE,
                'answer' => 'Not Magic Numbers',
            ],
            [
                'title' => 'Free Shipping Constant',
                'explanation' => 'Named constants make business rules easier to understand.',
                'code_snippet' => <<<'CODE'
class ShippingCalculator
{
    private const FREE_SHIPPING_THRESHOLD = 100;
    private const STANDARD_SHIPPING_COST = 15;

    public function shippingCost(float $subtotal): float
    {
        if ($subtotal >= self::FREE_SHIPPING_THRESHOLD) {
            return 0;
        }

        return self::STANDARD_SHIPPING_COST;
    }
}
CODE,
                'answer' => 'Not Magic Numbers',
            ],
            [
                'title' => 'Login Attempt Constant',
                'explanation' => 'The retry limit is represented by a descriptive constant.',
                'code_snippet' => <<<'CODE'
class LoginService
{
    private const MAX_LOGIN_ATTEMPTS = 5;

    public function isLockedOut(User $user): bool
    {
        return $user->failed_attempts >= self::MAX_LOGIN_ATTEMPTS;
    }
}
CODE,
                'answer' => 'Not Magic Numbers',
            ],
            [
                'title' => 'Order Status Constant',
                'explanation' => 'The status value has been replaced with a meaningful constant.',
                'code_snippet' => <<<'CODE'
class Order
{
    public const STATUS_COMPLETED = 4;

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}
CODE,
                'answer' => 'Not Magic Numbers',
            ],
            [
                'title' => 'Password Length Constant',
                'explanation' => 'A named constant makes the password requirement self-documenting.',
                'code_snippet' => <<<'CODE'
class PasswordValidator
{
    private const MIN_PASSWORD_LENGTH = 8;

    public function passwordIsValid(string $password): bool
    {
        return strlen($password) >= self::MIN_PASSWORD_LENGTH;
    }
}
CODE,
                'answer' => 'Not Magic Numbers',
            ],
        ]);
    }
}
