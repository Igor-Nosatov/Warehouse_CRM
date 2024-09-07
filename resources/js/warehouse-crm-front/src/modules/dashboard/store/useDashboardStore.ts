import { defineStore } from 'pinia';
import DashboardService from '../services/DashboardService';
import { DashboardResponse, DashboardState } from './types';

export const useDashboardStore = defineStore('dashboard', {
  state: (): DashboardState => ({
    dashboardData: null,
    loading: false,
    error: null,
  }),
  actions: {
    async fetchDashboardData() {
      this.loading = true;
      this.error = null;
      try {
        const response: DashboardResponse = await DashboardService.fetchDashboardData();
        this.dashboardData = response.data;
      } catch (error) {
        this.error = 'Error fetching dashboard data';
        console.error('Error fetching dashboard data:', error);
      } finally {
        this.loading = false;
      }
    },
  },
});
