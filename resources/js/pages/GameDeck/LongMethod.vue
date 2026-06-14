<script setup lang="ts">

const props = defineProps<{
    deck: {
         id:  number,
         name: string,
        description: string,
        cards: Array<{
            id: number,
            title: string,
            code_snippet: string,
            answer: string,
            explanation: string,
        }>,
    },
}>();

console.log(props.deck.cards);

</script>


<template>
   <main class="flex flex-col">
       <header class="flex justify-center">
           <h1>{{props.deck.name}}</h1>
       </header>
       <section>
           <div class="flex flex-col gap-4 p-3" v-for="card in props.deck.cards" :key="card.id">
               <p> {{card.title}}</p>
               <p> {{card.code_snippet}}</p>
           </div>
       </section>
   </main>
</template>

<style scoped></style>
