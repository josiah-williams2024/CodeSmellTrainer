<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import LeaderboardCard from '@/components/ui/LeaderboardCard.vue';

type LeaderboardEntry = {
    rank: number;
    name: string;
    averageScore: number;
};

type DeckLeaderboard = {
    deck: {
        id: number;
        name: string;
    };
    leaderboard: LeaderboardEntry[];
};

defineProps<{
    leaderboards: DeckLeaderboard[];
}>();
</script>

<template>
    <Head title="Leaderboard"></Head>
    <main class="min-h-screen bg-background md:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-center text-3xl font-bold text-foreground">
                Leaderboard
            </h1>
        </header>
        <section
            class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <LeaderboardCard
                v-for="item in leaderboards"
                :key="item.deck.id"
                :title="`${item.deck.name}`"
                :leaderboard="item.leaderboard"
            />
        </section>
    </main>
</template>
