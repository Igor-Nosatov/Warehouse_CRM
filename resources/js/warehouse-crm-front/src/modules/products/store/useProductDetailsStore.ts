// store/modules/productDetails.ts
import { defineStore } from 'pinia';
import ProductDetailService from '@/modules/products/services/ProductDetailService.ts'; // Adjust the path as per your project structure
import { ProductDetails } from './type';

export const useProductDetailsStore = defineStore('productDetails', {
  state: () => ({
    product: null as ProductDetails | null,
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchProductDetails(productId: number) {
      this.loading = true;
      try {
        const productDetails = await ProductDetailService.getProductDetails(productId);
        this.product = productDetails;
        this.error = null;
      } catch (error) {
        console.error(`Error fetching product details for ID ${productId}:`, error);
        this.error = 'Failed to fetch product details.';
      } finally {
        this.loading = false;
      }
    },

    clearProductDetails() {
      this.product = null;
      this.loading = false;
      this.error = null;
    },
  },
});
