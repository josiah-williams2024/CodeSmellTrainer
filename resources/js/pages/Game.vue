<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import gameController from '@/actions/App/Http/Controllers/GameController';

type Deck = {
    id: number;
    name: string;
    description: string;
};

defineProps<{
    decks: Deck[];
}>();
</script>

<template>
    <Head title="Game" />

    <main class="min-h-screen bg-background p-4 sm:p-6 lg:p-8">
        <header class="mb-6 sm:mb-8">
            <h1
                class="text-center text-2xl font-bold text-foreground sm:text-3xl"
            >
                Select a Deck
            </h1>
        </header>

        <section
            class="mx-auto grid w-full max-w-6xl gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <Link
                v-for="deck in decks"
                :key="deck.id"
                :href="gameController.show(deck.id)"
                class="flex min-h-64 flex-col rounded-xl border-2 border-border bg-card p-5 shadow-lg transition hover:border-primary hover:shadow-xl sm:p-6"
            >
                <h2
                    class="text-xl font-semibold text-card-foreground sm:text-2xl"
                >
                    {{ deck.name }}
                </h2>

                <p
                    class="mt-3 flex-1 text-sm text-muted-foreground sm:text-base"
                >
                    {{ deck.description }}
                </p>

                <span class="mt-6 font-medium text-primary">
                    Start Deck →
                </span>
            </Link>
        </section>
    </main>
</template>
