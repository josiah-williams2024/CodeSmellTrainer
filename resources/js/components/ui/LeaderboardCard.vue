<script setup lang="ts">
type LeaderboardEntry = {
    rank: number;
    name: string;
    averageScore: number;
};

defineProps<{
    title: string;
    leaderboard: LeaderboardEntry[];
}>();
</script>

<template>
    <article
        class="flex min-h-64 flex-col rounded-xl border-2 border-primary bg-card p-5 shadow-xl sm:p-6"
    >
        <h2
            class="mb-4 text-xl font-semibold text-card-foreground sm:text-2xl"
        >
            {{ title }}
        </h2>
        <div class="overflow-y-auto pr-4 text-sm sm:text-base max-h-44">
            <div
                v-for="player in leaderboard"
                :key="player.rank"
                class="flex items-center justify-between gap-4 py-1"
            >
        <span class="min-w-0 truncate text-primary">
            {{ player.rank }}. {{ player.name }}
        </span>

                <span class="shrink-0 font-medium text-card-foreground">
            {{ player.averageScore.toFixed(2) }}
        </span>
            </div>

            <p
                v-if="leaderboard.length === 0"
                class="text-center text-muted-foreground"
            >
                No scores yet.
            </p>
        </div>
    </article>
</template>
