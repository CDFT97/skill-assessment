<template>
  <Head title="Pedro favorites quotes" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ props.user.name }} favorites quotes
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <FavQuotesTable :fav_quotes="props.quotes"></FavQuotesTable>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
  
<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FavQuotesTable from "../Quotes/FavQuotesTable.vue";
import FavoriteQuote from "@/FavoriteQuote";

const props = defineProps({
  quotes: Array<FavoriteQuote>,
  user: {
    type: Object,
    required: true
  }
})

</script>