<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { deckLongMethod, deckDuplication, deckClutter } from '@/routes';
</script>

<template>
    <Head title="Game"></Head>
    <main class="min-h-screen bg-background p-4 md:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-center text-3xl font-bold text-foreground">
                Select a Deck
            </h1>
        </header>

        <section
            class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <Link
                :href="deckLongMethod()"
                class="flex h-64 flex-col rounded-xl border-2 border-border bg-card p-6 shadow-lg transition hover:border-primary hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold text-card-foreground">
                    Long Method
                </h2>

                <p class="mt-3 text-muted-foreground">
                    Identify methods that are too long and should be broken into
                    smaller pieces.
                </p>

                <span class="mt-6 font-medium text-primary">
                    Start Deck →
                </span>
            </Link>

            <Link
                :href="deckClutter()"
                class="flex h-64 flex-col rounded-xl border-2 border-border bg-card p-6 shadow-lg transition hover:border-primary hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold text-card-foreground">
                    Clutter
                </h2>

                <p class="mt-3 text-muted-foreground">
                    Learn to spot unnecessary code, dead code, and confusing
                    implementations.
                </p>

                <span class="mt-6 font-medium text-primary">
                    Start Deck →
                </span>
            </Link>

            <Link
                :href="deckDuplication()"
                class="flex h-64 flex-col rounded-xl border-2 border-border bg-card p-6 shadow-lg transition hover:border-primary hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold text-card-foreground">
                    Duplication
                </h2>

                <p class="mt-3 text-muted-foreground">
                    Identify repeated logic and recognize opportunities to
                    refactor duplicate code.
                </p>

                <span class="mt-6 font-medium text-primary">
                    Start Deck →
                </span>
            </Link>
        </section>
    </main>
</template>
