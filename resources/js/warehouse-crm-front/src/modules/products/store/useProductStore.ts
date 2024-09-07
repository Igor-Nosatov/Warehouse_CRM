import { defineStore } from 'pinia';
import { Product, ProductCreateData, ProductUpdateData } from './type';
import ProductService from '../services/ProductService.ts';

export const useProductStore = defineStore('products', {
  state: () => ({
    loading: false,
    error: null as string | null,
    products: [] as Product[],
    meta: {
      current_page: 1,
      per_page: 9,
      total: 0,
      last_page: 1,
    },
  }),

  actions: {
    async fetchProducts(params: any = {}) {
      this.loading = true;
      try {
        const response = await ProductService.getProducts(params);
        this.products = response.data.products;
        this.meta = response.data.meta;
        this.error = null;
      } catch (error) {
        console.error('Error fetching products:', error);
        this.error = 'Failed to fetch products.';
      } finally {
        this.loading = false;
      }
    },

    async createProduct(productData: ProductCreateData) {
      this.loading = true;
      try {
        await ProductService.createProduct(productData);
        this.error = null;
      } catch (error) {
        console.error('Error creating product:', error);
        this.error = 'Failed to create product.';
      } finally {
        this.loading = false;
      }
    },

    async updateProduct(productData: ProductUpdateData) {
      this.loading = true;
      try {
        await ProductService.updateProduct(productData);
        await this.fetchProducts();
        this.error = null;
      } catch (error) {
        console.error(`Error updating product with ID ${productData.product_id}:`, error);
        this.error = 'Failed to update product.';
      } finally {
        this.loading = false;
      }
    },

    async deleteProduct(productId: number) {
      this.loading = true;
      try {
        await ProductService.deleteProduct(productId);
        this.error = null;
      } catch (error) {
        console.error(`Error deleting product with ID ${productId}:`, error);
        this.error = 'Failed to delete product.';
      } finally {
        this.loading = false;
      }
    },
  },
});
