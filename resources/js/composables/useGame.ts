import { computed, onMounted, onUnmounted, ref } from 'vue';

export function useGame(totalQuestions: number) {
    const currentCardIndex = ref(0);
    const score = ref(0);
    const questionsAnswered = ref(0);
    const elapsedSeconds = ref(0);
    const finished = ref(false);

    let timer: number | undefined;

    const accuracy = computed(() => {
        if (questionsAnswered.value === 0) {
            return 0;
        }

        return Math.round((score.value / questionsAnswered.value) * 100);
    });

    const formattedTime = computed(() => {
        const minutes = Math.floor(elapsedSeconds.value / 60);
        const seconds = elapsedSeconds.value % 60;

        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    });

    const stopTimer = () => {
        if (timer === undefined) {
            return;
        }

        window.clearInterval(timer);
        timer = undefined;
    };

    const startTimer = () => {
        stopTimer();

        timer = window.setInterval(() => {
            elapsedSeconds.value++;
        }, 1000);
    };

    const finishGame = () => {
        finished.value = true;
        stopTimer();
    };

    const answerQuestion = (isCorrect: boolean) => {
        if (finished.value) {
            return;
        }

        if (isCorrect) {
            score.value++;
        }

        questionsAnswered.value++;

        if (questionsAnswered.value >= totalQuestions) {
            finishGame();

            return;
        }

        currentCardIndex.value++;
    };

    const resetGame = () => {
        currentCardIndex.value = 0;
        score.value = 0;
        questionsAnswered.value = 0;
        elapsedSeconds.value = 0;
        finished.value = false;

        startTimer();
    };

    onMounted(startTimer);
    onUnmounted(stopTimer);

    return {
        currentCardIndex,
        score,
        questionsAnswered,
        elapsedSeconds,
        finished,
        accuracy,
        formattedTime,
        answerQuestion,
        finishGame,
        resetGame,
    };
}
