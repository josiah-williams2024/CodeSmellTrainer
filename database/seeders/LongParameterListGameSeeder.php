<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Database\Seeder;

class LongParameterListGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deck = Deck::firstOrCreate([
            'name' => 'Long Parameter List Code Detection',
        ], [
            'description' => 'This deck helps users recognize methods with excessive parameter lists and distinguish them from methods with a reasonable number of parameters.',
            'code_smell_id' => 5,
        ]);

        $deck->cards()->createMany([
            [
                'title' => 'Create User',
                'explanation' => 'The method requires too many individual values to create a user.',
                'code_snippet' => <<<'CODE'
public function createUser(
    string $firstName,
    string $lastName,
    string $email,
    string $phone,
    string $street,
    string $city,
    string $province,
    string $postalCode
): User
{
    return User::create([
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'phone' => $phone,
        'street' => $street,
        'city' => $city,
        'province' => $province,
        'postal_code' => $postalCode,
    ]);
}
CODE,
                'answer' => 'Long Parameter List',
            ],
            [
                'title' => 'Generate Invoice',
                'explanation' => 'Numerous related values are passed individually instead of being grouped.',
                'code_snippet' => <<<'CODE'
public function generateInvoice(
    int $customerId,
    float $subtotal,
    float $tax,
    float $shipping,
    float $discount,
    string $currency,
    string $paymentMethod
): Invoice
{
    return new Invoice();
}
CODE,
                'answer' => 'Long Parameter List',
            ],
            [
                'title' => 'Book Appointment',
                'explanation' => 'The appointment information results in a lengthy parameter list.',
                'code_snippet' => <<<'CODE'
public function bookAppointment(
    int $doctorId,
    int $patientId,
    string $date,
    string $time,
    string $reason,
    bool $virtual,
    string $notes
): Appointment
{
    return new Appointment();
}
CODE,
                'answer' => 'Long Parameter List',
            ],
            [
                'title' => 'Create Product',
                'explanation' => 'The method accepts many values that could potentially be grouped together.',
                'code_snippet' => <<<'CODE'
public function createProduct(
    string $name,
    string $description,
    float $price,
    int $stock,
    string $sku,
    float $weight,
    string $category,
    bool $featured
): Product
{
    return new Product();
}
CODE,
                'answer' => 'Long Parameter List',
            ],
            [
                'title' => 'Register Employee',
                'explanation' => 'Too many individual arguments make the method difficult to read and call correctly.',
                'code_snippet' => <<<'CODE'
public function registerEmployee(
    string $firstName,
    string $lastName,
    string $email,
    string $phone,
    string $department,
    string $jobTitle,
    float $salary,
    string $manager
): Employee
{
    return new Employee();
}
CODE,
                'answer' => 'Long Parameter List',
            ],
            [
                'title' => 'Calculate Tax',
                'explanation' => 'The method has a small, easy-to-understand parameter list.',
                'code_snippet' => <<<'CODE'
public function calculateTax(
    float $subtotal,
    float $taxRate
): float
{
    return $subtotal * $taxRate;
}
CODE,
                'answer' => 'Not Long Parameter List',
            ],
            [
                'title' => 'Login User',
                'explanation' => 'Only the required credentials are provided.',
                'code_snippet' => <<<'CODE'
public function login(
    string $email,
    string $password
): bool
{
    return Auth::attempt([
        'email' => $email,
        'password' => $password,
    ]);
}
CODE,
                'answer' => 'Not Long Parameter List',
            ],
            [
                'title' => 'Delete User',
                'explanation' => 'A single model provides all of the required information.',
                'code_snippet' => <<<'CODE'
public function delete(User $user): void
{
    $user->delete();
}
CODE,
                'answer' => 'Not Long Parameter List',
            ],
            [
                'title' => 'Update Inventory',
                'explanation' => 'The method receives only the values it actually needs.',
                'code_snippet' => <<<'CODE'
public function updateInventory(
    Product $product,
    int $quantity
): void
{
    $product->increment('stock', $quantity);
}
CODE,
                'answer' => 'Not Long Parameter List',
            ],
            [
                'title' => 'Send Welcome Email',
                'explanation' => 'A concise parameter list keeps the method simple to understand.',
                'code_snippet' => <<<'CODE'
public function sendWelcomeEmail(
    User $user,
    bool $includeDiscount
): void
{
    Mail::to($user)->send(
        new WelcomeEmail($includeDiscount)
    );
}
CODE,
                'answer' => 'Not Long Parameter List',
            ],
        ]);
    }
}
