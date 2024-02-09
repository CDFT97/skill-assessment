<template>
  <table class="table-auto w-full">
    <thead class="text-center">
      <tr>
        <th>Quote</th>
        <th>Author</th>
        <th>Remove from Favorites</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="quote in props.fav_quotes" :key="quote.id">
        <td>{{ quote.quote }}</td>
        <td>{{ quote.author }}</td>
        <td class="text-center">
          <PrimaryButton @click="removeFromFavorites(quote)" :disabled="form.processing">
            ❌
          </PrimaryButton>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FavoriteQuote from "@/FavoriteQuote";
const props = defineProps({
  fav_quotes: Array<FavoriteQuote>,
})
const form = useForm({});
const removeFromFavorites = (quote: FavoriteQuote) => {
  const confirmation = confirm(`Are you sure you want to remove this quote Pedro's favorites?`);
  if (confirmation) {
    form.delete(route("quotes.destroy", quote.id), {
      onSuccess: () => alert("Removed from favorites 😎👍"),
    })
  }
}
</script>
