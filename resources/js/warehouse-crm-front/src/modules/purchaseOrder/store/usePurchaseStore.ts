// stores/purchaseStore.ts
import { defineStore } from 'pinia';
import PurchaseService from '../services/PurchaseService';
import { CreatePurchaseData, PurchaseById, UpdatePurchaseData } from './type';

export const usePurchaseStore = defineStore('purchaseStore', {
  state: () => ({
    purchases: [] ,
    meta: {
      current_page: 1,
      per_page: 1,
      total: 0,
      last_page: 0,
    },
    purchase: null as PurchaseById | null,
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchPurchases(params: any = {}) {
      this.loading = true;
      try {
        const response = await PurchaseService.getPurchases(params);
        this.purchases = response.data.purchase_data;
        this.meta = response.data.meta;
        this.error = null;
      } catch (error) {
        console.error('Error fetching purchases:', error);
        this.error = 'Failed to fetch purchases.';
      } finally {
        this.loading = false;
      }
    },

    async fetchPurchaseById(id: number) {
      this.purchase = null;
      try {
        this.loading = true;
        this.purchase = await PurchaseService.getPurchaseById(id);
        this.error = null;
      } catch (error) {
        console.error(`Error fetching purchase with ID ${id}:`, error);
        this.error = 'Failed to fetch purchase.';
      } finally {
        this.loading = false;
      }
    },

    async createPurchase(data: CreatePurchaseData) {
      this.loading = true;
      try {
        await PurchaseService.createPurchase(data);
        await this.fetchPurchases({ page: this.meta.current_page });
        this.error = null;
      } catch (error) {
        console.error('Error creating purchase:', error);
        this.error = 'Failed to create purchase.';
      } finally {
        this.loading = false;
      }
    },

    async updatePurchase(id: number, data: UpdatePurchaseData) {
      this.loading = true;
      try {
        await PurchaseService.updatePurchase(id, data);
        await this.fetchPurchases({ page: this.meta.current_page });
        this.error = null;
      } catch (error) {
        console.error(`Error updating purchase with ID ${id}:`, error);
        this.error = 'Failed to update purchase.';
      } finally {
        this.loading = false;
      }
    },

    async deletePurchase(id: number) {
      this.loading = true;
      try {
        await PurchaseService.deletePurchase(id);
        await this.fetchPurchases({ page: this.meta.current_page });
        this.error = null;
      } catch (error) {
        console.error(`Error deleting purchase with ID ${id}:`, error);
        this.error = 'Failed to delete purchase.';
      } finally {
        this.loading = false;
      }
    },

  },
});
