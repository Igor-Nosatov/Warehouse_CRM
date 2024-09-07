import { defineStore } from 'pinia';
import AdjustStockService from '@/modules/products/services/AdjustStockService';
import { AdjustStockCreate } from './type';

export const useAdjustStockStore = defineStore('adjustStock', {
  state: () => ({
    stockAdjustment: []
  }),
  actions: {
    async fetchAdjustStock(productId: number) {
      try {
        const data = await AdjustStockService.getByProductId(productId);
        this.stockAdjustment = data;
      } catch (error) {
        console.error('Error fetching adjust stock data:', error);
      }
    },
    async createAdjustStock(data: AdjustStockCreate) {
      try {
        await AdjustStockService.createAdjustStock(data);
        await this.fetchAdjustStock(data.product_id);
      } catch (error) {
        console.error('Error creating adjust stock entry:', error);
      }
    }
  }
});
