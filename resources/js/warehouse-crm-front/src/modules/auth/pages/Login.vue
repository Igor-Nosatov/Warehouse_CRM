<template>
  <v-row
    style="height: 100vh"
    no-gutters
    class="main-layout-bg"
    justify="center"
    align="center"
  >
    <v-col cols="12" xs="12" sm="4" md="4" lg="4" xl="4" xxl="4">
      <LoginCard>
        <LoginForm @submit="handleLogin" />
      </LoginCard>
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import { useRouter } from "vue-router";
import { useAuthStore } from "../store/useAuthStore";
import LoginCard from "@/modules/auth/components/LoginCard.vue";
import LoginForm from "@/modules/auth/components/LoginForm.vue";

const router = useRouter();
const authStore = useAuthStore();

const handleLogin = async (email: string, password: string) => {
  try {
    await authStore.login(email, password);
    router.push("/");
  } catch (error) {
    console.error("Error:", error.message);
  }
};
</script>

<style>
.main-layout-bg {
  position: relative;
  height: 100vh;
  font: 16px "Nunito", sans-serif;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url("@/assets/bg.png");
  background-size: cover;
  background-position: center;
}

#login-title {
  color: #fff !important;
  font-weight: 400 !important;
  font: 22px "Nunito", sans-serif;
}

.form-label {
  color: #fff;
  font: 16px "Nunito", sans-serif;
  padding: 7px 0px;
}

.login-card {
  font: 16px "Nunito", sans-serif;
  padding: 20px;
  background-color: #283943 !important;
  color: #fff;
  width: 100%;
  border-radius: 0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  z-index: 2;
  animation: fadeIn 1.2s ease forwards;
}

.form-group {
  margin-bottom: 1rem;
}

.form-control {
  display: block;
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}

.main-btn {
  display: inline-block;
  font-weight: 400;
  color: #141e22 !important;
  text-align: center !important;
  vertical-align: middle !important;
  user-select: none;
  background-color: #00e074 !important;
  border: 1px solid #00e074 !important;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  height: 45px !important;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn:hover {
  color: #fff;
  background-color: #0056b3;
  border-color: #0056b3;
}

.btn:focus {
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}

.login-banner {
  background-image: url("@/assets/bg.png");
  background-size: cover;
  background-position: center;
  height: 100%;
  width: 100%;
  z-index: 3;
  border-radius: 0;
  animation: fadeIn 1.2s ease forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media only screen and (min-width: 50px) and (max-width: 600px) {
  .banner-block {
    display: none;
  }
}
</style>
