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
        $deck = Deck::create([
            'name' => 'Duplication Code Detection',
            'description' => 'This deck will allow the user to get better at recognizing duplicate code.',
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

    // Later in the method...

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

    // More business logic...

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

    // Much later...

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

    // More unrelated work...

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

    // Later...

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
                'title' => 'Duplicate Shipping Calculation',
                'explanation' => 'The shipping calculation has been copied instead of extracted into a reusable method.',
                'code_snippet' => <<<'CODE'
public function ship(Order $order): void
{
    $shipping = 15;

    if ($order->subtotal > 100) {
        $shipping = 0;
    }

    $order->shipping = $shipping;

    Log::info('Shipping calculated.');

    Mail::to($order->customer_email)
        ->send(new ShippingEstimateMail($order));

    Cache::forget('shipping');

    // More business logic...

    $shipping = 15;

    if ($order->subtotal > 100) {
        $shipping = 0;
    }

    Shipment::create([
        'order_id' => $order->id,
        'shipping' => $shipping,
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Repeated Product Total',
                'explanation' => 'The subtotal calculation appears twice.',
                'code_snippet' => <<<'CODE'
public function calculate(ProductOrder $order): void
{
    $subtotal = 0;

    foreach ($order->items as $item) {
        $subtotal += $item->price * $item->quantity;
    }

    Log::info('Subtotal calculated.');

    Cache::forget('products');

    event(new ProductCalculated());

    // More unrelated work...

    $subtotal = 0;

    foreach ($order->items as $item) {
        $subtotal += $item->price * $item->quantity;
    }

    Report::create([
        'subtotal' => $subtotal,
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Duplicate Role Assignment',
                'explanation' => 'The same role assignment logic exists twice.',
                'code_snippet' => <<<'CODE'
public function onboard(User $user): void
{
    if ($user->department === 'Sales') {
        $user->assignRole('sales');
    } else {
        $user->assignRole('employee');
    }

    Log::info('Role assigned.');

    Mail::to($user->email)
        ->send(new OnboardingMail());

    event(new UserOnboarded());

    // More code...

    if ($user->department === 'Sales') {
        $user->assignRole('sales');
    } else {
        $user->assignRole('employee');
    }

    AuditLog::create([
        'user_id' => $user->id,
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Repeated Inventory Check',
                'explanation' => 'Inventory validation is duplicated instead of reused.',
                'code_snippet' => <<<'CODE'
public function reserve(Product $product): void
{
    if ($product->quantity <= 0) {
        throw new Exception('Out of stock.');
    }

    $product->decrement('quantity');

    Log::info('Inventory updated.');

    Cache::forget('inventory');

    event(new InventoryReserved());

    // Additional processing...

    if ($product->quantity <= 0) {
        throw new Exception('Out of stock.');
    }

    Reservation::create([
        'product_id' => $product->id,
    ]);
}
CODE,
                'answer' => 'Duplicate Code',
            ],
            [
                'title' => 'Duplicate Report Generation',
                'explanation' => 'The report-building logic has been copied.',
                'code_snippet' => <<<'CODE'
public function generate(): void
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

    Log::info('Daily report generated.');

    Mail::to('admin@example.com')
        ->send(new ReportMail($report));

    // Later in the same method...

    $report = [
        'users' => User::count(),
        'orders' => Order::count(),
        'sales' => Sale::sum('amount'),
    ];

    Storage::put(
        'reports/archive.json',
        json_encode($report)
    );
}
CODE,
                'answer' => 'Duplicate Code',
            ],

        ]);
    }
}
