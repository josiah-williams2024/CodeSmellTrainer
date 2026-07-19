<script setup lang="ts">

type DeckStats = {
    id: number | null;
    name: string | null;
    gamesPlayed: number | null;
    totalPlaytime: number | null;
    averageAccuracy: number | null;
    averageScore: number | null;
    averageTime:number | null;
}

const props = defineProps<{
        title: string;
        stats: DeckStats;
    }>();

    const formatStats = (value: number | null, suffix = '') => {
        return value != null ? `${value.toFixed(2)}${suffix}` : '--';
    }

</script>

<template>
    <article
        class="flex h-64 flex-col rounded-xl border-2 border-primary bg-card p-6 shadow-xl"    >
        <h2  class="mb-3 text-2xl font-semibold">
            {{props.title}}
        </h2>

        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-primary">Total Games Played:</span>
                <span class=" font-medium text-card-foreground">{{formatStats(props.stats.gamesPlayed)}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-primary">Total Play Time:</span>
                <span class="font-medium text-card-foreground">{{formatStats(props.stats.totalPlaytime,'s')}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-primary">Average Accuracy:</span>
                <span class="font-medium text-card-foreground">{{formatStats(props.stats.averageAccuracy, '%')}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-primary">Average Score:</span>
                <span class="font-medium text-card-foreground">{{formatStats(props.stats.averageScore, '/10.0')}}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-primary">Average Time:</span>
                <span class="font-medium text-card-foreground">{{formatStats(props.stats.averageTime,'s')}}</span>
            </div>
        </div>
    </article>

</template>


