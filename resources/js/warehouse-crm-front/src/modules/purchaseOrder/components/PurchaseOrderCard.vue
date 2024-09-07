<template>
  <v-card class="item-card-purchase-order mr-2 ml-1 pt-3">
    <v-row no-gutters>
      <v-col cols="12" class="ps-6">
        <div class="d-flex flex-row justify-space-between">
          <div class="d-flex flex-row pt-6">
            <h5 class="order-title text-uppercase text-h5 ms-3 pt-1">
              {{ purchase.vendor.company_name }}
            </h5>
            <div class="order-line-divider ms-3 me-3"></div>
            <p class="card-sub-title ps-4 pe-2 pt-1">Amount: ${{ purchase.total_amount }}</p>
            <div class="order-line-divider ms-3 me-3"></div>
            <div class="d-flex flex-row pt-1 ms-2 me-1">
              <p class="card-sub-title me-2">Payment Status: </p>
              <p class="package-status pt-1 package-status-position"> {{ purchase.payment_status.name }}</p>
            </div>
          </div>
          <div class="d-flex flex-row pt-1">
            <div class="d-flex flex-row pe-2">
              <i
                class="las la-info cube-btn cube-btn-small"
                @click="handleDetailPurchase(purchase.id)"
              ></i>
              <i
                class="las la-pen-alt cube-btn cube-btn-small"
                @click="handleEditPurchase(purchase.id)"
              ></i>
              <i
                class="las la-trash cube-btn cube-btn-small"
                @click="handleDeletePurchase(purchase.id)"
              ></i>
            </div>
          </div>
        </div>
      </v-col>
    </v-row>
    <v-row no-gutters class="mt-4">
      <v-col cols="12">
        <div class="d-flex flex-row justify-space-between vendor-status ps-3 pe-3 ms-5 me-5 color-white pt-4">
          <div class="d-flex flex-row">
            <i class="las la-map-marked-alt pe-2 h-25 icon-size"></i>
            <p class="card-sub-title">
              {{ purchase.delivery_location }}
            </p>
            <i class="las la-box ps-4 pe-2 icon-size"></i>
            <p class="card-sub-title">
              Date time of placement: {{ formatAmericanDate(purchase.date_time_of_placement) }}
            </p>
          </div>
          <div class="d-flex flex-row">
            <p class="pe-3 pt-1">Purchase Delivery Status:</p>
            <p class="package-status pt-1 package-status-position">
              {{ purchase.status }}
            </p>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { formatAmericanDate } from "@/utils/dateUtils";

const props = defineProps({
  purchase: Object
});

const emits = defineEmits(['detail', 'edit', 'delete']);

const handleDetailPurchase = (id: number) => {
  emits('detail', id);
};

const handleEditPurchase = (id: number) => {
  emits('edit', id);
};

const handleDeletePurchase = (id: number) => {
  emits('delete', id);
};
</script>
