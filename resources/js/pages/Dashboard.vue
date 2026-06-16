<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, game } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <Link :href="game()">Play Game</Link>
    </div>
</template>
