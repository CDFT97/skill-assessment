
<template>
  <div>
    <h1>This is my first component</h1>
    <ChildComponent :userTs="{name: 'John Doe', id:15}"></ChildComponent>

  </div>
</template>

<script setup lang="ts">
import ChildComponent from "@/Pages/ChildComponent.vue"

</script>
