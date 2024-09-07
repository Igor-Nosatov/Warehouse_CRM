<template>
  <v-card class="item-card-vendor mr-2 ml-1">
    <v-row no-gutters>
      <v-col cols="3" class="d-flex flex-row pt-2">
        <img :src="companyLogo" alt="Company Logo" class="card-img-photo" />
        <div class="d-flex flex-column">
          <p class="card-product-title ps-5 pt-6">
            {{ vendor.company_name }}
          </p>
          <p class="card-product-subtitle ps-5 pt-5">
            {{ vendor.vendor_first_name }} {{ vendor.vendor_last_name }}
          </p>
        </div>
      </v-col>
      <v-col cols="9">
        <v-row no-gutters>
          <v-col cols="5" class="pt-8 d-flex flex-row">
            <div class="d-flex flex-column contact-block ps-5">
              <p class="card-price-title text-left pb-1">Contacts</p>
              <p class="card-price text-left">
                <span><i class="las la-at icon-size contact-icon"></i>: {{ vendor.email }}</span><br>
                <span><i class="las la-phone icon-size contact-icon"></i>: {{ vendor.phone }}</span>
              </p>
            </div>
          </v-col>
          <v-col cols="2" class="pt-8 ps-12">
            <p class="card-price-title text-left pb-2">Receivables</p>
            <p class="card-price text-left">
              ${{ vendor.receivables }}
            </p>
          </v-col>
          <v-col cols="2" class="pt-8 pe-8">
            <p class="card-price-title text-left pb-2">Used Credits</p>
            <p class="card-price text-left">
              ${{ vendor.used_credits }}
            </p>
          </v-col>
          <v-col cols="3" class="pt-8">
            <div class="d-flex justify-end pe-5">
              <i class="las la-info cube-btn" @click="handleDetailVendor(vendor.id)"></i>
              <i class="las la-pen-alt cube-btn" @click="handleEditVendor(vendor.id)"></i>
              <i class="las la-trash cube-btn" @click="handleDeleteVendor(vendor.id)"></i>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row no-gutters class="mt-4">
      <v-col cols="12">
        <div class="d-flex flex-row justify-space-between vendor-status ps-3 pe-3 ms-5 me-5 color-white pt-4">
          <div class="d-flex flex-row">
            <i class="las la-map-marked-alt pe-2 h-25 icon-size"></i>
            <p class="card-sub-title">
              {{ vendor.location }}
            </p>
            <i class="las la-box ps-4 pe-2 icon-size"></i>
            <p class="card-sub-title">
              Vendor type: {{ vendor.vendor_type }}
            </p>
          </div>
          <div class="d-flex flex-row">
            <p class="pe-3 pt-1">Vendor Status:</p>
            <p class="package-status pt-1">
              {{ vendor.vendor_status }}
            </p>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup lang="ts">
import { PropType } from 'vue';
import companyLogo from "@/assets/company_logo.png";

const props = defineProps({
  vendor: {
    type: Object as PropType<Vendor>,
    required: true
  },
  handleDetailVendor: {
    type: Function as PropType<(vendorId: number) => void>,
    required: true
  },
  handleEditVendor: {
    type: Function as PropType<(vendorId: number) => void>,
    required: true
  },
  handleDeleteVendor: {
    type: Function as PropType<(vendorId: number) => void>,
    required: true
  }
});

interface Vendor {
  id: number;
  company_name: string;
  vendor_first_name: string;
  vendor_last_name: string;
  email: string;
  phone: string;
  receivables: number;
  used_credits: number;
  location: string;
  vendor_type: string;
  vendor_status: string;
}
</script>

<style scoped>
.card-img-photo {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 50%;
}
.icon-size {
  font-size: 18px;
}
.cube-btn {
  cursor: pointer;
}
</style>
