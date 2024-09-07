import apiClient from '../../../config/apiService.ts';
import { InventoryFiltersResponse } from '../store/type';

export default class InventoryService {
  static async getInventoryFilters(): Promise<InventoryFiltersResponse> {
    try {
      const response = await apiClient.get('/v1/dashboard/inventory/filter');
      return response.data.data;
    } catch (error) {
      console.error('Error fetching inventory filters:', error);
      throw error;
    }
  }
}
