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
        return value != null ? `${value}${suffix}` : '--';
    }

</script>

<template>
    <article
        class="flex h-64 flex-col rounded-xl border-2 border-slate-500 bg-slate-100 p-6 shadow-lg transition hover:border-orange-500 hover:shadow-xl"
    >
        <h2  class="mb-3 text-2xl font-semibold">
            {{props.title}}
        </h2>

        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-orange-600">Total Games Played:</span>
                <span>{{formatStats(props.stats.gamesPlayed)}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-orange-600">Total Play Time</span>
                <span>{{formatStats(props.stats.totalPlaytime,'s')}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-orange-600">Average Accuracy:</span>
                <span>{{formatStats(props.stats.averageAccuracy, '%')}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-orange-600">Average Score:</span>
                <span>{{formatStats(props.stats.averageScore, '/10')}}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-orange-600">Average Time:</span>
                <span>{{formatStats(props.stats.averageTime,'s')}}</span>
            </div>
        </div>
    </article>

</template>


