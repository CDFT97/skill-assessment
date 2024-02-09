<template>
  <Head title="Users" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Users
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">

            <table class="table-auto w-full">
              <thead class="text-center">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Fav Quotes</th>
                  <th>Status</th>
                  <th>BAN/UNBAN</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in props.users" :key="user.id">
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td class="text-center">
                    <Link :href="route('admin.users.quotes', user.id)" >Watch {{ user.quotes.length }} quotes</Link>
                  </td>
                  <td class="text-center">
                    <p class="uppercase font-bold"
                      :class="user.status === 'inactive' ? 'text-red-500' : 'text-green-500'">
                      {{ user.status }}
                    </p>
                  </td>

                  <td class="text-center">
                    <PrimaryButton v-if="user.status === 'inactive'" @click="updateStatus(user.id, 'active')">
                      Enable
                    </PrimaryButton>
                    <DangerButton v-else @click="updateStatus(user.id, 'inactive')">
                      Disable
                    </DangerButton>
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
import PrimaryButton from "@/Components/PrimaryButton.vue"
import DangerButton from "@/Components/DangerButton.vue"
import User from "@/User";
const props = defineProps({
  users: Array<User>,
})

const form = useForm({
  user_id: 0,
  status: "",
})

const updateStatus = (id: number, status: string) => {
  form.user_id = id;
  form.status = status;

  form.put(route("admin.users.update.status"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
}
</script>
