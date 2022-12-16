<template>
  <div>
    <h2 class="va-h1 va-text-center title">Create account</h2>
    <div class="main">
      <span v-if="error" class="error">{{ error }}</span>
      <va-form ref="form" tag="form" class="main" @submit.prevent="handleRegister">
        <va-input v-model="userName" label="Username" :rules="rules.name" />
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
        <va-input
          v-model="confirmPassword"
          label="Confirm password"
          type="password"
          :rules="rules.confirmPassword"
        />
        <va-button :loading="loading" type="submit">Register</va-button>
      </va-form>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  layout: "auth",
});

const rules = {
  name: [(value: string) => (value && value.length > 0) || "Username is required"],
  email: [
    (value: string) => (value && value.length > 0) || "Email is required",
    (value: string) => validateEmail(value) || "Email is invalid",
  ],
  password: [
    (value: string) =>
      (value && value.length > 3) || "Password has to be longer than 3 characters.",
  ],
  confirmPassword: [
    (value: string) => password.value === value || "Passwords must match",
  ],
};

const form = ref<HTMLFormElement | null>(null);

const userName = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");

const loading = ref(false);
const error = ref("");

const { setToken } = useAuth();

async function handleRegister() {
  if (!form.value?.validate()) return;
  try {
    loading.value = true;
    const response = await useApi<TokenResponse>("/api/register", "post", {
      name: userName.value,
      email: email.value,
      password: password.value,
      password_confirmation: confirmPassword.value,
    });

    setToken(response.token, response.expiresIn, response.user);
    await navigateTo("/");
  } catch (err) {
    if (err instanceof Error) {
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
