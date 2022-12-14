<template>
  <div>
    <h1></h1>
    <h2 class="va-h1 va-text-center title">Sign in</h2>
    <div class="main">
      <va-form tag="form" class="main" @submit.prevent="handleLogin">
        <va-input v-model="email" label="Email address" type="email" />
        <va-input v-model="password" label="Password" type="password" />
        <va-button type="submit">Login</va-button>
      </va-form>
      <va-divider>Don't have an account?</va-divider>
      <va-button preset="primary" to="/register">Register</va-button>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  layout: "auth",
});

const email = ref("");
const password = ref("");

function handleLogin() {
  alert(`${email.value}; ${password.value}`);
}
</script>

<style scoped>
.title {
  margin-bottom: 2rem;
}

.main {
  width: 350px;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
</style>
