<template>
  <v-card class="item-card-vendor mr-2 ml-1">
    <v-row no-gutters>
      <v-col cols="3" class="d-flex flex-row pt-2">
        <img :src="company_logo" alt="New Balance" class="card-img-photo" />
        <div class="d-flex flex-column">
          <h5 class="card-product-title ps-5 pt-5">Acme corp</h5>
          <p class="card-product-subtitle ps-5 pt-5">Jake Jenton</p>
        </div>
        <div class="line_divider1"></div>
      </v-col>
      <v-col cols="9" class="price-product-block">
        <v-row no-gutters>
          <v-col cols="4" class="pt-8 d-flex flex-row">
            <div class="d-flex flex-column">
              <p class="card-price-title text-left pb-2">Contacts</p>
              <div class="d-flex flex-row">
                <p class="card-price text-left">jakejenton@gmail.com</p>
                <div class="line_divider2"></div>
                <p class="card-price text-left">+122-886-7089</p>
              </div>
            </div>
          </v-col>
          <v-col cols="3" class="pt-8 ps-12">
            <p class="card-price-title text-left pb-2">Receivables</p>
            <p class="card-price text-left">$747.23</p>
          </v-col>
          <v-col cols="2" class="pt-8 pe-8">
            <p class="card-price-title text-left pb-2">Used Credits</p>
            <p class="card-price text-left">$747.23</p>
          </v-col>
          <v-col cols="3" class="pt-8 ps-12">
            <div class="d-flex flex-row">
              <div class="d-flex flex-row ms-11">
                <i class="las la-info cube-btn"></i>
                <i class="las la-pen-alt cube-btn"></i>
                <i class="las la-trash cube-btn"></i>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="12">
        <div
          class="d-flex flex-row justify-space-between vendor-status ps-3 pe-3 ms-5 me-5 color-white pt-4"
        >
          <div class="d-flex flex-row">
            <i class="las la-map-marked-alt pe-2 h-25 icon-size"></i>
            <h3>Charles-de-Gaulle-Str. 20 53113, Bonn, Nordrhein-Westfalen</h3>
            <i class="las la-box ps-4 pe-2 icon-size"></i>
            <h3>12 product(s)</h3>
          </div>
          <div class="d-flex flex-row">
            <p class="pe-3 pt-1">PORTAL STATUS</p>
            <p class="package-status pt-1">Active</p>
          </div>
        </div>
      </v-col>
      <v-col cols="12">
        <VendorDetail :is-open="isModalOpen" @close="closeModal" />
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup lang="ts">
import { ref } from "vue";
import company_logo from "@/assets/company_logo.png";
import VendorDetail from "../components/modal-box/VendorDetail.vue";

const isModalOpen = ref(false);

const openModal = () => {
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
};
</script>
