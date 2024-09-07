// services/PurchaseService.ts
import apiClient, { QueryParams } from '../../../config/apiService';
import {
  CreatePurchaseData,
  PurchaseFiltersResponse,
  UpdatePurchaseData,
} from '../store/type';

export default class PurchaseService {
  static async getPurchases(params?: any) {
    try {
      const response = await apiClient.get(
        '/v1/dashboard/order/purchase',
        params
      );
      return response.data;
    } catch (error) {
      console.error('Error fetching purchases:', error);
      throw error;
    }
  }

  static async getPurchaseFilters() {
    try {
      const response = await apiClient.get<PurchaseFiltersResponse>(
        '/v1/dashboard/order/purchase-filters'
      );
      return response.data.data;
    } catch (error) {
      console.error('Error fetching purchase filters:', error);
      throw error;
    }
  }

  static async getPurchaseById(id: number) {
    try {
      const response = await apiClient.get(
        `/v1/dashboard/order/purchase/${id}`
      );
      return response.data.data;
    } catch (error) {
      console.error(`Error fetching purchase with ID ${id}:`, error);
      throw error;
    }
  }

  static async createPurchase(data: CreatePurchaseData) {
    try {
      const response = await apiClient.post('/v1/dashboard/order/purchase', data);
      return response.data;
    } catch (error) {
      console.error('Error creating purchase:', error);
      throw error;
    }
  }

  static async updatePurchase(id: number, data): Promise<void> {
    try {
      console.log(id, data);
      await apiClient.put('/v1/dashboard/order/purchase', id, data);
    } catch (error) {
      console.error(`Error updating purchase with ID ${id}:`, error);
      throw error;
    }
  }

  static async deletePurchase(id: number): Promise<void> {
    try {
      await apiClient.delete('/v1/dashboard/order/purchase', id);
    } catch (error) {
      console.error(`Error deleting purchase with ID ${id}:`, error);
      throw error;
    }
  }
}
