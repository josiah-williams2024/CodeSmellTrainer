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
    <article class="rounded-xl border border-border bg-background p-6">
        <div class="space-y-6">
            <h2 class="text-2xl font-semibold text-card-foreground">
                {{ codeSmell.name }}
            </h2>
            <p class="flex-1 text-sm leading-6 text-muted-foreground">
                {{ codeSmell.summary }}
            </p>
            <p class="flex-1 text-sm leading-6 text-muted-foreground">
                {{ codeSmell.content }}
            </p>
        </div>
        <div class="mt-6 flex gap-3">
            <a
                :href="codeSmell.reference_url"
                target="_blank"
                rel="noopener noreferrer"
                class="flex-1 rounded-md bg-primary px-4 py-2 text-primary-foreground transition hover:opacity-90"
            >
                Study
            </a>

            <Link
                :href="gameController.show(codeSmell.deck.id)"
                class="flex-1 rounded-md bg-primary px-4 py-2 text-primary-foreground transition hover:opacity-90"
            >
                Play
            </Link>
        </div>
    </article>
</template>
