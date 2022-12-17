<template>
  <va-sidebar
    :minimized="minimized"
    :minimized-width="isMobile ? '0' : '4rem'"
    :class="['sidebar', { absolute: isMobile }]"
  >
    <va-sidebar-item :active="$route.path === '/'" tag="NuxtLink" to="/">
      <va-sidebar-item-content>
        <va-icon name="home" />
        <va-sidebar-item-title>Home</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item
      v-if="user"
      :active="$route.path.startsWith('/cities')"
      tag="NuxtLink"
      to="/cities"
    >
      <va-sidebar-item-content>
        <va-icon name="location_on" />
        <va-sidebar-item-title>Cities</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item
      v-if="user"
      :active="$route.path.startsWith('/airports')"
      tag="NuxtLink"
      to="/airports"
    >
      <va-sidebar-item-content>
        <va-icon name="flight_takeoff" />
        <va-sidebar-item-title>Airports</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item
      v-if="user"
      :active="$route.path.startsWith('/airlines')"
      tag="NuxtLink"
      to="/airlines"
    >
      <va-sidebar-item-content>
        <va-icon name="airlines" />
        <va-sidebar-item-title>Airlines</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item
      v-if="user"
      :active="$route.path.startsWith('/planes')"
      tag="NuxtLink"
      to="/planes"
    >
      <va-sidebar-item-content>
        <va-icon name="flight" />
        <va-sidebar-item-title>Planes</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item
      v-if="user"
      :active="$route.path.startsWith('/flights')"
      tag="NuxtLink"
      to="/flights"
    >
      <va-sidebar-item-content>
        <va-icon name="connecting_airports" />
        <va-sidebar-item-title>Flights</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>

    <va-sidebar-item
      v-if="user?.role === 'admin'"
      :active="$route.path.startsWith('/users')"
      tag="NuxtLink"
      to="/users"
    >
      <va-sidebar-item-content>
        <va-icon name="person" />
        <va-sidebar-item-title>Users</va-sidebar-item-title>
      </va-sidebar-item-content>
    </va-sidebar-item>
  </va-sidebar>
</template>

<script setup lang="ts">
withDefaults(defineProps<{ minimized?: boolean; isMobile?: boolean }>(), {
  minimized: true,
  isMobile: false,
});

const { user } = useAuth();
</script>

<style scoped>
.sidebar {
  height: 100%;
}

.absolute {
  position: absolute;
}
</style>
