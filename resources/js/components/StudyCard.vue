<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import gameController from '@/actions/App/Http/Controllers/GameController';

type CodeSmell = {
    id: number;
    name: string;
    summary: string;
    content: string;
    reference_url: string;
    deck: {
        id: number;
    };
};
defineProps<{
    codeSmell: CodeSmell;
}>();
</script>

<template>
    <article class="rounded-xl border border-border bg-background p-5 sm:p-6">
        <div class="space-y-5 sm:space-y-6">
            <h2 class="text-xl font-semibold text-card-foreground sm:text-2xl">
                {{ codeSmell.name }}
            </h2>

            <p class="text-sm leading-6 text-muted-foreground">
                {{ codeSmell.summary }}
            </p>

            <p class="text-sm leading-6 text-muted-foreground">
                {{ codeSmell.content }}
            </p>
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
            <a
                :href="codeSmell.reference_url"
                target="_blank"
                rel="noopener noreferrer"
                class="flex min-h-11 w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-center text-primary-foreground transition hover:opacity-90 sm:flex-1"
            >
                Learn More
            </a>

            <Link
                :href="gameController.show(codeSmell.deck.id)"
                class="flex min-h-11 w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-center text-primary-foreground transition hover:opacity-90 sm:flex-1"
            >
                Play
            </Link>
        </div>
    </article>
</template>
