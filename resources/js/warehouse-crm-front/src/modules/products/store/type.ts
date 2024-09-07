export interface InventoryFiltersResponse {
  brands: { id: number; name: string; products_count: number }[];
  categories: { id: number; name: string; products_count: number }[];
  product_type: { id: number; name: string; products_count: number }[];
  product_status: { id: number; name: string; products_count: number }[];
}

export interface ProductDetails {
  id: number;
  is_returnable: boolean;
  is_have_variant: boolean;
  core_product_id: number;
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
  category: ProductCategory;
  brand: ProductBrand;
  product_images: ProductImage[];
  product_type: ProductType;
  product_status: ProductStatus;
  vendor_stock_products: VendorStockProduct[];
  attributes: ProductAttribute[];
  adjust_stocks: AdjustStock[];
  product_histories: ProductHistory[];
}

export interface ProductCategory {
  id: number;
  name: string;
  created_at: string | null;
  updated_at: string | null;
  deleted_at: string | null;
}

export interface ProductBrand {
  id: number;
  name: string;
  created_at: string | null;
  updated_at: string | null;
  deleted_at: string | null;
}

export interface ProductImage {
  id: number;
  name: string;
  file_name: string;
  mime_type: string;
  path: string;
  disk: string;
  size: string;
  url: string;
  product_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface ProductType {
  id: number;
  name: string;
  description: string | null;
  created_at: string | null;
  updated_at: string | null;
  deleted_at: string | null;
}

export interface ProductStatus {
  id: number;
  name: string;
  created_at: string | null;
  updated_at: string | null;
  deleted_at: string | null;
}

export interface VendorStockProduct {
  id: number;
  product_quantity: number;
  product_id: number;
  warehouse_id: number;
  vendor_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface ProductAttribute {
  id: number;
  size: string;
  width: number;
  height: number;
  weight: number;
  color: string;
  material: string;
  product_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface AdjustStock {
  id: number;
  payment_status: AdjustmentType;
  adjust_stock_date: string;
  reason_for_inventory: ReasonInventoryType;
  new_quantity: number;
  description: string | null;
  product_id: number;
  warehouse_id: number;
  vendor_id: number;
  user_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export enum AdjustmentType {
  QUANTITY_ADJUSTMENT = 'Quantity Adjustment',
  VALUE_ADJUSTMENT = 'Value Adjustment'
}

export enum ReasonInventoryType {
  STOLEN_GOODS = 'Stolen Goods',
  MISSING_GOODS = 'Missing Goods',
  ACCIDENT = 'Accident',
  OTHER = 'Other'
}

export interface ProductHistory {
  id: number;
  action: string;
  product_id: number;
  user_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
  user: User;
}

export interface User {
  id: number;
  name: string;
  email: string;
  role_id: number;
}

export interface ProductUpdateData {
  is_returnable: boolean;
  is_have_variant: boolean;
  title: string;
  sku: string;
  barcode: string;
  retail_price: number | null;
  wholesale_price: number | null;
  cost: number;
  product_id: number;
  warehouse_id: number;
  product_type_id: number;
  product_status_id: number;
  category_id: number;
  brand_id: number;
  user_id: number | null;
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
  category: {
    id: number;
    name: string;
    created_at: string | null;
    updated_at: string | null;
    deleted_at: string | null;
  };
  brand: {
    id: number;
    name: string;
    created_at: string | null;
    updated_at: string | null;
    deleted_at: string | null;
  };
  product_images: ProductImage[];
  product_type: {
    id: number;
    name: string;
    description: string | null;
    created_at: string | null;
    updated_at: string | null;
    deleted_at: string | null;
  };
  product_status: {
    id: number;
    name: string;
    created_at: string | null;
    updated_at: string | null;
    deleted_at: string | null;
  };
}

export interface ProductImage {
  id: number;
  name: string;
  file_name: string;
  mime_type: string;
  path: string;
  disk: string;
  size: string;
  url: string;
  product_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface MetaData {
  current_page: number;
  per_page: number;
  total: number;
  last_page: number;
}

export interface ApiResponse {
  status: number;
  message: string;
  data: {
    products: Product[];
    meta: MetaData;
  };
}

export interface NoteData {
  notes: string;
  product_id: number;
  user_id: number;
}

export interface ProductCreateData {
  is_returnable: boolean;
  is_have_variant: boolean;
  core_product_id: number | null;
  title: string;
  retail_price: number | null;
  wholesale_price: number | null;
  cost: number;
  id_draft: boolean;
  product_type_id: number;
  product_status_id: number;
  category_id: number;
  brand_id: number;
  user_id: number | null;
  image: File | null;
}

export interface Warehouse {
  id: number;
  name: string;
  location: string;
}

export interface Vendor {
  id: number;
  company_name: string;
}

export interface Stock {
  id: number;
  product_quantity: number;
  warehouse_id: number;
  warehouse: Warehouse;
}

export interface LatestAdjustment {
  id: number;
  payment_status: string;
  reason_for_inventory: string;
  adjust_stock_date: string;
  quantity_available: number;
  new_quantity: number;
  vendor_id: number;
  vendor: Vendor;
}

export interface AdjustStockState {
  stock: Stock[];
  latestAdjustment: LatestAdjustment[];
}

export interface AdjustStockCreate {
  payment_status: string;
  adjust_stock_date: string;
  reason_for_inventory: string;
  quantity_available: number;
  new_quantity: number;
  description?: string;
  product_id: number;
  warehouse_id: number;
  vendor_id: number;
  user_id: number;
}
