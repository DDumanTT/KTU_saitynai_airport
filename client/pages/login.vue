<template>
  <div>
    <h2 class="va-h1 va-text-center title">Sign in</h2>
    <div class="main">
      <span v-if="error" class="error">{{ error }}</span>
      <va-form ref="form" tag="form" class="main" @submit.prevent="handleLogin">
        <va-input
          v-model="email"
          label="Email address"
          type="email"
          :rules="rules.email"
        />
        <va-input
          v-model="password"
          label="Password"
          type="password"
          :rules="rules.password"
        />
        <va-button :loading="loading" type="submit">Login</va-button>
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

const rules = {
  email: [
    (value: string) => (value && value.length > 0) || "Email is required",
    (value: string) => validateEmail(value) || "Email is invalid",
  ],
  password: [
    (value: string) =>
      (value && value.length > 3) || "Password has to be longer than 3 characters.",
  ],
};

const form = ref<HTMLFormElement | null>(null);

const email = ref("");
const password = ref("");

const loading = ref(false);
const error = ref("");

const { setToken } = useAuth();

async function handleLogin() {
  if (!form.value?.validate()) return;
  try {
    error.value = "";
    loading.value = true;
    const response = await useApi<TokenResponse>("/api/login", "post", {
      email: email.value,
      password: password.value,
    });
    setToken(response.token, response.expiresIn, response.user);
    await navigateTo("/");
  } catch (err) {
    if (err instanceof Error) {
      //   console.log(err);
      error.value = err.message;
    }
  }
  loading.value = false;
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

.error {
  width: 100%;
  text-align: center;
  color: var(--va-danger);
}
</style>
