<template>
  <div>
    <p>{{ props.userTs.name }}</p>
  </div>
</template>

<script lang="ts" setup>
import { User } from '@/User';


const props = defineProps<{
  userTs: User
}>();
</script>

