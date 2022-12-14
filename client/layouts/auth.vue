<template>
  <div class="main">
    <div class="login">
      <slot />
    </div>
  </div>
</template>

<script setup lang="ts"></script>

<style scoped>
.main {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login {
  background-color: var(--va-background-secondary);
  border-radius: 1rem;
  padding: 2rem;
}
</style>
