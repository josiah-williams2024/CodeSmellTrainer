<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { deckLongMethod } from '@/routes';
</script>

<template>
    <main class="minh-screen p-4 md:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-center text-3xl font-bold underline">
                Select which deck to play down below
            </h1>
        </header>
        <section
            class="mx-auto grid max-w-6xl gap-4 md:grid-cols-2 lg:grid-cols-3"
        >
            <article>
                <Link :href="deckLongMethod()" class="block p-5"
                    >Long Method Deck</Link
                >
            </article>

            <article>
                <Link class="block p-5"
                    >Clutter Deck</Link
                >
            </article>

            <article>
                <Link class="block p-5"
                    >Duplication Deck</Link
                >
            </article>

        </section>
    </main>
</template>

<style scoped lang="postcss">
article {
    @apply rounded-lg border border-gray-200 bg-white p-5 shadow-sm hover:shadow-md;
}
</style>
