<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import StatsCard from '@/components/ui/StatsCard.vue';

const props = defineProps<{
    stats: Array<any>;
}>();

</script>

<template>
    <Head title="Stats"></Head>
    <main class="min-h-screen bg-slate-200 p-4 md:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-center text-3xl font-bold">Deck Stats</h1>
        </header>

        <section
            class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <StatsCard title="Long Method Stats" :stats="props.stats[0]" />
            <StatsCard title="Clutter Stats" :stats="props.stats[1]" />
            <StatsCard title="Duplication Stats" :stats="props.stats[2]"/>
        </section>
    </main>
</template>

<style scoped></style>
