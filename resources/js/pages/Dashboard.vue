<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import statsController from '@/actions/App/Http/Controllers/StatsController';
import { dashboard, game, learncodesmells, leaderboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard"></Head>
    <main class="min-h-screen bg-background p-8">
        <header class="mb-10">
            <h1 class="text-center text-4xl font-bold text-foreground">
                Code Smell Trainer
            </h1>
        </header>

        <section class="mx-auto grid max-w-5xl gap-6">
            <Link
                :href="game()"
                class="flex h-72 flex-col justify-center rounded-2xl border border-border bg-card p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:border-primary hover:shadow-xl"
            >
                <h2 class="mt-4 text-3xl font-bold text-card-foreground">
                    Play Game
                </h2>

                <p class="mt-2 text-muted-foreground">
                    Practice identifying code smells with interactive decks.
                </p>

                <span class="mt-6 font-medium text-primary">
                    Start Training →
                </span>
            </Link>

            <div class="grid grid-cols-2 gap-6">
                <Link
                    :href="statsController.index()"
                    class="flex h-56 flex-col justify-center rounded-2xl border border-border bg-card p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:border-primary hover:shadow-xl"
                >
                    <h2 class="mt-4 text-2xl font-bold text-card-foreground">
                        Statistics
                    </h2>

                    <p class="mt-2 text-muted-foreground">
                        View your accuracy and progress.
                    </p>

                    <span class="mt-6 font-medium text-primary">
                        Check Stats →
                    </span>
                </Link>

                <Link
                    :href="leaderboard()"
                    class="flex h-56 flex-col justify-center rounded-2xl border border-border bg-card p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:border-primary hover:shadow-xl"
                >
                    <h2 class="mt-4 text-2xl font-bold text-card-foreground">
                        Leaderboard
                    </h2>

                    <p class="mt-2 text-muted-foreground">
                        Compare your score with other players.
                    </p>
                    <span class="mt-6 font-medium text-primary">
                        View Leaderboard →
                    </span>
                </Link>
            </div>

            <Link
                :href="learncodesmells()"
                class="flex h-72 flex-col justify-center rounded-2xl border border-border bg-card p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:border-primary hover:shadow-xl"
            >
                <h2 class="mt-4 text-3xl font-bold text-card-foreground">
                    Study Code Smells
                </h2>

                <p class="mt-2 text-muted-foreground">
                    Learn each code smell with examples, explanations, and
                    refactorings.
                </p>

                <span class="mt-6 font-medium text-primary">
                    Start Learning →
                </span>
            </Link>
        </section>
    </main>
</template>
