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
            <h2 class="mb-3 text-2xl font-semibold">
                {{ title }}
            </h2>

            <div class="space-y-3">
                <template v-if="leaderboard.length > 0">
                    <div
                        v-for="player in leaderboard"
                        :key="player.rank"
                        class="flex justify-between border-b pb-1"
                    >
                    <span class="text-primary">
                        {{ player.rank }}. {{ player.name }}
                    </span>

                        <span class="font-medium text-card-foreground">
                        {{ player.averageScore.toFixed(1) }}
                    </span>
                    </div>
                </template>

                <template v-else>
                    <div
                        v-for="rank in 5"
                        :key="rank"
                        class="flex justify-between border-b pb-1"
                    >
                    <span class="text-primary">
                        {{ rank }}. --
                    </span>

                        <span class="font-medium text-card-foreground">
                        --
                    </span>
                    </div>
                </template>
            </div>
        </article>
    </template>


