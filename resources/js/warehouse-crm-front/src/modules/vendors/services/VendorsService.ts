import apiClient from '../../../config/apiService';
import {  CreateVendor, VendorUpdateParams } from '../store/type';

export default class VendorService {
  static async getVendors(params:any) {
    try {
      const response = await apiClient.get('/v1/dashboard/order/vendor', params);
      return response.data.data;
    } catch (error) {
      console.error('Error fetching vendors:', error);
      throw error;
    }
  }

  static async getVendorById(id: number) {
    try {
      const response = await apiClient.get(`/v1/dashboard/order/vendor/${id}`);
      return response.data;
    } catch (error) {
      console.error('Error fetching vendor by ID:', error);
      throw error;
    }
  }

  static async getVendorFilters() {
    try {
      const response = await apiClient.get('/v1/dashboard/order/vendor-filters');
      return response.data.data;
    } catch (error) {
      console.error('Error fetching vendor filters:', error);
      throw error;
    }
  }

  static async createVendor(data: CreateVendor) {
    try {
      const response = await apiClient.post('/v1/dashboard/order/vendor', data);
      return response.data;
    } catch (error) {
      console.error('Error creating vendor:', error);
      throw error;
    }
  }

  static async deleteVendor(id: number) {
    try {
      await apiClient.delete('/v1/dashboard/order/vendor',id);
    } catch (error) {
      console.error('Error deleting vendor:', error);
      throw error;
    }
  }

  static async updateVendor(id: number, data) {
    try {
      const response = await apiClient.put('/v1/dashboard/order/vendor', id, data);
      return response.data;
    } catch (error) {
      console.error('Error updating vendor:', error);
      throw error;
    }
  }
}
