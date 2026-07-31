<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import gameController from '@/actions/App/Http/Controllers/GameController';

defineProps<{
    deck: {
        id: number;
        name: string;
        cards: unknown[];
    };
    score: number;
    accuracy: number;
    formattedTime: string;
}>();
</script>

<template>
    <article
        class="flex h-[85vh] w-full max-w-7xl flex-col justify-between rounded-xl border border-border bg-card p-4 shadow-xl md:p-8"
    >
        <div
            class="flex flex-1 flex-col items-center justify-center text-center"
        >
            <h1 class="mb-4 text-4xl font-bold text-card-foreground">
                Deck Complete
            </h1>

            <p class="text-xl text-muted-foreground">
                Score: {{ score }} / {{ deck.cards.length }}
            </p>

            <p class="text-xl text-muted-foreground">
                Accuracy: {{ accuracy }}%
            </p>

            <p class="text-xl text-muted-foreground">
                Time: {{ formattedTime }}
            </p>
        </div>

        <div class="flex shrink-0 justify-center gap-4">
            <Link
                :href="gameController.show(deck.id)"
                class="w-40 rounded-lg bg-primary p-4 text-center font-medium text-primary-foreground transition-opacity hover:opacity-90"
            >
                Play Again
            </Link>

            <Link
                :href="gameController.index()"
                class="w-40 rounded-lg bg-primary p-4 text-center font-medium text-primary-foreground transition-opacity hover:opacity-90"
            >
                Pick New Deck
            </Link>
        </div>
    </article>
</template>
