import apiClient from '../../../config/apiService.ts';
import { NoteData,  ProductUpdateData } from '../store/type';

export default class ProductService {
  static async getProducts(params: any): Promise<any> {
    try {
      const response = await apiClient.get('/v1/dashboard/inventory/products', params);
      return response.data;
    } catch (error) {
      console.error('Error fetching products:', error);
      throw error;
    }
  }

  static async createProduct(data): Promise<any> {
    try {
      console.log(data);
      const response = await apiClient.post('/v1/dashboard/inventory/products', data, true);
      return response.data;
    } catch (error) {
      console.error('Error creating product:', error);
      throw error;
    }
  }

  static async updateProduct(data: ProductUpdateData): Promise<any> {
    try {
      const { product_id, ...restData } = data;
      const response = await apiClient.put(`/v1/dashboard/inventory/products`, product_id, restData);
      return response.data;
    } catch (error) {
      console.error(`Error updating product with ID ${data.product_id}:`, error);
      throw error;
    }
  }

  static async deleteProduct(productId: number): Promise<void> {
    try {
      await apiClient.delete('/v1/dashboard/inventory/products', productId);
    } catch (error) {
      console.error(`Error deleting product with ID ${productId}:`, error);
      throw error;
    }
  }

  static async postNote(noteData: NoteData) {
    try {
      const response = await apiClient.post('/v1/dashboard/inventory/notes', noteData);
      return response.data;
    } catch (error) {
      throw new Error(`Failed to post note: ${error.message}`);
    }
  }
}
