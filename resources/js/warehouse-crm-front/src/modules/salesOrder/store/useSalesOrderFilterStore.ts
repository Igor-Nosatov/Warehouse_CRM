import { defineStore } from 'pinia';
import SalesOrderService from '../services/SalesOrderService';
import { SalesOrderStatusFilter, PaymentStatusFilter } from '../store/type';

export const useSalesOrderFilterStore = defineStore('salesOrderFilter', {
  state: () => ({
    orderStatus: []as SalesOrderStatusFilter[],
    paymentStatus: [] as PaymentStatusFilter[],
  }),

  actions: {
    async fetchSalesOrderFilters() {
      try {
        const response = await SalesOrderService.getSalesOrderFilters();
        this.orderStatus = response.data.sales_order_status;
        this.paymentStatus = response.data.payment_status;
      } catch (error) {
        console.error('Error fetching sales order filters:', error);
      }
    },
  },
});
