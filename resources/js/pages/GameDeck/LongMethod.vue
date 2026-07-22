<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref, onMounted, onUnmounted } from 'vue';
import gameController from '@/actions/App/Http/Controllers/GameController';
import { highlightCode } from '@/lib/shiki';

const currentCardIndex = ref(0);
const score = ref(0);
const finished = ref(false);
const questionsAnswered = ref(0);
const elapsedSeconds = ref(0);
const highlightedCards = ref<string[]>([]);
const gameEndpoint = gameController.store();

let timer: number;

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

const startTimer = () => {
    clearInterval(timer);

    timer = window.setInterval(() => {
        elapsedSeconds.value++;
    }, 1000);
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

const currentCard = computed(() => {
    return props.deck.cards[currentCardIndex.value];
});

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
                accuracy: accuracy.value,
                total_questions: questionsAnswered.value,
                time_seconds: elapsedSeconds.value,
            }),
        });

        if (!response.ok) {
            console.error('Failed to save game result');

            return;
        }
    } catch (error) {
        console.error('Failed to save game results', error);
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

const accuracy = computed(() => {
    if (questionsAnswered.value === 0) {
        return 0;
    }

    return Math.round((score.value / questionsAnswered.value) * 100);
});

const handleArrowKeys = (event: KeyboardEvent) => {
    if (finished.value) {
        return;
    }

    if (event.key === 'ArrowLeft') {
        submitAnswer('Short Method');
    }

    if (event.key === 'ArrowRight') {
        submitAnswer('Long Method');
    }
};

const formattedTime = computed(() => {
    const mins = Math.floor(elapsedSeconds.value / 60);
    const secs = elapsedSeconds.value % 60;

    return `${mins}:${secs.toString().padStart(2, '0')}`;
});
</script>

<template>
    <Head :title="props.deck.name"></Head>
    <main class="flex min-h-screen justify-center bg-background p-2">
        <article
            v-if="!finished"
            class="flex h-[95vh] w-full max-w-screen-2xl flex-col"
        >
            <header class="mb-3">
                <h1 class="text-center text-3xl font-bold text-card-foreground">
                    {{ props.deck.name }}
                </h1>

                <div
                    class="mt-2 flex flex-wrap justify-center gap-6 text-sm text-muted-foreground"
                >
                    <span>Score: {{ score }}</span>
                    <span>Accuracy: {{ accuracy }}%</span>
                    <span>
                        Card {{ currentCardIndex + 1 }} /
                        {{ props.deck.cards.length }}
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
                <nav class="flex flex-col gap-4 sm:flex-row sm:justify-between">
                    <button
                        type="button"
                        @click="submitAnswer('Short Method')"
                        class="rounded-lg bg-primary px-6 py-4 font-medium text-primary-foreground transition-opacity hover:opacity-90"
                    >
                        ⬅ Short Method
                    </button>

                    <button
                        type="button"
                        class="rounded-lg bg-primary px-6 py-4 font-medium text-primary-foreground transition-opacity hover:opacity-90"
                        @click="submitAnswer('Long Method')"
                    >
                        Long Method ➡
                    </button>
                </nav>
            </footer>
        </article>
        <article
            v-else
            class="flex h-[85vh] w-full max-w-7xl flex-col rounded-xl border border-border bg-card p-4 shadow-xl md:p-8"
        >
            <div
                class="flex flex-1 flex-col items-center justify-center text-center"
            >
                <h1 class="mb-4 text-4xl font-bold text-card-foreground">
                    Deck Complete
                </h1>

                <p class="text-xl text-muted-foreground">
                    Score: {{ score }} / {{ props.deck.cards.length }}
                </p>

                <p class="text-xl text-muted-foreground">
                    Accuracy: {{ accuracy }}%
                </p>

                <p class="text-xl text-muted-foreground">
                    Time: {{ formattedTime }}
                </p>
            </div>

            <div class="flex justify-center gap-4">
                <Link
                    class="w-40 rounded-lg bg-primary p-4 text-center font-medium text-primary-foreground transition-opacity hover:opacity-90"
                    :href="gameController.show(props.deck.id)"
                >
                    Play Again
                </Link>

                <Link
                    :href="gameController.index()"
                    class="w-40 rounded-lg bg-primary p-4 text-center font-medium text-primary-foreground transition-opacity hover:opacity-90"
                >
                    Pick New Deck
                </Link>
            </div>
        </article>
    </main>
</template>
