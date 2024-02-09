<template>
<Head title="Dashboard" />

<AuthenticatedLayout>
  <template #header>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      My Favorites
    </h2>
  </template>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <FavQuotesTable :fav_quotes="props.fav_quotes"></FavQuotesTable>
        </div>
      </div>
    </div>
  </div>
</AuthenticatedLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FavoriteQuote from "@/FavoriteQuote";
import FavQuotesTable from "../Quotes/FavQuotesTable.vue";

const props = defineProps({
  fav_quotes: Array<FavoriteQuote>,
})

</script>