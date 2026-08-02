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
        stats: DeckStats;
    }>();

    const formatStats = (value: number | null, suffix = '') => {
        return value != null ? `${value.toFixed(2)}${suffix}` : '--';
    }

</script>

<template>
    <article
        class="flex min-h-64 flex-col rounded-xl border-2 border-primary bg-card p-5 shadow-xl sm:p-6"
    >
        <h2
            class="mb-4 text-xl font-semibold text-card-foreground sm:text-2xl"
        >
            {{ props.stats.name ?? 'Unknown Deck' }}
        </h2>

        <div class="space-y-3 text-sm sm:text-base">
            <div class="flex items-start justify-between gap-4">
                <span class="text-primary">Total Games Played:</span>

                <span class="shrink-0 font-medium text-card-foreground">
                    {{ formatStats(props.stats.gamesPlayed) }}
                </span>
            </div>

            <div class="flex items-start justify-between gap-4">
                <span class="text-primary">Total Play Time:</span>

                <span class="shrink-0 font-medium text-card-foreground">
                    {{ formatStats(props.stats.totalPlaytime, 's') }}
                </span>
            </div>

            <div class="flex items-start justify-between gap-4">
                <span class="text-primary">Average Accuracy:</span>

                <span class="shrink-0 font-medium text-card-foreground">
                    {{ formatStats(props.stats.averageAccuracy, '%') }}
                </span>
            </div>

            <div class="flex items-start justify-between gap-4">
                <span class="text-primary">Average Score:</span>

                <span class="shrink-0 font-medium text-card-foreground">
                    {{ formatStats(props.stats.averageScore, '/10.00') }}
                </span>
            </div>

            <div class="flex items-start justify-between gap-4">
                <span class="text-primary">Average Time:</span>

                <span class="shrink-0 font-medium text-card-foreground">
                    {{ formatStats(props.stats.averageTime, 's') }}
                </span>
            </div>
        </div>
    </article>
</template>

