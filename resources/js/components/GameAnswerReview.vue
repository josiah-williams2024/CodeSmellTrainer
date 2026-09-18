<script setup lang="ts">
import type { AnswerReview } from '@/types/game';

defineProps<{
    review: AnswerReview;
    cardNumber: number;
}>();
</script>

<template>
    <details class="group rounded-lg border border-border bg-background">
        <summary
            class="flex cursor-pointer list-none items-center justify-between gap-4 p-4 marker:hidden"
        >
            <span class="font-medium text-card-foreground">
                Card {{ cardNumber }}
            </span>
            <span
                class="rounded-full px-3 py-1 text-sm font-medium"
                :class="
                    review.isCorrect
                        ? 'bg-emerald-500/15 text-emerald-400'
                        : 'bg-red-500/15 text-red-400'
                "
            >
                {{ review.isCorrect ? 'Correct' : 'Review' }}
            </span>
        </summary>

        <div class="space-y-4 border-t border-border p-4">
            <div
                class="overflow-x-auto rounded-lg bg-zinc-900"
                v-html="review.highlightedCode"
            ></div>

            <div class="grid gap-3 text-sm sm:grid-cols-2">
                <p>
                    <span class="text-muted-foreground">Your answer:</span>
                    <span
                        class="ml-2 font-medium"
                        :class="
                            review.isCorrect
                                ? 'text-emerald-400'
                                : 'text-red-400'
                        "
                    >
                        {{ review.selectedAnswer }}
                    </span>
                </p>
                <p v-if="!review.isCorrect">
                    <span class="text-muted-foreground">Correct answer:</span>
                    <span class="ml-2 font-medium text-emerald-400">
                        {{ review.card.answer }}
                    </span>
                </p>
            </div>

            <p class="text-sm leading-6 text-muted-foreground">
                {{ review.card.explanation }}
            </p>
        </div>
    </details>
</template>
