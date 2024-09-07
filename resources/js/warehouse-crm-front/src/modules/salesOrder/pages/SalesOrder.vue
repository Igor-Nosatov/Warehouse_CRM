
<template>
  <v-row>
    <v-col cols="12">
      <SubNavBar
        :total-sales="salesOrderStore.meta.total"
        :payment-status="salesOrderFilterStore.paymentStatus"
      />
    </v-col>
    <v-col cols="3" class="ps-7 pe-4">
      <Sidebar
        :salesOrderStatus="salesOrderFilterStore.orderStatus"
        :paymentStatus="salesOrderFilterStore.paymentStatus"
        :filters="currentFilters"
        @filters-changed="applyFilters"
      />
    </v-col>
    <v-col cols="9" class="ps-s pe-4 pt-3">
      <v-row no-gutters>
        <v-col
          cols="12"
          v-for="salesOrder in salesOrderStore.salesOrders"
          :key="salesOrder.id"
        >
          <SalesOrderCard
            :salesOrder="salesOrder"
            @detailSalesOrder="handleDetailSalesOrder"
            @editSalesOrder="handleEditSalesOrder"
            @deleteSalesOrder="handleDeleteSalesOrder"
          />
        </v-col>
      </v-row>
    </v-col>
    <v-col offset="3" cols="9" class="pt-6 pb-12">
      <Pagination
        :current-page="salesOrderStore.meta.current_page"
        :last-page="salesOrderStore.meta.last_page"
        @page-changed="fetchPage"
      />
    </v-col>
    <v-col cols="12">
      <SalesOrderDetail
        :is-open="isSalesOrderDetailOpen"
        @close="closeSalesOrderDetail"
        :salesOrderId="selectedSalesOrderId"
      />
    </v-col>
    <v-col cols="12">
      <EditSalesOrder
        :is-open="isSalesOrderEditFormOpen"
        @close="closeSalesOrderEditForm"
        :sales-id="selectedSalesOrderId"
      />
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useSalesOrderStore } from '../store/useSalesOrderStore';
import { useSalesOrderFilterStore } from '../store/useSalesOrderFilterStore';
import SubNavBar from '@/modules/salesOrder/components/SubNavBar';
import Sidebar from '@/modules/salesOrder/components/Sidebar.vue';
import Pagination from '@/modules/products/components/Pagination.vue';
import SalesOrderDetail from '@/modules/salesOrder/components/modal-box/SalesOrderDetail.vue';
import EditSalesOrder from '@/modules/salesOrder/components/modal-box/EditSalesOrder.vue';
import SalesOrderCard from '@/modules/salesOrder/components/SalesOrderCard.vue';

const salesOrderStore = useSalesOrderStore();
const salesOrderFilterStore = useSalesOrderFilterStore();

const currentFilters = ref({
  sales_order_status: '',
  payment_status: '',
  min_product_quantity: null,
  max_product_quantity: null,
  min_price: null,
  max_price: null,
  order_by_name: 'date_time_of_placement',
  order_by_param: 'desc',
  search: ''
});

const applyFilters = async (filters: any) => {
  currentFilters.value = filters;
  await fetchPage(1);
};

const fetchPage = async (page: number) => {
  const params: any = { page, ...currentFilters.value };
  for (const key in params) {
    if (params[key] === '' || params[key] === undefined || params[key] === null || params[key] === 0) {
      delete params[key];
    }
  }
  await salesOrderStore.fetchSalesOrders(params);
};

onMounted(async () => {
  fetchPage(1);
  await salesOrderFilterStore.fetchSalesOrderFilters();
});

const handleDeleteSalesOrder = async (orderId: number) => {
  await salesOrderStore.deleteSalesOrder(orderId);
  fetchPage(1);
};

const isSalesOrderDetailOpen = ref(false);
const isSalesOrderEditFormOpen = ref(false);
const selectedSalesOrderId = ref<number | null>(null);

const handleDetailSalesOrder = (salesOrderId: number) => {
  selectedSalesOrderId.value = salesOrderId;
  isSalesOrderDetailOpen.value = true;
};

const handleEditSalesOrder = (salesOrderId: number) => {
  selectedSalesOrderId.value = salesOrderId;
  isSalesOrderEditFormOpen.value = true;
};

const closeSalesOrderDetail = () => {
  isSalesOrderDetailOpen.value = false;
};

const closeSalesOrderEditForm = () => {
  isSalesOrderEditFormOpen.value = false;
};
</script>

