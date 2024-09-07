import { defineStore } from 'pinia';
import InventoryService from '../services/InventoryService';

export const useInventoryFiltersStore = defineStore('inventoryFilters', {
  state: () => ({
    brands: [] as { id:number, name: string; products_count: number }[],
    categories: [] as { id:number, name: string; products_count: number }[],
    productTypes: [] as { id:number, name: string; products_count: number }[],
    productStatuses: [] as { id:number, name: string; products_count: number }[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchInventoryFilters() {
      this.loading = true;
      try {
        const filtersResponse = await InventoryService.getInventoryFilters();
        this.brands = filtersResponse.brands;
        this.categories = filtersResponse.categories;
        this.productTypes = filtersResponse.product_type;
        this.productStatuses = filtersResponse.product_status;
        this.error = null;
      } catch (error) {
        console.error('Error fetching inventory filters:', error);
        this.error = 'Failed to fetch inventory filters';
      } finally {
        this.loading = false;
      }
    },
  },
});
