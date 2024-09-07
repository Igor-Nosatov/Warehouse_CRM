<template>
  <v-row no-gutters class="pr-4 pb-4">
    <v-col
      cols="3"
      class="pl-4"
      v-for="(metric, key) in metrics"
      :key="key"
    >
      <v-card class="total-score-card">
        <div class="d-flex flex-row justify-space-between">
          <div>
            <div class="decorator-line"></div>
            <i :class="icons[key] + ' ml-8 mt-1'"></i>
          </div>
          <div class="score-procent pt-12 pr-4">
            <i class="las la-leaf"></i>
            <span>{{ metric.percentage }}%</span>
          </div>
        </div>
        <p class="title-score pt-9 pl-4">{{ titles[key] }}</p>
        <h3 class="total-score pt-3 pl-4 pb-5">{{ metric.qty }}</h3>
      </v-card>
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import { computed, defineProps } from 'vue';

const props = defineProps<{
  metrics?: {
    totalProductPacked: { qty: number; percentage: number };
    totalProductToBeProcessing: { qty: number; percentage: number };
    totalProductShipped: { qty: number; percentage: number };
    totalSalesProductDelivered: { qty: number; percentage: number };
  };
}>();

const titles = {
  totalProductPacked: "TOTAL TO BE PACKED",
  totalProductToBeProcessing: "TOTAL PRODUCT TO BE RECEIVED",
  totalProductShipped: "TOTAL QUANTITY ON HAND",
  totalSalesProductDelivered: "TOTAL PRODUCT IN INVENTORY",
};

const icons = {
  totalProductPacked: "las la-archive",
  totalProductToBeProcessing: "las la-truck",
  totalProductShipped: "las la-hands-helping",
  totalSalesProductDelivered: "las la-building",
};

const metrics = computed(() => props.metrics || {
  totalProductPacked: { qty: 0, percentage: 0 },
  totalProductToBeProcessing: { qty: 0, percentage: 0 },
  totalProductShipped: { qty: 0, percentage: 0 },
  totalSalesProductDelivered: { qty: 0, percentage: 0 },
});
</script>
<style scoped>

.total-score-card,
.top-product-card,
.column-chart {
    background-color: #17262e;
    width: 100%;
    height: auto;
    border-radius: 25px;
}

.title-score {
    color: #666;
    font: 18px "Nunito", sans-serif;
    font-weight: 700;
}

.total-score {
    color: #fff;
    font: 50px "Nunito", sans-serif;
    font-weight: 700;
}

.decorator-line {
    background-color: #00ce6c;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    width: 5px;
    height: 24px;
    position: relative;
    top: 45px;
}

.la-building,
.la-hands-helping,
.la-truck,
.la-archive {
    background-color: #1e313a;
    color: #fff;
    padding: 8px;
    border-radius: 5px;
    font-size: 40px;
}

.score-procent {
    font: 20px "Nunito", sans-serif;
    color: #fff;
    text-transform: capitalize;
    font-weight: 700;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
}

.la-leaf {
    background-color: #bbef20;
    padding: 3px 3px;
    border-radius: 35px;
}
</style>
