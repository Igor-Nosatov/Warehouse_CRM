export interface SalesOrderStatusFilter {
  name: string;
  count: number;
}

export interface PaymentStatusFilter {
  id: number;
  name: string;
  purchase_count: number;
}

export interface SalesOrderFiltersResponse {
  data: {
    sales_order_status: SalesOrderStatusFilter[];
    payment_status: PaymentStatusFilter[];
  };
}
export interface SalesOrderListResponse {
  salesOrders: {
    id: number;
    status: string;
    amount: number;
  }[];
}

export interface SalesOrderById {
  id: number;
  status: string;
  amount: number;
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

export interface SalesOrderById {
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
export interface UpdateSalesOrderData {
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  date_time_of_delivery: string;
  delivery_location: string;
  customer_id: number;
  payment_status_id: number;
}

export interface CreateSalesOrder {
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  date_time_of_delivery: string;
  delivery_location: string;
  product_id: number;
  customer_id: number;
  payment_status_id: number;
}
