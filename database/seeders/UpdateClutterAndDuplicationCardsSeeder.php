<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class UpdateClutterAndDuplicationCardsSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $this->updateDuplicationDeck();
            $this->updateClutterDeck();
        });
    }

    private function updateDuplicationDeck(): void
    {
        $deck = Deck::query()
            ->where('code_smell_id', 3)
            ->first();

        if (! $deck) {
            throw new RuntimeException(
                'The Duplication Code Detection deck could not be found.'
            );
        }

        $deck->update([
            'name' => 'Duplication Code Detection',
            'description' => 'This deck will allow the user to get better at recognizing duplicate code.',
        ]);

        $cards = [
            [
                'title' => 'Duplicate Order Total Calculation',
                'explanation' => 'The order total calculation has been copied instead of extracted into a reusable method.',
                'code_snippet' => <<<'CODE'
public function processOrder(Order $order): void
{
    $subtotal = 0;

    foreach ($order->items as $item) {
        $subtotal += $item->price * $item->quantity;
    }

    $tax = $subtotal * 0.13;
    $shipping = $subtotal > 100 ? 0 : 15;
    $total = $subtotal + $tax + $shipping;

    Log::info('Order total calculated.');

    Mail::to($order->customer_email)
        ->send(new OrderConfirmationMail($order));

    Cache::forget('orders');

    $order->update([
        'status' => 'processed',
    ]);

    $subtotal = 0;

    foreach ($order->items as $item) {
        $subtotal += $item->price * $item->quantity;
    }

    $tax = $subtotal * 0.13;
    $shipping = $subtotal > 100 ? 0 : 15;
    $total = $subtotal + $tax + $shipping;

    Invoice::create([
        'order_id' => $order->id,
        'total' => $total,
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Repeated User Validation',
                'explanation' => 'The same validation rules appear twice.',
                'code_snippet' => <<<'CODE'
public function register(array $data): void
{
    Validator::make($data, [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ])->validate();

    User::create($data);

    Log::info('User created.');

    Mail::to($data['email'])
        ->send(new WelcomeMail());

    Validator::make($data, [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ])->validate();

    Profile::create([
        'email' => $data['email'],
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Duplicate Invoice Creation',
                'explanation' => 'Invoice data is assembled twice instead of using a helper.',
                'code_snippet' => <<<'CODE'
public function createInvoices(Order $order): void
{
    $invoice = [
        'order_id' => $order->id,
        'subtotal' => $order->subtotal,
        'tax' => $order->tax,
        'total' => $order->total,
    ];

    Invoice::create($invoice);

    Log::info('Invoice saved.');

    event(new InvoiceCreated());

    Cache::forget('invoices');

    $invoice = [
        'order_id' => $order->id,
        'subtotal' => $order->subtotal,
        'tax' => $order->tax,
        'total' => $order->total,
    ];

    ArchiveInvoice::create($invoice);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Repeated Discount Logic',
                'explanation' => 'The discount calculation is copied instead of reused.',
                'code_snippet' => <<<'CODE'
public function checkout(Order $order): void
{
    if ($order->subtotal > 200) {
        $discount = 25;
    } elseif ($order->subtotal > 100) {
        $discount = 10;
    } else {
        $discount = 0;
    }

    $order->discount = $discount;

    Log::info('Discount applied.');

    Mail::to($order->customer_email)
        ->send(new DiscountAppliedMail());

    if ($order->subtotal > 200) {
        $discount = 25;
    } elseif ($order->subtotal > 100) {
        $discount = 10;
    } else {
        $discount = 0;
    }

    Reward::create([
        'discount' => $discount,
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Copied Email Sending Logic',
                'explanation' => 'The same email sending routine is duplicated.',
                'code_snippet' => <<<'CODE'
public function notifyCustomer(Order $order): void
{
    Mail::to($order->customer_email)
        ->send(new OrderReadyMail($order));

    Log::info('Customer notified.');

    Cache::forget('notifications');

    event(new CustomerNotified());

    $order->update([
        'notified' => true,
    ]);

    Mail::to($order->customer_email)
        ->send(new OrderReadyMail($order));

    NotificationLog::create([
        'order_id' => $order->id,
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Calculate Order Total',
                'explanation' => 'The calculation appears only once and has not been copied.',
                'code_snippet' => <<<'CODE'
public function calculateTotal(Order $order): float
{
    $subtotal = 0;

    foreach ($order->items as $item) {
        $subtotal += $item->price * $item->quantity;
    }

    $tax = $subtotal * 0.13;

    return $subtotal + $tax;
}
CODE,
                'answer' => 'Not Duplicate Code',
            ],
            [
                'title' => 'Register Customer',
                'explanation' => 'Validation occurs once and is not repeated elsewhere in the method.',
                'code_snippet' => <<<'CODE'
public function register(array $data): User
{
    Validator::make($data, [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ])->validate();

    return User::create($data);
}
CODE,
                'answer' => 'Not Duplicate Code',
            ],
            [
                'title' => 'Send Welcome Email',
                'explanation' => 'The email is sent once without any repeated logic.',
                'code_snippet' => <<<'CODE'
public function sendWelcome(User $user): void
{
    Mail::to($user->email)
        ->send(new WelcomeMail($user));

    Log::info('Welcome email sent.');
}
CODE,
                'answer' => 'Not Duplicate Code',
            ],
            [
                'title' => 'Generate Daily Report',
                'explanation' => 'The report is built a single time with no copied sections.',
                'code_snippet' => <<<'CODE'
public function generateReport(): void
{
    $report = [
        'users' => User::count(),
        'orders' => Order::count(),
        'sales' => Sale::sum('amount'),
    ];

    Storage::put(
        'reports/daily.json',
        json_encode($report)
    );
}
CODE,
                'answer' => 'Not Duplicate Code',
            ],
            [
                'title' => 'Assign User Role',
                'explanation' => 'The role assignment logic exists in only one place.',
                'code_snippet' => <<<'CODE'
public function assignRole(User $user): void
{
    if ($user->department === 'Sales') {
        $user->assignRole('sales');
    } else {
        $user->assignRole('employee');
    }

    Log::info('Role assigned.');
}
CODE,
                'answer' => 'Not Duplicate Code',
            ],
        ];

        $this->updateCards($deck, $cards);
    }

    private function updateClutterDeck(): void
    {
        $deck = Deck::query()
            ->where('code_smell_id', 2)
            ->first();

        if (! $deck) {
            throw new RuntimeException(
                'The Clutter Code Detection deck could not be found.'
            );
        }

        $deck->update([
            'name' => 'Clutter Code Detection',
            'description' => 'This deck will allow the user to get better at recognizing excessive and unnecessary clutter.',
        ]);

        $cards = [
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
        ];

        $this->updateCards($deck, $cards);
    }

    private function updateCards(Deck $deck, array $cards): void
    {
        foreach ($cards as $card) {
            $deck->cards()->updateOrCreate(
                [
                    'title' => $card['title'],
                ],
                [
                    'explanation' => $card['explanation'],
                    'code_snippet' => $card['code_snippet'],
                    'answer' => $card['answer'],
                ],
            );
        }
    }
}
