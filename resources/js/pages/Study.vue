<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import StudyCard from '@/components/StudyCard.vue';
</script>

<template>
    <Head title="Study"></Head>
    <main class="min-h-screen bg-background p-6">
        <div
            class="shawdow-lg mx-auto max-w-4xl rounded-2xl border border-border bg-card p-8"
        >
            <header class="mb-8">
                <h1 class="text-center text-3xl font-bold text-foreground">
                    Study
                </h1>
            </header>

            <section class="space-y-6">
                <StudyCard />
                <StudyCard />
                <StudyCard />
            </section>
        </div>
    </main>
</template>
