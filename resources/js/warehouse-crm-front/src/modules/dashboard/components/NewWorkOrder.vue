<template>
  <v-card class="top-product-card pr-3 pl-3 pb-4 pt-3">
      <div class="d-flex flex-row justify-space-between">
          <p class="top-product-card-title pl-5 pt-5 pb-5">
              Active work order
          </p>

          <RouterLink to="/sales-order" class="top-product-card-link pr-5 pt-5 pb-5">
              View More
              <i class="las la-caret-right pl-1"></i>
          </RouterLink>
      </div>

      <div v-if="orders.length === 0">No orders available.</div>

      <v-col cols="12" v-for="order in orders" :key="order.id" class="pb-3">
          <v-card class="order-card mr-2 ml-1">
              <div class="d-flex flex-row pb-2 pt-2">
                  <h6 class="order-title">{{ order.product.sku }}</h6>
                  <p class="pt-4">
                      <span class="required-pcs">Required quantity: {{order.total_quantity}}pcs</span>
                  </p>
              </div>
              <v-row>
                  <v-col cols="11">
                      <div class="progress-bar-layout pt-2 pb-2 ps-8">
                          <div class="progress-bar-empty"></div>
                          <div class="progress-bar-fill "></div>
                          <div class="progress-bar-dotted"></div>
                          <div class="progress-bar-score">50%</div>
                      </div>
                  </v-col>
                  <v-col cols="1" class="pa-4"> </v-col>
              </v-row>

              <div class="d-flex flex-row sub-data">
                  <i class="las la-calendar-week"></i>
                  <div class="me-2">
                      <p class="order-subtitle">EXPECTED FINISHED DATE</p>
                      <p class="order-desc">{{ formatDate(order.date_time_of_placement) }}</p>
                  </div>
                  <i class="las la-dollar-sign"></i>
                  <div>
                      <p class="order-subtitle">ORDER COST</p>
                      <p class="order-desc">${{  order.total_amount }}</p>
                  </div>
              </div>
          </v-card>
      </v-col>
  </v-card>
</template>

<script setup lang="ts">
import { defineProps, watch } from 'vue';

const props = defineProps<{
orders: Array<{
  id: number;
  status: string;
  total_amount: number;
  total_quantity: number;
  date_time_of_placement: string;
  delivery_location: string;
  product_id: number;
  customer_id: number;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
  payment_status_id: number;
  product: {
    id: number;
    is_returnable: boolean;
    is_have_variant: boolean;
    core_product_id: number;
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
  };
}>;
}>();

const formatDate = (dateString: string) => {
const date = new Date(dateString);
return date.toLocaleDateString();
};

watch(() => props.orders, (newOrders) => {
}, { deep: true });
</script>

<style scoped>
.top-product-card-title,
.column-chart-title {
    font: 24px "Nunito", sans-serif;
    color: #fff;
    font-weight: 700;
}

.top-product-card-link {
    font: 24px "Nunito", sans-serif;
    color: #00ce6c;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: none;
}

.total-score-card,
.top-product-card,
.column-chart {
    background-color: #17262e;
    width: 100%;
    height: auto;
    border-radius: 25px;
}

/*=================Order Progress================*/

.order-card {
    margin-top: 1px;
    border-radius: 15px;
    background-color: #1c2e37;
    height: 160px;
    width: 100%;
}

.total-pcs {
    font: 14px "Nunito", sans-serif !important;
    font-weight: 800 !important;
    color: #fff;
    padding: 5px 15px 5px 15px;
}

.required-pcs {
    font: 14px "Nunito", sans-serif !important;
    font-weight: 800 !important;
    color: #fff;
    padding: 5px 15px 5px 15px;
}

.total-pcs-dash {
    font: 14px "Nunito", sans-serif !important;
    margin-top: 10px;
    padding: 5px 0px 5px 0px;
    color: #fff;
    height: 4px;
    width: 35px;
}

.progress-bar-layout {
    margin-right: 15px;
}

.progress-bar-empty {
    height: 10px;
    width: 105%;
    background: #243b46;
    border-radius: 2.5px;
}

.progress-bar-fill {
    height: 10px;
    width: 50%;
    background: #00ffd5;
    border-radius: 2.5px;
    position: relative;
    bottom: 10px;
}

.progress-bar-dotted {
    height: 2px;
    width: 50%;
    position: relative;
    bottom: 16.5px;
    border-top: 2px dotted #000;
}

.progress-bar-score {
    font: 12px "Nunito", sans-serif !important;
    font-weight: 800 !important;
    border: 1px solid #00ffd5;
    background: #17262e;
    color: #00ffd5;
    border-radius: 5px;
    padding: 2px 2px 2px 6px;
    width: 40px;
    position: relative;
    bottom: 28px;
    left: 48%;
}

.sub-data {
    padding-left: 35px;
    font-size: 18px;
    position: relative;
    bottom: 25px;
}

.la-calendar-week {
    font-size: 25px;
    padding: 6px 0px 0px 8px;
    color: #fff;
    background: #17262e;
    border-radius: 100%;
    height: 40px;
    width: 40px;
}

.order-subtitle {
    font: 14px "Nunito", sans-serif !important;
    font-weight: 900;
    margin-top: 5px;
    margin-left: 5px;
    color: #fff;
    text-transform: uppercase;
}

.order-desc {
    margin-top: 5px;
    margin-left: 5px;
    color: #fff;
    font: 12px "Nunito", sans-serif;
}

</style>
