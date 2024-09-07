<template>
  <v-card class="item-card mr-2 ml-1">
    <v-row no-gutters>
      <v-col cols="3" class="d-flex flex-row pt-2">
        <img :src="client_photo" alt="New Balance" class="card-img-photo" />
        <div class="d-flex flex-column">
          <h5 class="card-product-title ps-5 pt-5">Jake Jenton</h5>
          <div class="ps-5 pt-2 d-flex flex-row">
            <div class="card-product-category pe-1">Retail</div>
            <div class="dot"></div>
            <div class="card-product-category pe-1">Manually Added</div>
          </div>
        </div>
      </v-col>
      <v-col cols="9" class="price-product-block">
        <v-row no-gutters>
          <v-col cols="3" class="pt-8 d-flex flex-row">
            <div class="border-left-card-price">
              <p class="card-price-title text-left pb-2">Email</p>
              <p class="card-price text-left">jakejenton@gmail.com</p>
            </div>
          </v-col>
          <v-col cols="3" class="pt-8">
            <p class="card-price-title text-left pb-2">Phone</p>
            <p class="card-price text-left">+122-886-7089</p>
          </v-col>
          <v-col cols="3" class="pt-8">
            <p class="card-price-title text-left pb-2">Receivables</p>
            <p class="card-price text-left">$747.23</p>
          </v-col>
          <v-col cols="3" class="pt-8">
            <div class="d-flex flex-row">
              <i class="las la-info cube-btn cube-btn-small"></i>
              <i class="las la-pen-alt cube-btn cube-btn-small"></i>
              <i class="las la-trash cube-btn cube-btn-small"></i>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";
import client_photo from "@/assets/client_photo.png";
import "@/modules/customer/styles/ItemCard.css";

const emits = defineEmits(["click"]);
const handleClick = () => {
  emits("click");
};
</script>
