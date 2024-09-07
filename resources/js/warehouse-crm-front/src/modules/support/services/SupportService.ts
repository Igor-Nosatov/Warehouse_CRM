import apiClient from '../../../config/apiService';
import { SupportTicketDto, SupportTicketFiltersResponse, SupportTicketListResponse, UpdateSupportTicketData } from '../store/type';

export default class SupportTicketService {
  /**
   * Get support ticket filters.
   */
  static async getSupportTicketFilters(): Promise<SupportTicketFiltersResponse> {
    try {
      const response = await apiClient.get('/v1/dashboard/other/support-filter');
      return response.data;
    } catch (error) {
      console.error('Error fetching support ticket filters:', error);
      throw error;
    }
  }

  /**
   * Get a list of support tickets with optional query parameters.
   *
   * @param params Optional query parameters for filtering or pagination.
   */
  static async getSupportTickets(params?: any): Promise<SupportTicketListResponse> {
    try {
      const response = await apiClient.get('/v1/dashboard/other/support-tickets', { params });
      return response.data;
    } catch (error) {
      console.error('Error fetching support tickets:', error);
      throw error;
    }
  }

  /**
   * Get a specific support ticket by ID.
   *
   * @param ticketId The ID of the support ticket.
   */
  static async getSupportTicketById(ticketId: number): Promise<SupportTicketDto> {
    try {
      const response = await apiClient.get(`/v1/dashboard/other/support-tickets/${ticketId}`);
      return response.data.data;
    } catch (error) {
      console.error(`Error fetching support ticket with ID ${ticketId}:`, error);
      throw error;
    }
  }

  /**
   * Create a new support ticket.
   *
   * @param data The data for the new support ticket.
   */
  static async createSupportTicket(data: SupportTicketDto): Promise<SupportTicketDto> {
    try {
      const response = await apiClient.post('/v1/dashboard/other/support-tickets', data);
      return response.data;
    } catch (error) {
      console.error('Error creating support ticket:', error);
      throw error;
    }
  }

  /**
   * Update an existing support ticket.
   *
   * @param ticketId The ID of the support ticket to update.
   * @param data The data to update the support ticket with.
   */
  static async updateSupportTicket(ticketId: number, data: UpdateSupportTicketData): Promise<SupportTicketDto> {
    try {
      const response = await apiClient.put(`/v1/dashboard/other/support-tickets/${ticketId}`, data);
      return response.data;
    } catch (error) {
      console.error(`Error updating support ticket with ID ${ticketId}:`, error);
      throw error;
    }
  }

  /**
   * Delete a support ticket.
   *
   * @param ticketId The ID of the support ticket to delete.
   */
  static async deleteSupportTicket(ticketId: number): Promise<void> {
    try {
      await apiClient.delete(`/v1/dashboard/other/support-tickets/${ticketId}`);
    } catch (error) {
      console.error(`Error deleting support ticket with ID ${ticketId}:`, error);
      throw error;
    }
  }
}
