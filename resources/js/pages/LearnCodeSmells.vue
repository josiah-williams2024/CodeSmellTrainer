<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import StudyCard from '@/components/StudyCard.vue';

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
    codeSmells: CodeSmell[];
}>();
</script>

<template>
    <Head title="Study"></Head>
    <main class="min-h-screen bg-background p-6">
        <div
            class="shawdow-lg mx-auto max-w-4xl rounded-2xl border border-border bg-card p-8"
        >
            <header class="mb-8">
                <h1 class="text-center text-3xl font-bold text-foreground"></h1>
            </header>

            <section class="space-y-6">
                <StudyCard
                    v-for="codeSmell in codeSmells"
                    :key="codeSmell.id"
                    :code-smell="codeSmell"
                />
            </section>
        </div>
    </main>
</template>
