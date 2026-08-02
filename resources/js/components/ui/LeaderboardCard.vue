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

        <div class="flex flex-1 flex-col justify-between text-sm sm:text-base">
            <div
                v-for="rank in 5"
                :key="rank"
                class="flex items-start justify-between gap-4 pb-2"
            >
                <template v-if="leaderboard[rank - 1]">
                    <span class="min-w-0 truncate text-primary">
                        {{ rank }}. {{ leaderboard[rank - 1].name }}
                    </span>

                    <span class="shrink-0 font-medium text-card-foreground">
                        {{ leaderboard[rank - 1].averageScore.toFixed(2) }}
                    </span>
                </template>

                <template v-else>
                    <span class="text-primary">{{ rank }}. --</span>

                    <span class="shrink-0 font-medium text-card-foreground">
                        --
                    </span>
                </template>
            </div>
        </div>
    </article>
</template>
