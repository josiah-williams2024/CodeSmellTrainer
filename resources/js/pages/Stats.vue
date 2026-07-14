<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Stats"></Head>
    <main class="min-h-screen bg-slate-200 p-4 md:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-center text-3xl font-bold">Deck Stats</h1>
        </header>

        <section
            class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3"
        >
            <article
                class="flex h-64 flex-col rounded-xl border-2 border-slate-500 bg-slate-100 p-6 shadow-lg transition hover:border-orange-500 hover:shadow-xl"
            >
                <h2 class="mb-3 text-2xl font-semibold">Long Method Stats</h2>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Accuracy:</span>
                        <span>92%</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Score:</span>
                        <span>18 / 20</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Time:</span>
                        <span>1m 42s</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Total Play Time:</span>
                        <span>2h 15m</span>
                    </div>
                </div>
            </article>

            <article
                class="flex h-64 flex-col rounded-xl border-2 border-slate-500 bg-slate-100 p-6 shadow-lg transition hover:border-orange-500 hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold mb-3">Clutter Stats</h2>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Accuracy:</span>
                        <span>92%</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Score:</span>
                        <span>18 / 20</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Time:</span>
                        <span>1m 42s</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Total Play Time:</span>
                        <span>2h 15m</span>
                    </div>
                </div>
            </article>

            <article
                class="flex h-64 flex-col rounded-xl border-2 border-slate-500 bg-slate-100 p-6 shadow-lg transition hover:border-orange-500 hover:shadow-xl"
            >
                <h2 class="text-2xl font-semibold mb-3">Duplication Stats</h2>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Accuracy:</span>
                        <span>92%</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Score:</span>
                        <span>18 / 20</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Average Time:</span>
                        <span>1m 42s</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-orange-600">Total Play Time:</span>
                        <span>2h 15m</span>
                    </div>
                </div>
            </article>
        </section>
    </main>
</template>

<style scoped></style>
