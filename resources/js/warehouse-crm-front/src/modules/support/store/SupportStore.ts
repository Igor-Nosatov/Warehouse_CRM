import { defineStore } from 'pinia';
import SupportTicketService from '@/modules/support/services/SupportService.ts'
import { SupportTicketDto, SupportTicketFiltersResponse, SupportTicketListResponse, UpdateSupportTicketData } from './type';

export const useSupportTicketStore = defineStore('supportTicket', {
  state: () => ({
    supportTicketFilters: [] as SupportTicketFiltersResponse, // Update as per the actual structure
    supportTickets: [] as SupportTicketDto[],
    currentSupportTicket: null as SupportTicketDto | null,
    meta: {
      current_page: 1,
      per_page: 9,
      total: 0,
      last_page: 1,
    },
    loading: false,
    error: null as string | null,
  }),
  actions: {
    async fetchSupportTicketFilters() {
      try {
        const filters = await SupportTicketService.getSupportTicketFilters();
        this.supportTicketFilters = filters; // Adjust if structure differs
      } catch (error) {
        console.error('Failed to fetch support ticket filters:', error);
        this.error = 'Failed to fetch support ticket filters.';
      }
    },

    async fetchSupportTickets(params?: any) {
      try {
        const response = await SupportTicketService.getSupportTickets(params);
        this.supportTickets = response.data; // Adjust if structure differs
        this.meta = response.meta; // Adjust if structure differs
      } catch (error) {
        console.error('Failed to fetch support tickets:', error);
        this.error = 'Failed to fetch support tickets.';
      }
    },

    async fetchSupportTicketById(ticketId: number) {
      try {
        const ticket = await SupportTicketService.getSupportTicketById(ticketId);
        this.currentSupportTicket = ticket;
      } catch (error) {
        console.error(`Failed to fetch support ticket with ID ${ticketId}:`, error);
        this.error = `Failed to fetch support ticket with ID ${ticketId}.`;
      }
    },

    async createSupportTicket(data: SupportTicketDto) {
      this.loading = true;
      try {
        await SupportTicketService.createSupportTicket(data);
        await this.fetchSupportTickets({ page: this.meta.current_page });
        this.error = null;
      } catch (error) {
        console.error('Error creating support ticket:', error);
        this.error = 'Failed to create support ticket.';
      } finally {
        this.loading = false;
      }
    },

    async updateSupportTicket(ticketId: number, data: UpdateSupportTicketData) {
      this.loading = true;
      try {
        await SupportTicketService.updateSupportTicket(ticketId, data);
        await this.fetchSupportTickets({ page: this.meta.current_page });
        this.error = null;
      } catch (error) {
        console.error(`Error updating support ticket with ID ${ticketId}:`, error);
        this.error = `Failed to update support ticket with ID ${ticketId}.`;
      } finally {
        this.loading = false;
      }
    },

    async deleteSupportTicket(ticketId: number) {
      try {
        await SupportTicketService.deleteSupportTicket(ticketId);
        await this.fetchSupportTickets({ page: this.meta.current_page });
      } catch (error) {
        console.error(`Failed to delete support ticket with ID ${ticketId}:`, error);
        this.error = `Failed to delete support ticket with ID ${ticketId}.`;
      }
    },
  },
});
