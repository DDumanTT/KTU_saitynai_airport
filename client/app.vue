<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup lang="ts">
localStorage.setItem("theme", "dark");
</script>

<style>
body {
  color: var(--va-text-primary);
}
</style>
