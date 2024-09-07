<template>
  <v-card class='item-card mr-2 ml-1'>
    <v-row no-gutters>
      <v-col cols='3' class='d-flex flex-row pt-2'>
        <img :src='customerPhoto' alt='Customer Photo' class='card-img-photo' />
        <div class='d-flex flex-column'>
          <h5 class='card-product-title ps-5 pt-6'>
            {{ customer.first_name }} {{ customer.last_name }}
          </h5>
          <div class='ps-5 pt-2 d-flex flex-row'>
            <p class='card-product-category pe-1'>Customer type: </p>
            <p class='card-product-category pe-1'>{{ customer.customer_type }}</p>
          </div>
        </div>
      </v-col>
      <v-col cols='9' class='price-product-block'>
        <v-row no-gutters>
          <v-col cols='4' class='pt-8 d-flex flex-row'>
            <div class='border-left-card-price'>
              <p class='card-price-title text-left pb-2'>Email</p>
              <p class='card-price text-left'>{{ customer.email }}</p>
            </div>
          </v-col>
          <v-col cols='3' class='pt-8'>
            <p class='card-price-title text-left pb-2'>Phone</p>
            <p class='card-price text-left'>{{ customer.phone }}</p>
          </v-col>
          <v-col cols='2' class='pt-8'>
            <p class='card-price-title text-left pb-2'>Receivables</p>
            <p class='card-price text-left'>${{ customer.receivables }}</p>
          </v-col>
          <v-col cols='3' class='pt-8'>
            <div class='d-flex flex-row'>
              <i class='las la-info cube-btn cube-btn-small' @click='$emit("view-detail", customer.id)'></i>
              <i class='las la-pen-alt cube-btn cube-btn-small' @click='$emit("edit", customer.id)'></i>
              <i class='las la-trash cube-btn cube-btn-small' @click='$emit("delete", customer.id)'></i>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
const props = defineProps({
  customer: Object,
  customerPhoto: String,
});
const emits = defineEmits(['view-detail', 'edit', 'delete']);
</script>
