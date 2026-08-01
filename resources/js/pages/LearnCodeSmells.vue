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
    <Head title="Study" />

    <main class="min-h-screen bg-background p-4 sm:p-6 lg:p-8">
        <div
            class="mx-auto w-full max-w-4xl rounded-2xl border border-border bg-card p-6 shadow-lg sm:p-8"
        >
            <header class="mb-6">
                <h1
                    class="text-center text-2xl font-bold text-foreground sm:text-3xl"
                >
                    Study Code Smells
                </h1>
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
