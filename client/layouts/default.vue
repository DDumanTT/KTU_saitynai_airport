<template>
  <div class="main">
    <navbar class="nav" />
    <div class="content">
      <sidebar :minimized="isSidebarMinimized" />
      <div class="page">
        <div class="layout fluid va-gutter-5">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const isSidebarMinimized = useState("isSidebarMinimized", () => false);
</script>

<style scoped>
.nav {
  min-height: 4rem;
}

.main {
  height: 100vh;
  display: flex;
  flex-direction: column;
}

.content {
  height: calc(100vh - 4rem);
  display: flex;
  flex: 1;
}

.page {
  flex-grow: 2;
  overflow-y: auto;
}
</style>
