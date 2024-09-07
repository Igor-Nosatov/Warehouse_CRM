// customerStore.ts
import { defineStore } from "pinia";
import CustomerService from "../services/CustomerService";
import { CustomerCreateData, CustomerListResponse, CustomerUpdateData } from "../store/types";
import { QueryParams } from "../../../config/apiService";

export const useCustomerStore = defineStore("customer", {
  state: () => ({
    customers: [] as CustomerListResponse["customer_data"],
    meta: {
      current_page: 1,
      per_page: 9,
      total: 0,
      last_page: 1,
    },
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchCustomers(params?: QueryParams) {
      this.loading = true;
      try {
        const response = await CustomerService.getCustomers(params);
        this.customers = response.customer_data;
        this.meta = response.meta;
      } catch (error) {
        console.error("Error fetching customers:", error);
        this.error = "Failed to fetch customers";
      } finally {
        this.loading = false;
      }
    },

    async createCustomer(data: CustomerCreateData) {
      this.loading = true;
      try {
        const newCustomer = await CustomerService.createCustomer(data);
        this.customers.push(newCustomer);
      } catch (error) {
        console.error('Failed to create customer', error);
        this.error = 'Failed to create customer';
      } finally {
        this.loading = false;
      }
    },

    async updateCustomer(customerId: number, data: CustomerUpdateData) {
      this.loading = true;
      try {
        await CustomerService.updateCustomer(customerId, data);
        await this.fetchCustomers({ page: this.meta.current_page });
      } catch (error) {
        console.error(`Error updating customer with ID ${customerId}:`, error);
        this.error = "Failed to update customer";
      } finally {
        this.loading = false;
      }
    },

    async deleteCustomer(customerId: number) {
      this.loading = true;
      try {
        await CustomerService.deleteCustomer(customerId);
        await this.fetchCustomers({ page: this.meta.current_page });
      } catch (error) {
        console.error(`Error deleting customer with ID ${customerId}:`, error);
        this.error = "Failed to delete customer";
      } finally {
        this.loading = false;
      }
    },
  },
});
