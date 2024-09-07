import apiClient from '../../../config/apiService.ts';
import { AdjustStockCreate, AdjustStockState } from '../store/type.ts';

export default class AdjustStockService {
  public static async getByProductId(productId: number): Promise<AdjustStockState> {
    try {
      const response = await apiClient.get<AdjustStockState>(`/v1/dashboard/inventory/adjust-stock/${productId}`);
      return response.data.data;
    } catch (error) {
      console.error('Error fetching adjust stock data:', error);
      throw error;
    }
  }

  public static async createAdjustStock(data: AdjustStockCreate): Promise<void> {
    try {
      await apiClient.post('/v1/dashboard/inventory/adjust-stock', data);
    } catch (error) {
      console.error('Error creating adjust stock entry:', error);
      throw error;
    }
  }
}
