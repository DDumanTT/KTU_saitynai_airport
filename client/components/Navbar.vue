<template>
  <va-navbar color="BackgroundElement" text-color="primary" shape class="nav">
    <template #left>
      <div class="left">
        <va-button
          preset="secondary"
          hover-behavior="opacity"
          :hover-opacity="0.4"
          @click="isSidebarMinimized = !isSidebarMinimized"
        >
          <IconMenuCollapsed
            :class="{ 'x-flip': isSidebarMinimized }"
            :color="colors.primary"
          />
        </va-button>
        <NuxtLink to="/">
          <va-navbar-item class="logo">AIRPORTS</va-navbar-item>
        </NuxtLink>
      </div>
    </template>
    <template #right>
      <template v-if="!user">
        <va-button icon="person" to="/login">LOGIN</va-button>
      </template>
      <template v-else>
        <div class="row align-center va-spacing-x-3">
          <span>{{ user.name }}</span>
          <va-avatar color="primary">{{ user.name[0].toUpperCase() }}</va-avatar>
          <va-button
            icon="logout"
            preset="secondary"
            hover-behavior="opacity"
            :hover-opacity="0.4"
            @click="logoutModalVisible = true"
          />
        </div>
      </template>
    </template>
    <va-modal
      v-model="logoutModalVisible"
      message="Are you sure you want to logout?"
      ok-text="Logout"
      @ok="logout"
    ></va-modal>
  </va-navbar>
</template>

<script setup lang="ts">
const isSidebarMinimized = useState("isSidebarMinimized", () => false);

const logoutModalVisible = ref(false);

const { user, logout } = useAuth();

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
