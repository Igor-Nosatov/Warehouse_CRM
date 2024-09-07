export interface PurchaseById {
  id: number;
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  date_time_of_delivery: string;
  delivery_location: string;
  product_id: number;
  customer_id: number;
  vendor_id: number;
  deleted_at: string | null;
  created_at: string;
  updated_at: string;
  vendor: Vendor;
  product: Product;
  payment_status: string | null;
}

export interface Vendor {
  id: number;
  company_name: string;
  vendor_first_name: string;
  vendor_last_name: string;
  email: string;
  phone: string;
  location: string;
  website: string;
  remark: string;
  status: boolean;
  vendor_type: string;
  receivables: number;
  used_credits: number;
  deleted_at: string | null;
  created_at: string;
  updated_at: string;
}

export interface Product {
  id: number;
  is_returnable: boolean;
  is_have_variant: boolean;
  core_product_id: number | null;
  title: string;
  sku: string;
  barcode: string;
  retail_price: number;
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
}


export interface Purchase {
  id: number;
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  date_time_of_delivery: string;
  delivery_location: string;
  product_id: number;
  customer_id: number;
  vendor_id: number;
  deleted_at: string | null;
  created_at: string;
  updated_at: string;
  vendor: Vendor;
  product: Product;
  payment_status: string | null;
}

export interface PurchaseDataResponse {
  status: number;
  message: string;
  data: {
    purchase_data: Purchase[];
    meta: {
      current_page: number;
      per_page: number;
      total: number;
      last_page: number;
    };
  };
}

export interface PurchaseFilter {
  name: string;
  status_count: number;
}

export interface PurchaseFiltersResponse {
  status: number;
  message: string;
  data: PurchaseFilter[];
}

export interface CreatePurchaseData {
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  date_time_of_delivery: string;
  delivery_location: string;
  product_id: number;
  customer_id: number;
  vendor_id: number;
  payment_status_id: number;
}

export interface UpdatePurchaseData {
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  date_time_of_delivery: string;
  delivery_location: string;
  product_id: number;
  customer_id: number;
  vendor_id: number;
  payment_status_id: number;
}
