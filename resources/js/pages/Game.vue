<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { deckLongMethod, deckDuplication, deckClutter } from '@/routes';
</script>

<template>
    <Head title="Game"></Head>
    <main class="min-h-screen bg-slate-200 p-4 md:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-center text-3xl font-bold">Select a Deck</h1>
        </header>

        <section
            class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <Link
                :href="deckLongMethod()"
                class="flex h-64 flex-col rounded-xl border-2 border-slate-500 bg-slate-100 p-6 shadow-lg transition hover:border-orange-500 hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold">Long Method</h2>

                <p class="mt-3 text-gray-600">
                    Identify methods that are too long and should be
                    broken into smaller pieces.
                </p>

                <span class="mt-6 font-medium text-orange-600">
                    Start Deck →
                </span>
            </Link>

            <Link
                :href="deckClutter()"
                class="flex h-64 flex-col rounded-xl border-2 border-slate-500 bg-slate-100 p-6 shadow-lg transition hover:border-orange-500 hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold">Clutter</h2>

                <p class="mt-3 text-gray-600">
                    Learn to spot unnecessary code, dead code, and confusing
                    implementations.
                </p>

                <span class="mt-6 font-medium text-orange-600">
                    Start Deck →
                </span>
            </Link>

            <Link
                :href="deckDuplication()"
                class="flex h-64 flex-col rounded-xl border-2 border-slate-500 bg-slate-100 p-6 shadow-lg transition hover:border-orange-500 hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold">Duplication</h2>

                <p class="mt-3 text-gray-600">
                    Identify repeated logic and recognize opportunities to
                    refactor duplicate code.
                </p>

                <span class="mt-6 font-medium text-orange-600">
                    Start Deck →
                </span>
            </Link>
        </section>
    </main>
</template>
