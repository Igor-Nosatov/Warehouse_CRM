export interface CustomerType {
  name: string;
  count: number;
}

export interface CustomerStatus {
  name: string;
  count: number;
}

export interface CustomerFiltersResponse {
  customer_type: CustomerType[];
  customer_status: CustomerStatus[];
}

export interface Customer {
  id: number;
  first_name: string;
  last_name: string;
  customer_photo_url: string;
  customer_type: string;
  email: string;
  phone: string;
  remark: string;
  created_at: string;
  updated_at: string;
  customer_status: string;
  total_purchases: number;
  receivables: number;
}

export interface CustomerListResponse {
  customer_data: Customer[];
  meta: {
    total: number;
    per_page: number;
    current_page: number;
    last_page: number;
    from: number;
    to: number;
  };
}

export interface SalesOrder {
  id: number;
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  date_time_of_delivery: string | null;
  delivery_location: string;
  product_id: number;
  customer_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
  payment_status_id: number;
}

export interface SalesReturn {
  id: number;
  reason: string;
  return_date: string;
  status: string;
  sales_order_id: number;
  customer_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface CustomerNote {
  id: number;
  notes: string;
  user_id: number;
  customer_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface CustomerHistory {
  id: number;
  action: string;
  user_id: number;
  customer_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface CustomerById {
  id: number;
  first_name: string;
  last_name: string;
  customer_photo_url: string;
  customer_type: string;
  email: string;
  phone: string;
  remark: string;
  created_at: string;
  updated_at: string;
  customer_status: string;
  total_purchases: number;
  receivables: number;
  sales_orders: SalesOrder[];
  sales_returns: SalesReturn[];
  customer_notes: CustomerNote[];
  customer_histories: CustomerHistory[];
}

export interface CustomerApiResponse {
  status: number;
  message: string;
  data: CustomerById[];
}

export interface CustomerCreateData {
  first_name: string;
  last_name: string;
  customer_photo_url?: string;
  customer_type: string;
  customer_status: string;
  email: string;
  phone: string;
  remark?: string;
  receivables: number;
}

export interface CustomerUpdateData {
  first_name: string;
  last_name: string;
  customer_photo_url: string;
  customer_type: string;
  customer_status: string;
  email: string;
  phone: string;
  remark: string;
  total_purchases:number;
  receivables:number;
}

