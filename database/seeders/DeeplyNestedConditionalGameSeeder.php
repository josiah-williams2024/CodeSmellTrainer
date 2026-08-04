<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeeplyNestedConditionalGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deck = Deck::firstOrCreate([
            'name' => 'Nested Conditionals Code Detection',
        ], [
            'description' => 'This deck helps users recognize deeply nested conditionals and distinguish them from cleaner guard clause implementations.',
            'code_smell_id' => 4,
        ]);

        $deck->cards()->createMany([
            [
                'title' => 'Process Refund',
                'explanation' => 'Multiple nested conditions make the happy path difficult to follow.',
                'code_snippet' => <<<'CODE'
public function refund(Order $order): bool
{
    if ($order->isPaid()) {
        if (!$order->isRefunded()) {
            if ($order->isWithinRefundWindow()) {
                if ($order->customer()->isVerified()) {
                    return true;
                }
            }
        }
    }

    return false;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
            [
                'title' => 'Publish Article',
                'explanation' => 'The publishing logic is hidden inside several nested if statements.',
                'code_snippet' => <<<'CODE'
public function publish(Article $article): bool
{
    if ($article->isDraft()) {
        if ($article->hasTitle()) {
            if ($article->hasContent()) {
                if ($article->author()->isVerified()) {
                    return true;
                }
            }
        }
    }

    return false;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
            [
                'title' => 'Approve Loan',
                'explanation' => 'Every business rule adds another indentation level.',
                'code_snippet' => <<<'CODE'
public function approve(LoanApplication $application): bool
{
    if ($application->hasIncome()) {
        if ($application->creditScore() >= 700) {
            if (!$application->hasOutstandingDebt()) {
                if ($application->identityVerified()) {
                    return true;
                }
            }
        }
    }

    return false;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
            [
                'title' => 'Delete Account',
                'explanation' => 'Nested conditions obscure the intent of the method.',
                'code_snippet' => <<<'CODE'
public function delete(User $user): bool
{
    if ($user->isActive()) {
        if (!$user->hasOutstandingInvoices()) {
            if (!$user->ownsProjects()) {
                if ($user->confirmedDeletion()) {
                    return true;
                }
            }
        }
    }

    return false;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
            [
                'title' => 'Checkout Order',
                'explanation' => 'Several levels of nesting reduce readability.',
                'code_snippet' => <<<'CODE'
public function checkout(Cart $cart): bool
{
    if (!$cart->isEmpty()) {
        if ($cart->customer()->isVerified()) {
            if ($cart->hasShippingAddress()) {
                if ($cart->paymentMethod() !== null) {
                    return true;
                }
            }
        }
    }

    return false;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
            [
                'title' => 'Process Refund (Guard Clauses)',
                'explanation' => 'Guard clauses keep the happy path easy to read.',
                'code_snippet' => <<<'CODE'
public function refund(Order $order): bool
{
    if (!$order->isPaid()) {
        return false;
    }

    if ($order->isRefunded()) {
        return false;
    }

    if (!$order->isWithinRefundWindow()) {
        return false;
    }

    if (!$order->customer()->isVerified()) {
        return false;
    }

    return true;
}
CODE,
                'answer' => 'Not Nested Conditionals',
            ],
            [
                'title' => 'Publish Article (Guard Clauses)',
                'explanation' => 'Early returns remove unnecessary nesting.',
                'code_snippet' => <<<'CODE'
public function publish(Article $article): bool
{
    if (!$article->isDraft()) {
        return false;
    }

    if (!$article->hasTitle()) {
        return false;
    }

    if (!$article->hasContent()) {
        return false;
    }

    if (!$article->author()->isVerified()) {
        return false;
    }

    return true;
}
CODE,
                'answer' => 'Not Nested Conditionals',
            ],
            [
                'title' => 'Approve Loan (Guard Clauses)',
                'explanation' => 'Each failing condition exits immediately.',
                'code_snippet' => <<<'CODE'
public function approve(LoanApplication $application): bool
{
    if (!$application->hasIncome()) {
        return false;
    }

    if ($application->creditScore() < 700) {
        return false;
    }

    if ($application->hasOutstandingDebt()) {
        return false;
    }

    if (!$application->identityVerified()) {
        return false;
    }

    return true;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
            [
                'title' => 'Delete Account (Guard Clauses)',
                'explanation' => 'Guard clauses clearly communicate the required conditions.',
                'code_snippet' => <<<'CODE'
public function delete(User $user): bool
{
    if (!$user->isActive()) {
        return false;
    }

    if ($user->hasOutstandingInvoices()) {
        return false;
    }

    if ($user->ownsProjects()) {
        return false;
    }

    if (!$user->confirmedDeletion()) {
        return false;
    }

    return true;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
            [
                'title' => 'Checkout Order (Guard Clauses)',
                'explanation' => 'The happy path is immediately visible after the guard clauses.',
                'code_snippet' => <<<'CODE'
public function checkout(Cart $cart): bool
{
    if ($cart->isEmpty()) {
        return false;
    }

    if (!$cart->customer()->isVerified()) {
        return false;
    }

    if (!$cart->hasShippingAddress()) {
        return false;
    }

    if ($cart->paymentMethod() === null) {
        return false;
    }

    return true;
}
CODE,
                'answer' => 'Nested Conditionals',
            ],
        ]);
    }
}
