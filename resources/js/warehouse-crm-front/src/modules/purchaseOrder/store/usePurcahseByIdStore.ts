import { defineStore } from 'pinia';
import PurchaseService from '../services/PurchaseService';
import { PurchaseById } from './type';

export const usePurchaseByIdStore = defineStore('purchaseByIdStore', {
  state: () => ({
    purchase: null as PurchaseById | null,
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchPurchaseById(id: number) {
      this.purchase = null;
      this.loading = true;
      try {
        this.purchase = await PurchaseService.getPurchaseById(id);
        this.error = null;
      } catch (error) {
        console.error(`Error fetching purchase with ID ${id}:`, error);
        this.error = 'Failed to fetch purchase.';
      } finally {
        this.loading = false;
      }
    },
  },
});
