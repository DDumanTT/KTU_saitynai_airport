<template>
  <va-sidebar :minimized="minimized" class="sidebar">
    <va-sidebar-item :active="$route.path === '/'" tag="NuxtLink" to="/">
      <va-sidebar-item-content>
        <va-icon name="home" />
        <va-sidebar-item-title>Home</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item :active="$route.path === '/temp'" tag="NuxtLink" to="/">
      <va-sidebar-item-content>
        <va-icon name="room" />
        <va-sidebar-item-title>Sidebar demo</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item>
      <va-sidebar-item-content>
        <va-icon name="loop" />
        <va-sidebar-item-title>Loop</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>
  </va-sidebar>
</template>

<script setup lang="ts">
withDefaults(defineProps<{ minimized?: boolean }>(), { minimized: true });
</script>

<style scoped>
.sidebar {
  height: 100%;
}
</style>
