import { defineStore } from 'pinia';
import PurchaseService from '../services/PurchaseService';
import { PurchaseFilter } from './type';

export const usePurchaseFiltersStore = defineStore('purchaseFilters', {
  state: () => ({
    purchaseStatus:[] as PurchaseFilter[],
    paymentStatus:[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchPurchaseFilters() {
      this.loading = true;
      try {
        const filtersResponse = await PurchaseService.getPurchaseFilters();
        this.purchaseStatus = filtersResponse.purchase_status;
        this.paymentStatus = filtersResponse.payment_status;
      } catch (error) {
        console.error('Error fetching purchase filters:', error);
        this.error = 'Failed to fetch purchase filters';
      } finally {
        this.loading = false;
      }
    },
  },
});
