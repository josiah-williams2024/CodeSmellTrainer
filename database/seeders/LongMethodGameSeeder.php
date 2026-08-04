<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Database\Seeder;

class LongMethodGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $deck = Deck::firstOrCreate([
            'name' => 'Long Method Detection',
            'description' => 'This deck will allow the user to get better at recognizing long methods',
            'code_smell_id' => '1',

        ]);

        $deck->cards()->createMany([
            [
                'title' => 'Order Processing Service',
                'explanation' => 'Validation, creation, role assignment, emailing and logging are all handled together.',
                'code_snippet' => <<<'CODE'
public function processOrder(Order $order): void
{
    $subtotal = 0;

    foreach ($order->items as $item) {
        $subtotal += $item->price * $item->quantity;
    }

    $tax = $subtotal * 0.13;
    $shipping = 15;

    if ($subtotal > 100) {
        $shipping = 0;
    }

    $total = $subtotal + $tax + $shipping;

    Mail::to($order->customer_email)
        ->send(new OrderConfirmationMail($order));

    Log::info('Order processed', [
        'order_id' => $order->id,
        'total' => $total,
    ]);

    $order->update([
        'subtotal' => $subtotal,
        'tax' => $tax,
        'shipping' => $shipping,
        'total' => $total,
        'status' => 'processed',
    ]);
}
CODE,
                'answer' => 'Long Method',
            ],
            [
                'title' => 'Tax Calculation Helper',
                'explanation' => 'Single responsibility and very small.',
                'code_snippet' => <<<'CODE'
public function calculateTax(float $subtotal): float
{
    return $subtotal * 0.13;
}
CODE,
                'answer' => 'Short Method',
            ],
            [
                'title' => 'Monthly Report Generator',
                'explanation' => 'Collects data, builds report, stores file, emails report, and logs.',
                'code_snippet' => <<<'CODE'
public function generateMonthlyReport(): void
{
    $users = User::all();

    $activeUsers = $users->where('active', true)->count();
    $inactiveUsers = $users->where('active', false)->count();

    $sales = Sale::sum('amount');
    $orders = Order::count();

    $report = [
        'active_users' => $activeUsers,
        'inactive_users' => $inactiveUsers,
        'sales' => $sales,
        'orders' => $orders,
    ];

    Storage::put(
        'reports/monthly.json',
        json_encode($report)
    );

    Mail::to('admin@example.com')
        ->send(new MonthlyReportMail($report));

    Log::info('Monthly report generated');
}
CODE,
                'answer' => 'Long Method',
            ],
            [
                'title' => 'Generate User Report',
                'explanation' => 'This method validates input, queries data, formats results, sends email, and logs activity. It has multiple responsibilities.',
                'code_snippet' => <<<'CODE'
public function generateReport(int $userId): void
{
    $user = User::findOrFail($userId);

    $orders = Order::query()
        ->where('user_id', $user->id)
        ->get();

    $total = 0;

    foreach ($orders as $order) {
        $total += $order->total;
    }

    $report = [
        'user' => $user->name,
        'orders' => $orders->count(),
        'total' => $total,
    ];

    Mail::to($user->email)
        ->send(new ReportMail($report));

    Log::info('Report generated', [
        'user_id' => $user->id,
    ]);
}
CODE,
                'answer' => 'Long Method',
            ],
            [
                'title' => 'Calculate Tax',
                'explanation' => 'One responsibility and only a very few lines.',
                'code_snippet' => <<<'CODE'
public function calculateTax(float $amount): float
{
    return $amount * 0.13;
}
CODE,
                'answer' => 'Short Method',
            ],
            [
                'title' => 'Process Refund',
                'explanation' => 'Handles validation, payment processing, notifications, and logging in one method.',
                'code_snippet' => <<<'CODE'
public function processRefund(Order $order): void
{
    if ($order->status !== 'paid') {
        throw new Exception('Invalid order');
    }

    $refundAmount = $order->total;

    PaymentGateway::refund(
        $order->transaction_id,
        $refundAmount
    );

    $order->update([
        'status' => 'refunded',
    ]);

    Mail::to($order->customer_email)
        ->send(new RefundMail($order));

    Log::info('Refund processed', [
        'order_id' => $order->id,
    ]);
}
CODE,
                'answer' => 'Long Method',
            ],
            [
                'title' => 'Register Customer',
                'explanation' => 'Validation, creation, role assignment, notification, and logging are all mixed together.',
                'code_snippet' => <<<'CODE'
public function registerCustomer(array $data): User
{
    Validator::make($data, [
        'name' => 'required',
        'email' => 'required|email',
    ])->validate();

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);

    $user->assignRole('customer');

    Mail::to($user->email)
        ->send(new WelcomeMail($user));

    Log::info('Customer registered', [
        'user_id' => $user->id,
    ]);

    return $user;
}
CODE,
                'answer' => 'Long Method',
            ],
            [
                'title' => 'Format Username',
                'explanation' => 'Simple transformation with a single purpose.',
                'code_snippet' => <<<'CODE'
public function formatUsername(string $name): string
{
    return strtolower(trim($name));
}
CODE,
                'answer' => 'Short Method',
            ],
            [
                'title' => 'Is Adult',
                'explanation' => 'Single condition and very focused.',
                'code_snippet' => <<<'CODE'
public function isAdult(int $age): bool
{
    return $age >= 18;
}
CODE,
                'answer' => 'Short Method',
            ],
            [
                'title' => 'Create Invoice',
                'explanation' => 'Build invoice data, calculates totals, stores records, send emails, and log actions.',
                'code_snippet' => <<<'CODE'
public function createInvoice(Order $order): void
{
    $subtotal = 0;

    foreach ($order->items as $item) {
        $subtotal += $item->price * $item->quantity;
    }

    $tax = $subtotal * 0.13;

    $invoice = Invoice::create([
        'order_id' => $order->id,
        'subtotal' => $subtotal,
        'tax' => $tax,
        'total' => $subtotal + $tax,
    ]);

    Mail::to($order->customer_email)
        ->send(new InvoiceMail($invoice));

    Log::info('Invoice created', [
        'invoice_id' => $invoice->id,
    ]);
}
CODE,
                'answer' => 'Long Method',
            ],
        ]);

    }
}
