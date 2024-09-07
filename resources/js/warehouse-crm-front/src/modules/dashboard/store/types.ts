export interface StockLevel {
  'Low level stock': string;
  'Average level stock': string;
  'High level stock': string;
  'Max level stock': string;
}

export interface BestSellingProduct {
  id: number;
  is_returnable: boolean;
  is_have_variant: boolean;
  core_product_id: number | null;
  title: string;
  sku: string;
  barcode: string;
  retail_price: number | null;
  wholesale_price: number | null;
  cost: number;
  is_draft: boolean;
  product_type_id: number;
  product_status_id: number;
  category_id: number;
  brand_id: number;
  user_id: number | null;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
  sales_orders_count: number;
}

export interface SalesOrderCount {
  totalProductPacked: number;
  totalProductToBeProcessing: number;
  totalProductShipped: number;
  totalSalesProductDelivered: number;
}

export interface ActiveWorkOrder {
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
  product: BestSellingProduct;
}

export interface SalesOrderSummary {
  [key: string]: {
    salesOrder: number;
    salesReturn: number;
  };
}

export interface DashboardData {
  stockLevel: StockLevel;
  bestSellingProducts: BestSellingProduct[];
  salesOrderCounts: SalesOrderCount;
  activeWorkOrder: ActiveWorkOrder[];
  salesOrderSummary: SalesOrderSummary;
}

export interface DashboardResponse {
  status: number;
  message: string;
  data: DashboardData;
}

export interface DashboardState {
  dashboardData: DashboardData | null;
  loading: boolean;
  error: string | null;
}
