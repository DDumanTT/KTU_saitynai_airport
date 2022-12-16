<template>
  <div class="main">
    <Navbar class="nav" />
    <div class="content">
      <Sidebar :minimized="isSidebarMinimized" />
      <div class="page">
        <div class="layout fluid va-gutter-5">
          <slot />
        </div>
        <MainFooter />
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
  display: flex;
  flex-direction: column;
}

.full-height {
  height: 100%;
}
</style>
