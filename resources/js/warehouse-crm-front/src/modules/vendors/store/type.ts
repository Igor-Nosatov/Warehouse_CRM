export interface VendorFilterParams {
  vendor_status?: string;
  vendor_type?: string;
  min_price?: number;
  max_price?: number;
  min_used_credits?: number;
  max_used_credits?: number;
  order_by_name?: string;
  order_by_param?: string;
  per_page?: number;
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

export interface Meta {
  current_page: number;
  per_page: number;
  total: number;
  last_page: number;
}

export interface VendorResponse {
  status: number;
  message: string;
  data: {
    vendor_data: Vendor[];
    meta: Meta;
  };
}

export interface SingleVendorResponse {
  status: number;
  message: string;
  data: Vendor;
}

export interface VendorFilter {
  name: string;
  status_count: number;
}

export interface VendorFiltersResponse {
  status: number;
  message: string;
  data: VendorFilter[];
}

export interface VendorUpdateParams {
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
}

export interface CreateVendor {
  company_name: string;
  vendor_first_name: string;
  vendor_last_name: string;
  email: string;
  phone: string;
  location: string;
  website?: string;
  remark?: string;
  status: boolean;
  vendor_type: string;
  receivables: number;
  used_credits: number;
}
