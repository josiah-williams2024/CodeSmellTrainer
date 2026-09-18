<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import gameController from '@/actions/App/Http/Controllers/GameController';
import type { AnswerReview } from '@/types/game';
import GameAnswerReview from './GameAnswerReview.vue';

defineProps<{
    deck: {
        id: number;
        name: string;
        cards: unknown[];
    };
    score: number;
    accuracy: number;
    formattedTime: string;
    answerReviews: AnswerReview[];
}>();
</script>

<template>
    <article
        class="flex h-[95vh] w-full max-w-7xl flex-col rounded-xl border border-border bg-card p-4 shadow-xl md:p-8"
    >
        <div class="shrink-0 text-center">
            <h1 class="mb-3 text-4xl font-bold text-card-foreground">
                Deck Complete
            </h1>

            <div
                class="flex flex-wrap justify-center gap-x-6 gap-y-1 text-lg text-muted-foreground"
            >
                <span>Score: {{ score }} / {{ deck.cards.length }}</span>
                <span>Accuracy: {{ accuracy }}%</span>
                <span>Time: {{ formattedTime }}</span>
            </div>
        </div>

        <section class="mt-6 flex min-h-0 flex-1 flex-col">
            <div class="mb-3 flex items-baseline justify-between gap-4">
                <h2 class="text-2xl font-semibold text-card-foreground">
                    Review your answers
                </h2>
                <span class="text-sm text-muted-foreground">
                    {{ score }} correct · {{ answerReviews.length - score }}
                    missed
                </span>
            </div>

            <div class="min-h-0 flex-1 space-y-3 overflow-y-auto pr-1">
                <GameAnswerReview
                    v-for="(review, index) in answerReviews"
                    :key="review.card.id"
                    :review="review"
                    :card-number="index + 1"
                />
            </div>
        </section>

        <div class="mt-6 flex shrink-0 flex-wrap justify-center gap-4">
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
