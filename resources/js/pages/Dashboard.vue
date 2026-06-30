<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, game, stats, learncodesmells, leaderboard} from '@/routes';

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
    <main class="min-h-screen bg-slate-200 p-8">
        <header class="mb-10">
            <h1 class="text-center text-4xl font-bold">Code Smell Trainer</h1>
        </header>

        <section class="mx-auto grid max-w-5xl gap-6">

            <Link
                :href="game()"
                class="flex h-72 flex-col justify-center rounded-2xl border border-slate-300 bg-sky-100 p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:bg-sky-200 hover:shadow-xl"
            >
                <div class="text-6xl">🎮</div>

                <h2 class="mt-4 text-3xl font-bold">Play Game</h2>

                <p class="mt-2 text-slate-700">
                    Practice identifying code smells with interactive decks.
                </p>
            </Link>


            <div class="grid grid-cols-2 gap-6">
                <Link
                    :href="stats()"
                    class="flex h-56 flex-col justify-center rounded-2xl border border-slate-300 bg-sky-100 p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:bg-sky-200 hover:shadow-xl"
                >
                    <div class="text-5xl">📊</div>

                    <h2 class="mt-4 text-2xl font-bold">Statistics</h2>

                    <p class="mt-2 text-slate-700">
                        View your accuracy and progress.
                    </p>
                </Link>

                <Link
                    :href="leaderboard()"
                    class="flex h-56 flex-col justify-center rounded-2xl border border-slate-300 bg-sky-100 p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:bg-sky-200 hover:shadow-xl"
                >
                    <div class="text-5xl">🏆</div>

                    <h2 class="mt-4 text-2xl font-bold">Leaderboard</h2>

                    <p class="mt-2 text-slate-700">
                        Compare your score with other players.
                    </p>
                </Link>
            </div>


            <Link
                :href="learncodesmells()"
                class="flex h-72 flex-col justify-center rounded-2xl border border-slate-300 bg-sky-100 p-8 shadow-lg transition-all duration-200 hover:-translate-y-1 hover:bg-sky-200 hover:shadow-xl"
            >
                <div class="text-6xl">📚</div>

                <h2 class="mt-4 text-3xl font-bold">Study Code Smells</h2>

                <p class="mt-2 text-slate-700">
                    Learn each code smell with examples, explanations, and
                    refactorings.
                </p>
            </Link>
        </section>
    </main>
</template>


