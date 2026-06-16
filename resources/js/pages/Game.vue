<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { deckLongMethod } from '@/routes';
</script>

<template>
    <main class="flex flex-col gap-3 p-4">

    <h1 class="flex justify-center">You have arrived Game Page, Select which deck to play</h1>
    <Link :href="deckLongMethod()" class="underline">Long Method Deck</Link>

    </main>
</template>
