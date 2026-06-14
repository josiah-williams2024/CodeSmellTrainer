<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { deck1 } from '@/routes';
</script>

<template>
    <p>You have arrived</p>
    <Link :href="deck1()">Long Method Deck</Link>
</template>
