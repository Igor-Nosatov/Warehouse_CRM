<template>
  <div>
    <SubNavbar @search-changed="handleSearchChange" :total_products="meta.total"/>
    <v-row no-gutters class="pb-12">
      <v-col cols="3" class="ps-4 pe-4 pt-6">
        <Sidebar
          :brands="inventoryFiltersStore.brands"
          :categories="inventoryFiltersStore.categories"
          :product_type="inventoryFiltersStore.productTypes"
          :product_status="inventoryFiltersStore.productStatuses"
          :loading="inventoryFiltersStore.loading"
          :error="inventoryFiltersStore.error"
          :filters="currentFilters"
          @filters-changed="applyFilters"
          @search-changed="handleSearchChange"
        />
      </v-col>
      <v-col cols="9" class="ps-4 pe-4 pt-6">
        <v-row no-gutters>
          <v-col cols="12" v-for="product in products" :key="product.id" class="pb-3">
            <ProductCard
              :product="product"
              :imageSrc="image1"
              @detail-click="handleDetailProduct(product.id)"
              @edit-click="handleEditProduct(product.id)"
              @delete-click="handleDeleteProduct(product.id)"
            />
          </v-col>
          <v-col cols="12" class="pt-6">
            <Pagination
              :current-page="meta.current_page"
              :last-page="meta.last_page"
              :filters="currentFilters"
              @page-changed="fetchPage"
            />
          </v-col>
          <v-col cols="12">
            <ProductDetail
              v-if="isModalOpen"
              :is-open="isModalOpen"
              :productId="selectedProductId"
              @close="closeModal"
            />
          </v-col>
          <v-col cols="12">
            <EditForm
              v-if="isEditFormOpen"
              :is-open="isEditFormOpen"
              :productId="selectedProductId"
              @close="closeEditForm"
            />
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </div>
</template>
<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { useProductStore } from '@/modules/products/store/useProductStore';
import { useInventoryFiltersStore } from '@/modules/products/store/useInventoryFiltersStore';
import image1 from '@/assets/product1.jpg';
import SubNavbar from '@/modules/products/components/SubNavbar.vue';
import Pagination from '@/modules/products/components/Pagination.vue';
import Sidebar from '@/modules/products/components/Sidebar.vue';
import ProductDetail from '@/modules/products/components/ProductDetail.vue';
import EditForm from '@/modules/products/components/EditForm.vue';
import ProductCard from '@/modules/products/components/ProductCard.vue';

const isModalOpen = ref(false);
const selectedProductId = ref<number | null>(null);

const handleDetailProduct = (productId: number) => {
  selectedProductId.value = productId;
  isModalOpen.value = true;
};
const closeModal = () => {
  isModalOpen.value = false;
};

const isEditFormOpen = ref(false);
const handleEditProduct = (productId: number) => {
  selectedProductId.value = productId;
  isEditFormOpen.value = true;
};
const closeEditForm = () => {
  isEditFormOpen.value = false;
};

const productStore = useProductStore();
const inventoryFiltersStore = useInventoryFiltersStore();
const products = ref(productStore.products);
const meta = ref(productStore.meta);

const currentFilters = ref({
  status: '',
  type: '',
  category: '',
  brand: '',
  min_price: null as number | null,
  max_price: null as number | null,
  search: ''
});

const handleSearchChange = (search: string) => {
  currentFilters.value.search = search;
  applyFilters(currentFilters.value);
  fetchPage(1);
};

const fetchPage = async (page: number) => {
  const params: any = { page, ...currentFilters.value };
  for (const key in params) {
    if (params[key] === '' || params[key] === undefined || params[key] === null) {
      delete params[key];
    }
  }
  await productStore.fetchProducts(params);
};

const applyFilters = async (filters: {
  status: string;
  type: string;
  category: string;
  brand: string;
  min_price: number | null,
  max_price: number | null,
  search: string;
}) => {
  currentFilters.value = filters;
  await fetchPage(1);
};

const handleDeleteProduct = async (productId: number) => {
  await productStore.deleteProduct(productId);
  await fetchPage(1);
};

watch(() => productStore.products, (newProducts) => {
  products.value = newProducts;
});

watch(() => productStore.meta, (newMeta) => {
  meta.value = newMeta;
});

onMounted(async () => {
  await inventoryFiltersStore.fetchInventoryFilters();
  await fetchPage(1);
});
</script>
