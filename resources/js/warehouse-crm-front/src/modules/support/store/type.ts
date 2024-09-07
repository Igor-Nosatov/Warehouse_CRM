export interface UpdateSupportTicketData {
  title?: string;
  description?: string;
  status?: string;
  priority?: string;
  category?: string;
  closed_at?: string | null;
}

export interface SupportTicketListResponse {
  data: SupportTicketDto[];
  meta: {
    total: number;
    per_page: number;
    current_page: number;
    last_page: number;
  };
}

export interface SupportTicketFiltersResponse {
  statusOptions: string[];
  priorityOptions: string[];
  categoryOptions?: string[];
}

export interface SupportTicketDto {
  id?: number;
  title: string;
  description: string;
  status: string;
  priority: string;
  category?: string;
  user_id: number;
  closed_at?: string | null;
  created_at?: string;
  updated_at?: string;
}

export type SupportTicketStatus = "open" | "closed";
export type SupportTicketPriority = "low" | "medium" | "high";
export type SupportTicketCategory = "bug" | "general";
