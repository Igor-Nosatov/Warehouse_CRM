import apiClient from '../../../config/apiService';
import { DashboardResponse } from '../store/types';

export default class DashboardService {
  static async fetchDashboardData(): Promise<DashboardResponse> {
    const response = await apiClient.get<DashboardResponse>('/v1/dashboard');
    return response.data;
  }
}
