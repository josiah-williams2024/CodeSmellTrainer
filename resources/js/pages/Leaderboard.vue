<script setup lang="ts">
import { Head, usePoll, router } from '@inertiajs/vue3';
import {ref, watch} from 'vue';
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

const props = defineProps<{
    leaderboards: DeckLeaderboard[];
    period: string;
}>();

const selectedPeriod = ref(props.period);

watch(selectedPeriod, (period) => {
    router.get('/leaderboard', { period },
        {
         preserveState: true,
         preserveScroll: true,
         replace: true,
        }
    );
});


usePoll(3000, {
    only: ['leaderboards'],
});
</script>

<template>
    <Head title="Leaderboard" />

    <main class="min-h-screen bg-background p-4 sm:p-6 lg:p-8">
        <header class="relative mb-6 sm:mb-8">
            <h1
                class="text-center text-2xl font-bold text-foreground sm:text-3xl"
            >
                Leaderboard
            </h1>

            <select
                v-model="selectedPeriod"
                class="absolute top-0 right-0 rounded-md border-border bg-background px-3 py-2 text-sm"
            >
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="all">All time</option>
            </select>
        </header>

        <section
            class="mx-auto grid w-full max-w-6xl gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <LeaderboardCard
                v-for="item in leaderboards"
                :key="item.deck.id"
                :title="item.deck.name"
                :leaderboard="item.leaderboard"
            />
        </section>
    </main>
</template>
