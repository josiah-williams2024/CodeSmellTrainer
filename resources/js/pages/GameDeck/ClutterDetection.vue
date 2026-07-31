<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PlayGame from '@/components/PlayGame.vue';

const props = defineProps<{
    deck: {
        id: number;
        name: string;
        description: string;
        cards: Array<{
            id: number;
            code_snippet: string;
            answer: string;
            explanation: string;
        }>;
    };
}>();
</script>

<template>
    <Head :title="props.deck.name" />

    <PlayGame :deck="props.deck"
               left-answer="Clean"
               right-answer="Clutter"
    />
</template>
