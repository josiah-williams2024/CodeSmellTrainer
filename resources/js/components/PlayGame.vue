<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref } from 'vue';
import gameController from '@/actions/App/Http/Controllers/GameController';
import { highlightCode } from '@/lib/shiki';
import GameResults from './GameResults.vue';

type Card = {
    id: number;
    code_snippet: string;
    answer: string;
    explanation: string;
};

type Deck = {
    id: number;
    name: string;
    description: string;
    cards: Card[];
};

const props = defineProps<{
    deck: Deck;
    leftAnswer: string;
    rightAnswer: string;
}>();

const currentCardIndex = ref(0);
const score = ref(0);
const finished = ref(false);
const questionsAnswered = ref(0);
const elapsedSeconds = ref(0);
const highlightedCards = ref<string[]>([]);

const gameEndpoint = gameController.store();

let timer: number;

const currentCard = computed(() => {
    return props.deck.cards[currentCardIndex.value];
});

const accuracy = computed(() => {
    if (questionsAnswered.value === 0) {
        return 0;
    }

    return Math.round((score.value / questionsAnswered.value) * 100);
});

const formattedTime = computed(() => {
    const mins = Math.floor(elapsedSeconds.value / 60);
    const secs = elapsedSeconds.value % 60;

    return `${mins}:${secs.toString().padStart(2, '0')}`;
});

const startTimer = () => {
    clearInterval(timer);

    timer = window.setInterval(() => {
        elapsedSeconds.value++;
    }, 1000);
};

const saveGameResult = async () => {
    try {
        const response = await fetch(gameEndpoint.url, {
            method: gameEndpoint.method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN':
                    document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute('content') ?? '',
            },
            body: JSON.stringify({
                deck_id: props.deck.id,
                score: score.value,
                total_questions: questionsAnswered.value,
                accuracy: accuracy.value,
                time_seconds: elapsedSeconds.value,
            }),
        });

        if (!response.ok) {
            console.error('Failed to save game results');
        }
    } catch (error) {
        console.error('Failed to save game result', error);
    }
};

const submitAnswer = (choice: string) => {
    questionsAnswered.value++;

    if (choice === currentCard.value.answer) {
        score.value++;
    }

    if (currentCardIndex.value === props.deck.cards.length - 1) {
        finished.value = true;
        clearInterval(timer);

        void saveGameResult();

        return;
    }

    currentCardIndex.value++;
};

const handleArrowKeys = (event: KeyboardEvent) => {
    if (finished.value) {
        return;
    }

    if (event.key === 'ArrowLeft') {
        submitAnswer(props.leftAnswer);
    }

    if (event.key === 'ArrowRight') {
        submitAnswer(props.rightAnswer);
    }
};

onMounted(async () => {
    highlightedCards.value = await Promise.all(
        props.deck.cards.map((card) => highlightCode(card.code_snippet)),
    );

    window.addEventListener('keydown', handleArrowKeys);

    startTimer();
});

onUnmounted(() => {
    window.removeEventListener('keydown', handleArrowKeys);
    clearInterval(timer);
});
</script>

<template>
    <main class="flex min-h-screen justify-center bg-background p-2">
        <article
            v-if="!finished"
            class="flex h-[95vh] w-full max-w-screen-2xl flex-col"
        >
            <header class="mb-3">
                <h1 class="text-center text-3xl font-bold text-card-foreground">
                    {{ deck.name }}
                </h1>

                <div
                    class="mt-2 flex flex-wrap justify-center gap-6 text-sm text-muted-foreground"
                >
                    <span>Score: {{ score }}</span>
                    <span>Accuracy: {{ accuracy }}%</span>
                    <span>
                        Card {{ currentCardIndex + 1 }} /
                        {{ deck.cards.length }}
                    </span>
                    <span>Time: {{ formattedTime }}</span>
                </div>
            </header>

            <section
                class="flex-1 overflow-x-hidden overflow-y-auto rounded-lg border border-border bg-zinc-900"
            >
                <div v-html="highlightedCards[currentCardIndex]"></div>
            </section>

            <footer class="mt-3">
                <nav class="flex justify-between gap-4">
                    <button
                        type="button"
                        class="rounded-lg bg-primary px-6 py-4 font-medium text-primary-foreground transition-opacity hover:opacity-90"
                        @click="submitAnswer(props.leftAnswer)"
                    >
                        ⬅ {{ props.leftAnswer }}
                    </button>

                    <button
                        type="button"
                        class="rounded-lg bg-primary px-6 py-4 font-medium text-primary-foreground transition-opacity hover:opacity-90"
                        @click="submitAnswer(props.rightAnswer)"
                    >
                        {{ props.rightAnswer }} ➡
                    </button>
                </nav>
            </footer>
        </article>

        <GameResults
            v-else
            :deck="deck"
            :accuracy="accuracy"
            :score="score"
            :formatted-time="formattedTime"
        />
    </main>
</template>
