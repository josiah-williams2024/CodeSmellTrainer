<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import StatsCard from '@/components/ui/StatsCard.vue';

type Stats = {
    id: number;
    name: string;
    gamesPlayed: number | null;
    totalPlaytime: number | null;
    averageAccuracy: number | null;
    averageScore: number | null;
    averageTime: number | null;
};

defineProps<{
    stats: Stats[];
}>();
</script>

<template>
    <Head title="Stats"></Head>
    <main class="min-h-screen bg-background md:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-center text-3xl font-bold text-foreground">
                Deck Stats
            </h1>
        </header>

        <section
            class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <StatsCard
                v-for="stat in stats"
                :key="stat.id"
                :stats="stat"
            />
        </section>
    </main>
</template>

<style scoped></style>
