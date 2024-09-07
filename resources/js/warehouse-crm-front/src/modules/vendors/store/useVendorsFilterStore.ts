import { defineStore } from 'pinia';
import VendorService from '../../vendors/services/VendorsService';

export const useVendorsFilterStore = defineStore('vendorsFilterStore', {
  state: () => ({
    vendorStatus:[],
    vendorType:[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchVendorFilters() {
      this.loading = true;
      try {
        const response = await VendorService.getVendorFilters();
        this.vendorStatus = response.vendor_status;
        this.vendorType = response.vendor_type;
        this.error = null;
      } catch (error) {
        console.error('Error fetching vendor filters:', error);
        this.error = 'Failed to fetch vendor filters.';
      } finally {
        this.loading = false;
      }
    },

    setFilters(filters) {
      this.currentFilters = { ...filters };
    },

    setCurrentPage(page: number) {
      this.currentPage = page;
    },
  },
});
