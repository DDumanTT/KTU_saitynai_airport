<template>
  <div>
    <h1></h1>
    <h2 class="va-h1 va-text-center title">Create account</h2>
    <div class="main">
      <va-form tag="form" class="main" @submit.prevent="handleRegister">
        <va-input v-model="userName" label="Username" />
        <va-input v-model="email" label="Email address" type="email" />
        <va-input v-model="password" label="Password" type="password" />
        <va-input v-model="confirmPassword" label="Confirm password" type="password" />
        <va-button type="submit">Register</va-button>
      </va-form>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  layout: "auth",
});

const userName = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");

function handleRegister() {
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
