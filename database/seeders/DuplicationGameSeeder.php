<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Database\Seeder;

class DuplicationGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deck = Deck::firstOrCreate([
            'name' => 'Duplication Code Detection',
            'description' => 'This deck will allow the user to get better at recognizing duplicate code.',
            'code_smell_id' => '3',
        ]);

        $deck->cards()->createMany([
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
            ],[
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
            ],[
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
            ],[
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
            ],[
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
        ]);
    }
}
