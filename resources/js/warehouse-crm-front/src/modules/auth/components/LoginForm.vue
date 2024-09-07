<template>
  <v-form @submit.prevent="submit">
    <div class="form-group">
      <label for="email" class="form-label">Email</label>
      <input
        v-model="email"
        id="email"
        class="form-control mt-2"
        placeholder="test@gmail.com"
        type="email"
        required
        aria-required="true"
        aria-label="Email address"
      />
    </div>
    <div class="form-group">
      <label for="password" class="form-label">Password</label>
      <input
        v-model="password"
        id="password"
        class="form-control mt-2"
        placeholder="Password"
        type="password"
        required
        aria-required="true"
        aria-label="Password"
      />
    </div>
    <v-btn
      type="submit"
      color="primary"
      block
      class="mt-3 py-2 main-btn mt-8"
      aria-label="Login button"
    >
      Login
    </v-btn>
  </v-form>
</template>

<script setup lang="ts">
import { ref, defineEmits } from "vue";

const emit = defineEmits<{
  (event: 'submit', email: string, password: string): void;
}>();

const email = ref("");
const password = ref("");

const submit = () => {
  emit('submit', email.value, password.value);
};
</script>
