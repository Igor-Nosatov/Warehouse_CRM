import { defineStore } from 'pinia';
import AuthService from '../service/AuthService';

interface AuthState {
  token: string | null;
}

export const useAuthStore = defineStore('auth', {
  state: (): AuthState => ({
    token: null,
  }),
  actions: {
    async login(email: string, password: string) {
      try {
        await AuthService.login({ email, password });
      } catch (error) {
        console.error('Error during login:', error);
        throw error;
      }
    },
    logout() {
      this.token = null;
      localStorage.removeItem('tokenWarehouseCrm');
    },
  },
});
