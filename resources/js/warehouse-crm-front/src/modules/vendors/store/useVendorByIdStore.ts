import { defineStore } from 'pinia';
import { Vendor } from './type';
import VendorService from '../services/VendorsService';

export const useVendorByIdStore = defineStore('vendorByIdStore', {
  state: () => ({
    vendor:[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchVendorById(id: number) {
      this.loading = true;
      try {
        const response = await VendorService.getVendorById(id);
        this.vendor = response.data;
        this.error = null;
      } catch (error) {
        console.error('Error fetching vendor by ID:', error);
        this.error = 'Failed to fetch vendor.';
      } finally {
        this.loading = false;
      }
    },
  },
});
