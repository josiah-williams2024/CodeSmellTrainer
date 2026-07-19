<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import LeaderboardCard from '@/components/ui/LeaderboardCard.vue';
type LeaderboardEntry = {
    rank: number;
    name: string;
    averageScore: number;
};

defineProps<{
    leaderboard: LeaderboardEntry[][];
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
                title="Long Method Leaderboard"
                :leaderboard="leaderboard[0]"
            />
            <LeaderboardCard
                title="Clutter Leaderboard"
                :leaderboard="leaderboard[1]"
            />
            <LeaderboardCard
                title="Duplication Leaderboard"
                :leaderboard="leaderboard[2]"
            />
        </section>
    </main>
</template>
