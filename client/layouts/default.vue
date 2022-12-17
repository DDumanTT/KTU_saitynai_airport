<template>
  <div class="main">
    <Navbar class="nav" />
    <div class="content">
      <Sidebar :minimized="isSidebarMinimized" :is-mobile="isMobile" />
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
const isMobile = ref(false);
const breakpoint = useBreakpoint();

function onResize() {
  if (breakpoint.xs) isMobile.value = true;
  else isMobile.value = false;
}

onResize();

if (isMobile.value) isSidebarMinimized.value = true;

onMounted(() => {
  window.addEventListener("resize", onResize);
});
onBeforeUnmount(() => {
  window.removeEventListener("resize", onResize);
});
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
  position: relative;
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
