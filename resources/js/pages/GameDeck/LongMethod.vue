<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed, ref, onMounted, onUnmounted } from 'vue';
import { game } from '@/routes';

const currentCardIndex = ref(0);
const score = ref(0);
const finished = ref(false);
const questionsAnswered = ref(0);

const props = defineProps<{
    deck: {
        id: number;
        name: string;
        description: string;
        cards: Array<{
            id: number;
            title: string;
            code_snippet: string;
            answer: string;
            explanation: string;
        }>;
    };
}>();

onMounted(() => {
    window.addEventListener('keydown', handleArrowKeys);
});

onUnmounted(() => {
    window.removeEventListener('keydown', handleArrowKeys);
});

const currentCard = computed(() => {
    return props.deck.cards[currentCardIndex.value];
});

const answer = (choice: string) => {
    questionsAnswered.value++;

    if (choice === currentCard.value.answer) {
        score.value++;
    }

    if (currentCardIndex.value === props.deck.cards.length - 1) {
        finished.value = true;

        return;
    }

    currentCardIndex.value++;
};

const accuracy = computed(() => {
    if (questionsAnswered.value === 0) {
        return 0;
    }

    return Math.round((score.value / questionsAnswered.value) * 100);
});

const handleArrowKeys = (event: KeyboardEvent) => {
    if (event.key === 'ArrowLeft') {
        answer('Short Method');
    }

    if (event.key === 'ArrowRight') {
        answer('Long Method');
    }
};

const playAgain = () => {
     currentCardIndex.value = 0;
     score.value = 0;
     finished.value = false;
     questionsAnswered.value = 0;
};
</script>

<template>
    <main
        class="flex min-h-screen items-center justify-center bg-gray-100 p-2 md:p-4"
    >
        <article
            v-if="!finished"
            class="flex h-[85vh] w-full max-w-7xl flex-col rounded-xl bg-white p-4 shadow-xl md:p-8"
        >
            <header class="mb-6 text-center">
                <h1 class="text-2xl font-bold">
                    {{ props.deck.name }}
                </h1>

                <p class="text-sm text-gray-500">Score : {{ score }}</p>

                <p class="text-sm text-gray-500">Accuracy {{ accuracy }}%</p>

                <p class="text-sm text-gray-500">
                    Card {{ currentCardIndex + 1 }} /
                    {{ props.deck.cards.length }}
                </p>
            </header>
            <section class="flex-1 overflow-hidden">
                <pre
                    class="h-full overflow-auto rounded border bg-gray-50 p-4 text-left font-mono text-[11px] md:text-xs"
                >
            <code>{{ currentCard.code_snippet }}</code>
            </pre>
            </section>
            <footer class="mt-6">
                <nav class="flex flex-col gap-4 sm:flex-row sm:justify-between">
                    <button
                        type="button"
                        @click="answer('Short Method')"
                        class="rounded-lg border bg-blue-400 p-4 hover:bg-blue-300"
                    >
                        ⬅ Short Method
                    </button>

                    <button
                        type="button"
                        class="rounded-lg border bg-blue-400 p-4 hover:bg-blue-300"
                        @click="answer('Long Method')"
                    >
                        Long Method ➡
                    </button>
                </nav>
            </footer>
        </article>
        <article
            v-else
            class="flex h-[85vh] w-full max-w-7xl flex-col rounded-xl bg-white p-4 shadow-xl md:p-8"
        >
            <div
                class="flex flex-1 flex-col items-center justify-center text-center"
            >
                <h1 class="mb-4 text-4xl font-bold">Deck Complete</h1>

                <p class="text-xl">
                    Score: {{ score }} / {{ props.deck.cards.length }}
                </p>

                <p class="text-xl">Accuracy: {{ accuracy }}%</p>
            </div>

            <div class="flex justify-center gap-4">
                <button
                    class="w-40 rounded-lg border bg-blue-400 p-4 hover:bg-blue-300"
                    @click="playAgain()"
                >
                    Play Again
                </button>

                <Link
                    :href="game()"
                    class="w-40 rounded-lg border bg-blue-400 p-4 text-center hover:bg-blue-300"
                >
                    Pick New Deck
                </Link>
            </div>
        </article>
    </main>
</template>
