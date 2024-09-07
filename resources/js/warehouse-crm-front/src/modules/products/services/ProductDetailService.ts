import { ProductDetails } from "../store/type";
import apiClient from '../../../config/apiService.ts';

export default class ProductDetailService {
  static async getProductDetails(productId: number): Promise<ProductDetails> {
    try {
      const response = await apiClient.get(`/v1/dashboard/inventory/products/${productId}`);
      return response.data.data;
    } catch (error) {
      console.error(`Error fetching product details for ID ${productId}:`, error);
      throw error;
    }
  }
}
