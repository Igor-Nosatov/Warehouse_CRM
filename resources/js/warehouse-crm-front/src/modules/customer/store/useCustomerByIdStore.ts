import { defineStore } from 'pinia';
import { CustomerById } from './types';
import CustomerService from '../services/CustomerService';

export const useCustomerByIdStore = defineStore('customerById', {
  state: () => ({
    customer: null as CustomerById | null,
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchCustomerById(customerId: number) {
      this.loading = true;
      try {
        this.customer = await CustomerService.getCustomerById(customerId);
        this.error = null;
      } catch (error) {
        console.error(`Error fetching customer with ID ${customerId}:`, error);
        this.error = 'Failed to fetch customer data.';
      } finally {
        this.loading = false;
      }
    },

    clearCustomer() {
      this.customer = null;
      this.loading = false;
      this.error = null;
    },
  },
});
