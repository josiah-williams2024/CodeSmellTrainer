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
        class="flex h-64 flex-col rounded-xl border-2 border-primary bg-card p-6 shadow-xl"
    >
        <h2 class="mb-4 text-2xl font-semibold">
            {{ title }}
        </h2>

        <div class="flex flex-1 flex-col justify-between">
            <div
                v-for="rank in 5"
                :key="rank"
                class="flex justify-between border-b pb-2"
            >
                <template v-if="leaderboard[rank - 1]">
                    <span class="text-primary">
                        {{ rank }}. {{ leaderboard[rank - 1].name }}
                    </span>

                    <span class="font-medium text-card-foreground">
                        {{ leaderboard[rank - 1].averageScore.toFixed(2) }}
                    </span>
                </template>

                <template v-else>
                    <span class="text-primary">
                        {{ rank }}. --
                    </span>

                    <span class="font-medium text-card-foreground">
                        --
                    </span>
                </template>
            </div>
        </div>
    </article>
</template>
