<template>
  <Head title="Five Random" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Five Random Quotes
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <Link :href="route('quotes.fiverandom')">
              <PrimaryButton >Update Quotes</PrimaryButton>
            </Link>
            
            <table class="table-auto w-full">
              <thead class="text-center">
                <tr>
                  <th>Quote</th>
                  <th>Author</th>
                  <th>Add to Favorites</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="quote in props.quotes" :key="quote.id">
                  <td>{{ quote.quote }}</td>
                  <td>{{ quote.author }}</td>
                  <td class="text-center" v-if="!existsInFavorites(quote)">
                    <PrimaryButton 
                      @click="addToFavorites(quote)" 
                      :disabled="form.processing"
                    >
                      ❤️
                    </PrimaryButton>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Quote from "@/Quote";
import PrimaryButton from "@/Components/PrimaryButton.vue"
const props = defineProps({
  quotes: Array<Quote>,
  fav_quotes_id_list: Array<number> 
})

const form = useForm({
  quote: "",
  id: 0,
  author: ""
})

const addToFavorites = (quote: Quote) => {
  form.quote = quote.quote;
  form.id = quote.id;
  form.author = quote.author;

  form.post(route("quotes.store"), {
    onSuccess: () => alert("Added to favorites 😎👍"),
  })
}

const existsInFavorites = (quote: Quote) => {
  const id_str = quote.id.toString();
  return props.fav_quotes_id_list.includes(id_str);
}

</script>
