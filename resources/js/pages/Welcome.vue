<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login } from '@/routes';
import { register, game, learncodesmells } from '@/routes';
</script>

<template>
    <Head title="Home" />
    <div
        class="flex min-h-screen flex-col items-center bg-slate-200 p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
        <div class="w-full max-w-6xl">
            <main class="rounded-xl bg-white p-12 shadow-lg">
                <nav class="flex items-center justify-between gap-4">
                    <Link href="/" class="flex items-center gap-4">
                        <img
                            src="/logo.svg"
                            alt="Code Smell Trainer"
                            class="h-14 w-14"
                        />

                        <div>
                            <p class="font-semibold">Code Smell Trainer</p>

                            <p class="text-xs text-muted-foreground">
                                Learn through practice
                            </p>
                        </div>
                    </Link>

                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <div class="flex items-center gap-4">

                        <Link
                            :href="login()"
                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="register()"
                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                        >
                            Register
                        </Link>
                        </div>
                    </template>
                </nav>
                <section class="text-center">
                    <h1 class="text-5xl font-bold">Code Smell Trainer</h1>

                    <p class="mt-4 text-lg text-gray-600">
                        Learn to recognize code smells faster.
                    </p>

                    <div class="mt-8 flex justify-center gap-4">
                        <Link
                            :href="game()"
                            class="flex w-48 items-center justify-center rounded bg-blue-500 px-6 py-3 text-white hover:bg-blue-400"
                        >
                            Play Game
                        </Link>

                        <Link
                            :href="learncodesmells()"
                            class="flex w-48 items-center justify-center rounded bg-blue-500 px-6 py-3 text-white hover:bg-blue-400"
                        >
                            Study Code Smells
                        </Link>
                    </div>
                </section>
                <hr class="my-12" />
                <section class="mt-16">
                    <h2 class="mb-8 text-center text-3xl font-bold">
                        How Does It Work?
                    </h2>

                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                        <div
                            class="rounded-lg border bg-gray-50 p-6 text-center shadow-sm"
                        >
                            <h3 class="mb-2 text-lg font-semibold">1. Study</h3>
                            <p class="text-gray-600">
                                Learn what each code smell is and why it
                                matters.
                            </p>
                        </div>

                        <div
                            class="rounded-lg border bg-gray-50 p-6 text-center shadow-sm"
                        >
                            <h3 class="mb-2 text-lg font-semibold">
                                2. Choose a Deck
                            </h3>
                            <p class="text-gray-600">
                                Pick a deck such as Long Method or Large Class.
                            </p>
                        </div>

                        <div
                            class="rounded-lg border bg-gray-50 p-6 text-center shadow-sm"
                        >
                            <h3 class="mb-2 text-lg font-semibold">3. Play</h3>
                            <p class="text-gray-600">
                                Identify code smells as quickly and accurately
                                as possible.
                            </p>
                        </div>

                        <div
                            class="rounded-lg border bg-gray-50 p-6 text-center shadow-sm"
                        >
                            <h3 class="mb-2 text-lg font-semibold">
                                4. Improve
                            </h3>
                            <p class="text-gray-600">
                                Track your score and become faster over time.
                            </p>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</template>
