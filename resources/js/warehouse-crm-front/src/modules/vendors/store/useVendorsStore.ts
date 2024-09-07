import { defineStore } from 'pinia';
import { CreateVendor, Vendor, VendorUpdateParams } from './type';
import VendorService from '../services/VendorsService';
import { QueryParams } from '../../../config/apiService';

export const useVendorStore = defineStore('vendorStore', {
  state: () => ({
    vendors: [] as Vendor[],
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
    async fetchVendors(params?: QueryParams) {
      this.loading = true;
      try {
        const response = await VendorService.getVendors(params);
        this.vendors = response.vendor_data;
        this.meta = response.meta;
        this.error = null;
      } catch (error) {
        console.error('Error fetching vendors:', error);
        this.error = 'Failed to fetch vendors.';
      } finally {
        this.loading = false;
      }
    },

    async createVendor(data: CreateVendor) {
      this.loading = true;
      try {
        await VendorService.createVendor(data);
        this.fetchVendors(this.meta.current.page);
        this.error = null;
      } catch (error) {
        console.error('Error creating vendor:', error);
        this.error = 'Failed to create vendor.';
      } finally {
        this.loading = false;
      }
    },

    async updateVendor(id: number, data: VendorUpdateParams) {
      this.loading = true;
      try {
        const response = await VendorService.updateVendor(id, data);
        const index = this.vendors.findIndex(vendor => vendor.id === id);
        if (index !== -1) {
          this.vendors[index] = response.data;
        }
        this.error = null;
      } catch (error) {
        console.error('Error updating vendor:', error);
        this.error = 'Failed to update vendor.';
      } finally {
        this.loading = false;
      }
    },

    async deleteVendor(id: number) {
      this.loading = true;
      try {
        await VendorService.deleteVendor(id);
        this.vendors = this.vendors.filter(vendor => vendor.id !== id);
        this.error = null;
      } catch (error) {
        console.error('Error deleting vendor:', error);
        this.error = 'Failed to delete vendor.';
      } finally {
        this.loading = false;
      }
    },
  },
});
