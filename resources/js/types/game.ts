export type Card = {
    id: number;
    code_snippet: string;
    answer: string;
    explanation: string;
};

export type AnswerReview = {
    card: Card;
    highlightedCode: string;
    selectedAnswer: string;
    isCorrect: boolean;
};
