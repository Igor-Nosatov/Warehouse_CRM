import { defineStore } from 'pinia';
import SalesOrderService from '../services/SalesOrderService';
import { SalesOrderById } from './type';

export const useSalesOrderByIdStore = defineStore('salesOrderByIdStore', {
  state: () => ({
    salesOrder: null as SalesOrderById | null,
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchSalesOrderById(orderId: number) {
      this.salesOrder = null;
      this.loading = true;
      try {
        this.salesOrder = await SalesOrderService.getSalesOrderById(orderId);
        this.error = null;
      } catch (error) {
        console.error(`Error fetching sales order with ID ${orderId}:`, error);
        this.error = 'Failed to fetch sales order.';
      } finally {
        this.loading = false;
      }
    },
  },
});
