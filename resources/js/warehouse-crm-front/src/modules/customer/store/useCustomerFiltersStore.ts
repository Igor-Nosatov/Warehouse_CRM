import { defineStore } from 'pinia';
import CustomerService from '../services/CustomerService';
import { CustomerStatus, CustomerType } from './types';

export const useCustomerFiltersStore = defineStore('customerFilters', {
  state: () => ({
    customerTypes: [] as CustomerType[],
    customerStatuses: [] as CustomerStatus[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchCustomerFilters() {
      this.loading = true;
      try {
        const filtersResponse = await CustomerService.getCustomerFilters();
        this.customerTypes = filtersResponse.customer_type;
        this.customerStatuses = filtersResponse.customer_status;
      } catch (error) {
        console.error('Error fetching customer filters:', error);
        this.error = 'Failed to fetch customer filters';
      } finally {
        this.loading = false;
      }
    },
  },
});
