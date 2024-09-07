import apiClient, { QueryParams } from '../../../config/apiService';
import { CustomerById, CustomerFiltersResponse, CustomerListResponse, CustomerUpdateData } from '../store/types';

export default class CustomerService {
  static async getCustomerFilters(): Promise<CustomerFiltersResponse> {
    try {
      const response = await apiClient.get<CustomerFiltersResponse>('/v1/dashboard/sales/customer/filters');
      console.log(response.data.data);
      return response.data.data;
    } catch (error) {
      console.error('Error fetching customer filters:', error);
      throw error;
    }
  }

  static async getCustomers(params: any): Promise<CustomerListResponse> {
    try {
      const response = await apiClient.get<CustomerListResponse>('/v1/dashboard/sales/customer', params );
      return response.data.data;
    } catch (error) {
      console.error('Error fetching customers:', error);
      throw error;
    }
  }

  static async getCustomerById(customerId: number): Promise<CustomerById> {
    try {
      const response = await apiClient.get<CustomerById>(`/v1/dashboard/sales/customer/${customerId}`);
      return response.data.data;
    } catch (error) {
      console.error(`Error fetching customer with ID ${customerId}:`, error);
      throw error;
    }
  }

  static async createCustomer(data: CustomerCreateData): Promise<CustomerById> {
    try {
      const response = await apiClient.post<CustomerById>('/v1/dashboard/sales/customer', data);
      return response.data;
    } catch (error) {
      console.error('Error creating customer:', error);
      throw error;
    }
  }

  static async updateCustomer(customerId: number, data: CustomerUpdateData): Promise<CustomerById> {
    try {
      const response = await apiClient.put<CustomerById>(`/v1/dashboard/sales/customer`, customerId, data);
      return response.data;
    } catch (error) {
      console.error(`Error updating customer with ID ${customerId}:`, error);
      throw error;
    }
  }

  static async deleteCustomer(customerId: number): Promise<void> {
    try {
      await apiClient.delete('/v1/dashboard/sales/customer', customerId);
    } catch (error) {
      console.error(`Error deleting customer with ID ${customerId}:`, error);
      throw error;
    }
  }
}
