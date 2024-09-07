<template>
  <v-card class="item-card mr-2 ml-1">
    <v-row no-gutters>
      <v-col cols="7" class="d-flex flex-row pt-2 pb-3">
        <img :src="imageSrc" alt="Product Image" class="card-img" />
        <div class="d-flex flex-column">
          <h5 class="card-product-title ps-5 pt-5">{{ product.title }}</h5>
          <div class="ps-5 pt-2 d-flex flex-row">
            <div class="card-product-type">
              <i class="las la-warehouse pe-1 ps-2 pt-1"></i>Category:
            </div>
            <div class="card-product-category pe-2">{{ product.category.name }}</div>
            <div class="card-product-type">
              <i class="las la-warehouse pe-1 ps-2 pt-1"></i>Brand:
            </div>
            <div class="card-product-count-stock">{{ product.brand.name }}</div>
          </div>
        </div>
      </v-col>
      <v-col cols="5" class="price-product-block">
        <v-row no-gutters>
          <v-col cols="4" class="pt-8 d-flex flex-row">
            <div class="border-left-card-price">
              <p class="card-price-title text-left pb-2">Retail Price</p>
              <p class="card-price text-left">{{ formatPrice(product.retail_price) }}</p>
            </div>
          </v-col>
          <v-col cols="4" class="pt-8">
            <p class="card-price-title text-left pb-2">Wholesale Price</p>
            <p class="card-price text-left">{{ formatPrice(product.wholesale_price) }}</p>
          </v-col>
          <v-col cols="4" class="pt-8 pe-3">
            <div class="d-flex flex-row">
              <i class="las la-info cube-btn cube-btn-small" @click="onDetailClick"></i>
              <i class="las la-pen-alt cube-btn cube-btn-small" @click="onEditClick"></i>
              <i class="las la-trash cube-btn cube-btn-small" @click="onDeleteClick"></i>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';

const props = defineProps<{
  product: {
    id: number;
    title: string;
    category: { name: string };
    brand: { name: string };
    retail_price: number | null;
    wholesale_price: number | null;
  };
  imageSrc: string;
}>();

const emit = defineEmits<{
  (event: 'detail-click'): void;
  (event: 'edit-click'): void;
  (event: 'delete-click'): void;
}>();

const formatPrice = (price: number | null) => (price ? `$ ${price.toFixed(2)}` : 'N/A');

const onDetailClick = () => emit('detail-click');
const onEditClick = () => emit('edit-click');
const onDeleteClick = () => emit('delete-click');
</script>
