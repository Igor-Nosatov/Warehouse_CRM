import apiClient, { QueryParams } from '../../../config/apiService';
import { CreateSalesOrder, SalesOrderById, SalesOrderFiltersResponse, SalesOrderListResponse, UpdateSalesOrderData } from '../store/type';

export default class SalesOrderService {
  static async getSalesOrderFilters(){
    try {
      const response = await apiClient.get(
        '/v1/dashboard/sales/order-filter'
      );
      return response.data;
    } catch (error) {
      console.error('Error fetching sales order filters:', error);
      throw error;
    }
  }

  static async getSalesOrders(params?: any){
    try {
      const response = await apiClient.get(
        '/v1/dashboard/sales/order',
        params
      );
      return response.data;
    } catch (error) {
      console.error('Error fetching sales orders:', error);
      throw error;
    }
  }

  static async getSalesOrderById(orderId: number){
    try {
      const response = await apiClient.get(
        `/v1/dashboard/sales/order/${orderId}`
      );
      return response.data.data;
    } catch (error) {
      console.error(`Error fetching sales order with ID ${orderId}:`, error);
      throw error;
    }
  }

  static async createSalesOrder(data: CreateSalesOrder) {
    try {
      const response = await apiClient.post('/v1/dashboard/sales/order', data);
      return response.data;
    } catch (error) {
      console.error('Error creating sales order:', error);
      throw error;
    }
  }

  static async updateSalesOrder(orderId: number, data: UpdateSalesOrderData) {
    try {
      const response = await apiClient.put(
        '/v1/dashboard/sales/order',
        orderId,
        data
      );
      return response.data;
    } catch (error) {
      console.error(`Error updating sales order with ID ${orderId}:`, error);
      throw error;
    }
  }

  static async deleteSalesOrder(orderId: number): Promise<void> {
    try {
      await apiClient.delete('/v1/dashboard/sales/order',orderId );
    } catch (error) {
      console.error(`Error deleting sales order with ID ${orderId}:`, error);
      throw error;
    }
  }
}
