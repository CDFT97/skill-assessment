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
          
          <table class="table-auto w-full">
            <thead class="text-center">
              <tr>
                <th>Quote</th>
                <th>Author</th>
                <th>Add to Favorites</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="quote in props.fav_quotes" :key="quote.id">
                <td>{{ quote.quote }}</td>
                <td>{{ quote.author }}</td>
                <td class="text-center">
                  <PrimaryButton 
                    @click="removeFromFavorites(quote)" 
                    :disabled="form.processing"
                  >
                    ❌
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
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FavoriteQuote from "@/FavoriteQuote";
import PrimaryButton from "@/Components/PrimaryButton.vue";


const props = defineProps({
  fav_quotes: Array<FavoriteQuote>,
})
const form = useForm({});

const removeFromFavorites = (quote: FavoriteQuote) => {
  const confirmation = confirm("Are you sure you want to remove this quote from your favorites?");
  if (confirmation) {
    form.delete(route("quotes.destroy", quote.id), {
      onSuccess: () => alert("Removed from favorites 😎👍"),
    })
  }
}

</script>