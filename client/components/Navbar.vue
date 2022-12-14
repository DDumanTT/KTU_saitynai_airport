<template>
  <va-navbar color="BackgroundElement" text-color="primary" shape class="nav">
    <template #left>
      <div class="left">
        <va-button preset="secondary" hover-behavior="opacity" :hover-opacity="0.4">
          <IconMenuCollapsed
            :class="{ 'x-flip': isSidebarMinimized }"
            :color="colors.primary"
            @click="isSidebarMinimized = !isSidebarMinimized"
          />
        </va-button>
        <NuxtLink to="/">
          <va-navbar-item class="logo">AIRPORTS</va-navbar-item>
        </NuxtLink>
      </div>
    </template>
    <template #right>
      <va-button icon="person" to="/login">LOGIN</va-button>
    </template>
  </va-navbar>
</template>

<script setup lang="ts">
const isSidebarMinimized = useState("isSidebarMinimized", () => false);

const { getColors } = useColors();
const colors = computed(() => getColors());
</script>

<style scoped>
.nav {
  box-shadow: var(--va-box-shadow);
  z-index: 2;
}

.logo {
  font-weight: 600;
  font-size: 1.5rem;
  color: var(--va-primary);
}

.x-flip {
  transform: scaleX(-100%);
}

.left {
  display: flex;
  justify-content: baseline;
  align-items: center;
  gap: 1rem;
}
</style>
