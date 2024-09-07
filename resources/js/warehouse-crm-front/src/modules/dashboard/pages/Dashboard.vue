<template>
  <v-row no-gutters>
    <v-col cols="12">
      <SubNavbar />
    </v-col>
    <v-col cols="12">
      <v-row no-gutters class="pr-4 pt-5 pb-5">
        <v-col cols="7" class="ps-4 pe-4">
          <ChartStockLevel :stockLevels="stockLevels" />
        </v-col>
        <v-col cols="5">
          <TopSellingProducts :products="bestSellingProducts" />
        </v-col>
      </v-row>
    </v-col>
    <v-col cols="12">
      <TotalCounts :metrics="salesOrderCounts" />
    </v-col>
    <v-col cols="12">
      <v-row no-gutters class="pb-8">
        <v-col cols="6" class="ps-4 pe-2">
          <NewWorkOrder :orders="activeWorkOrders" />
        </v-col>
        <v-col cols="6" class="ps-2 pe-4">
          <ChartSalesOrder :summary="salesOrderSummary" />
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useDashboardStore } from '@/modules/dashboard/store/useDashboardStore';
import SubNavbar from "@/modules/dashboard/components/SubNavbar.vue";
import ChartStockLevel from "@/modules/dashboard/components/ChartStockLevel.vue";
import TopSellingProducts from "@/modules/dashboard/components/TopSellingProducts.vue";
import TotalCounts from "@/modules/dashboard/components/TotalCounts.vue";
import NewWorkOrder from "@/modules/dashboard/components/NewWorkOrder.vue";
import ChartSalesOrder from "@/modules/dashboard/components/ChartSalesOrder.vue";

const dashboardStore = useDashboardStore();

const stockLevels = ref({});
const bestSellingProducts = ref([]);
const salesOrderCounts = ref({
  totalProductPacked: { qty: 0, percentage: 0 },
  totalProductToBeProcessing: { qty: 0, percentage: 0 },
  totalProductShipped: { qty: 0, percentage: 0 },
  totalSalesProductDelivered: { qty: 0, percentage: 0 },
});
const activeWorkOrders = ref([]);
const salesOrderSummary = ref({});

onMounted(async () => {
  await dashboardStore.fetchDashboardData();

  stockLevels.value = dashboardStore.dashboardData?.stockLevel || {};
  bestSellingProducts.value = dashboardStore.dashboardData?.bestSellingProducts || [];
  salesOrderCounts.value = dashboardStore.dashboardData?.salesOrderCounts || {
    totalProductPacked: { qty: 0, percentage: 0 },
    totalProductToBeProcessing: { qty: 0, percentage: 0 },
    totalProductShipped: { qty: 0, percentage: 0 },
    totalSalesProductDelivered: { qty: 0, percentage: 0 },
  };
  activeWorkOrders.value = dashboardStore.dashboardData?.activeWorkOrder?.filter(order => order.product) || [];
  salesOrderSummary.value = dashboardStore.dashboardData?.salesOrderSummary || {};

});
</script>
