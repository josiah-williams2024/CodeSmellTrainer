<script setup lang="ts">

type CodeSmell = {
    id: number;
    name: string;
    summary: string;
    content: string;
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
        </div>
        <div class="mt-6 flex gap-3">
            <button
                class="flex-1 rounded-md bg-primary px-4 py-2 text-primary-foreground transition hover:opacity-90"
            >
                Study
            </button>

            <button
                class="flex-1 rounded-md bg-primary px-4 py-2 text-primary-foreground transition hover:opacity-90"
            >
                Play
            </button>
        </div>
    </article>
</template>
