  // useSalesOrderStore.ts

import { defineStore } from 'pinia';
import { QueryParams } from '../../../config/apiService';
import SalesOrderService from '../services/SalesOrderService';
import { CreateSalesOrder, SalesOrderById, SalesOrderFiltersResponse, SalesOrderListResponse, UpdateSalesOrderData } from './type';

export const useSalesOrderStore = defineStore('salesOrder',{
  state: () => ({
    salesOrderFilters: [],
    salesOrders: [],
    currentSalesOrder: null as SalesOrderById | null,
    meta: {
      current_page: 1,
      per_page: 9,
      total: 0,
      last_page: 1,
    },
  }),
  actions: {
    async fetchSalesOrderFilters() {
      try {
        const filters = await SalesOrderService.getSalesOrderFilters();
        this.salesOrderFilters = filters.status;
      } catch (error) {
        console.error('Failed to fetch sales order filters:', error);
        throw error;
      }
    },
    async fetchSalesOrders(params?: QueryParams) {
      try {
        const response = await SalesOrderService.getSalesOrders(params);
        this.salesOrders = response.data.sales_order_data;
        this.meta = response.data.meta;
      } catch (error) {
        console.error('Failed to fetch sales orders:', error);
        throw error;
      }
    },
    async fetchSalesOrderById(orderId: number) {
      try {
        const order = await SalesOrderService.getSalesOrderById(orderId);
        this.currentSalesOrder = order;
      } catch (error) {
        console.error(`Failed to fetch sales order with ID ${orderId}:`, error);
        throw error;
      }
    },

    async createSalesOrder(data) {
      this.loading = true;
      try {
        await SalesOrderService.createSalesOrder(data);
        await this.fetchSalesOrders({ page: this.meta.current_page });
        this.error = null;
      } catch (error) {
        console.error('Error creating sales order:', error);
        this.error = 'Failed to create sales order.';
      } finally {
        this.loading = false;
      }
    },

    async updateSalesOrder(orderId: number, data: UpdateSalesOrderData) {
      this.loading = true;
      try {
        await SalesOrderService.updateSalesOrder(orderId, data);
        await this.fetchSalesOrders({ page: this.meta.current_page });
        this.error = null;
      } catch (error) {
        console.error(`Error updating sales order with ID ${orderId}:`, error);
        this.error = `Failed to update sales order with ID ${orderId}.`;
      } finally {
        this.loading = false;
      }
    },

    async deleteSalesOrder(orderId: number) {
      try {
        await SalesOrderService.deleteSalesOrder(orderId);
        await this.fetchSalesOrders({ page: this.meta.current_page });
      } catch (error) {
        console.error(`Failed to delete sales order with ID ${orderId}:`, error);
        throw error;
      }
    },
  },
});
