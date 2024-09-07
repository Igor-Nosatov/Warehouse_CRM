<template>
  <v-row no-gutters>
    <v-col cols="12">
      <SubNavbar
        @search-changed="handleSearchChange"
        :total-purchase="purchaseStore.meta.total"
      />
    </v-col>
    <v-col cols="3" class="ps-4 pe-4 pt-6">
      <Sidebar
        :purchaseStatus="purchaseFilterStore.purchaseStatus"
        :paymentStatus="purchaseFilterStore.paymentStatus"
        :loading="purchaseFilterStore.loading"
        :error="purchaseFilterStore.error"
        :filters="currentFilters"
        @filters-changed="applyFilters"
      />
    </v-col>
    <v-col cols="9" class="ps-2 pe-4 pt-6">
      <v-row no-gutters>
        <v-col
          cols="12"
          v-for="purchase in purchaseStore.purchases"
          :key="purchase.id"
        >
          <PurchaseOrderCard
            :purchase="purchase"
            @detail="handleDetailPurchase"
            @edit="handleEditPurchase"
            @delete="handleDeletePurchase"
          />
        </v-col>
      </v-row>
    </v-col>
    <v-col offset="3" cols="9" class="pt-6 pb-12">
      <Pagination
        :current-page="purchaseStore.meta.current_page"
        :last-page="purchaseStore.meta.last_page"
        @page-changed="fetchPage"
      />
    </v-col>
    <v-col cols="12">
      <PurchaseOrderDetail
        :is-open="isPurchaseOrderDetailOpen"
        @close="closePurchaseOrderDetail"
        :purchase-id="selectedPurchaseId"
      />
    </v-col>
    <v-col cols="12">
      <PurchaseEdit
        :is-open="isPurchaseEditFormOpen"
        @close="closePurchaseEditForm"
        :purchase-id="selectedPurchaseId"
      />
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { usePurchaseStore } from "@/modules/purchaseOrder/store/usePurchaseStore";
import { usePurchaseFiltersStore } from "@/modules/purchaseOrder/store/usePurchaseFilterStore";
import PurchaseOrderDetail from "@/modules/purchaseOrder/components/modal-box/PurchaseOrderDetail.vue";
import PurchaseEdit from "@/modules/purchaseOrder/components/modal-box/PurchaseEdit.vue";
import SubNavbar from "@/modules/purchaseOrder/components/SubNavbar";
import Sidebar from "@/modules/purchaseOrder/components/Sidebar.vue";
import Pagination from "@/modules/products/components/Pagination.vue";
import PurchaseOrderCard from '@/modules/purchaseOrder/components/PurchaseOrderCard.vue';

const purchaseStore = usePurchaseStore();
const purchaseFilterStore = usePurchaseFiltersStore();

const currentFilters = ref({
  search: "",
  purchase_sales_order_status: "",
  purchase_status: "",
  min_price: null,
  max_price: null,
  min_purchase_qty: null,
  max_purchase_qty: null,
  order_by_name: "date_time_of_placement",
  order_by_param: "desc",
});

const applyFilters = async (filters: any) => {
  currentFilters.value = filters;
  await fetchPage(1);
};

const handleSearchChange = (search: string) => {
  currentFilters.value.search = search;
  applyFilters(currentFilters.value);
  fetchPage(1);
};

const fetchPage = async (page: number) => {
  const params: any = { page, ...currentFilters.value };
  for (const key in params) {
    if (
      params[key] === "" ||
      params[key] === undefined ||
      params[key] === null ||
      params[key] === 0
    ) {
      delete params[key];
    }
  }
  await purchaseStore.fetchPurchases(params);
};

onMounted(async () => {
  fetchPage(1);
  await purchaseFilterStore.fetchPurchaseFilters();
});

const handleDeletePurchase = async (id: number) => {
  await purchaseStore.deletePurchase(id);
};

const isPurchaseOrderDetailOpen = ref(false);
const isPurchaseEditFormOpen = ref(false);
const selectedPurchaseId = ref<number | null>(null);

const closePurchaseOrderDetail = () => {
  isPurchaseOrderDetailOpen.value = false;
};
const closePurchaseEditForm = () => {
  isPurchaseEditFormOpen.value = false;
};

const handleDetailPurchase = (purchaseId: number) => {
  selectedPurchaseId.value = purchaseId;
  isPurchaseOrderDetailOpen.value = true;
};
const handleEditPurchase = (purchaseId: number) => {
  selectedPurchaseId.value = purchaseId;
  isPurchaseEditFormOpen.value = true;
};
</script>
