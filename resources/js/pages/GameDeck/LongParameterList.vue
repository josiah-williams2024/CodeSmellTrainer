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
    <Head :title="props.deck.name"></Head>
    <PlayGame
        :deck="props.deck"
        left-answer="Not Long Parameter List"
        right-answer="Long Parameter List"
    />
</template>
