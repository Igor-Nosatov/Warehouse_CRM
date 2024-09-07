<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick">
    <div class="modal-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="12" class="pt-2 pb-4">
          <v-btn class="close-btn" @click="emitClose">
            <i class="las la-times fs-2"></i>
          </v-btn>
        </v-col>
        <v-col cols="12" class="pb-3">
          <div class="d-flex flex-row">
            <img :src="client_photo" alt="" class="customer-photo">
            <div class="customer-desc">
              <h3 class="cutomer-fullname cutomer-title ps-3 ">{{ customerStore.customer.first_name }} {{ customerStore.customer.last_name }}</h3>
              <p class="ps-3 pt-2">
                <span class="customer-category me-2">Total purchases: {{ customerStore.customer.total_purchases }}</span>
                <span class="secondary-text ps-1 ">Receivables: {{ customerStore.customer.receivables }}</span>
              </p>
            </div>
          </div>
        </v-col>
        <v-col cols="12">
          <div class="tab-navigation d-flex flex-row">
            <button class="tab-navigation-btn" :class="{ tab_navigation_btn_active: activeOpenTab === 1 }"
              @click="openTab(1)">
              General Information
            </button>
          </div>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col cols="12" v-if="activeOpenTab === 1" class="tab ps-6">
          <v-row no-gutters>
            <v-col cols="8" class="ps-2">
              <h3 class="text-capitalize primary-text pb-2 pt-4">Customer details</h3>
              <v-row no-gutters class="pt-2 pb-2">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Customer Type</p>
                </v-col>
                <v-col cols="2">
                  <p class="secondary-text">{{ customerStore.customer.customer_type }}</p>
                </v-col>
              </v-row>
              <v-row no-gutters class="pt-2 pb-2">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Customer photo url</p>
                </v-col>
                <v-col cols="2">
                  <p class="secondary-text">{{ customerStore.customer.customer_photo_url }}</p>
                </v-col>
              </v-row>
              <v-row no-gutters class="pt-2 pb-2">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Status</p>
                </v-col>
                <v-col cols="2">
                  <p class="secondary-text">{{ customerStore.customer.customer_status }}</p>
                </v-col>
              </v-row>
              <v-row no-gutters class="pt-2 pb-2">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Remark</p>
                </v-col>
                <v-col cols="7">
                  <p class="secondary-text">{{ customerStore.customer.remark }}</p>
                </v-col>
              </v-row>
              <h3 class="text-capitalize primary-text pb-2 pt-4">Contact Information</h3>
              <v-row no-gutters class="pt-2 pb-2">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Phone</p>
                </v-col>
                <v-col cols="5">
                  <p class="secondary-text">{{ customerStore.customer.phone }}</p>
                </v-col>
              </v-row>
              <v-row no-gutters class="pt-2 pb-2">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Email</p>
                </v-col>
                <v-col cols="2">
                  <p class="secondary-text">{{ customerStore.customer.email }}</p>
                </v-col>
              </v-row>
              <v-row no-gutters class="pt-2 pb-2">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Customer Created At</p>
                </v-col>
                <v-col cols="2">
                  <p class="secondary-text"> {{ formatAmericanDate(customerStore.customer.created_at) }} </p>
                </v-col>
              </v-row>
              <v-row no-gutters class="pt-2 pb-12">
                <v-col cols="3">
                  <p class="text-uppercase secondary-text-1">Customer Updated At</p>
                </v-col>
                <v-col cols="2">
                  <p class="secondary-text"> {{ formatAmericanDate(customerStore.customer.updated_at) }} </p>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, onMounted } from "vue";
import client_photo from "@/assets/client_photo.png";
import { useCustomerByIdStore } from "../../store/useCustomerByIdStore";
import { formatAmericanDate } from "@/utils/dateUtils";

const props = defineProps({
  isOpen: Boolean,
  customerId: Number,
});

const customerStore = useCustomerByIdStore();

onMounted(async() => {
  await customerStore.fetchCustomerById(props.customerId);
});

const emit = defineEmits(["close"]);

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = (event) => {
  emitClose();
};

const activeOpenTab = ref(1);

const openTab = (buttonId) => {
  activeOpenTab.value = buttonId;
};
</script>

<style scoped>

  /*===================General Information==========================*/
  .customer-photo{
    width:80px;
    border-radius:10px;
  }
  .cutomer-title,.sales-order-title{
    color: #fff;
    font: 22px "Nunito", sans-serif;
    font-weight:700;
  }
  .customer-category,.product-status{
    padding:3px 8px;
    border-radius:7px;
    background: #C91D64;
  }
  .address-card{
    padding:10px;
    color: #fff;
    border-radius: 10px;
    border: 1px solid #5c6869;
    background: #1c2e37;
  }
  /*====================History Action=============================*/
  .history-tab-point-inside {
    height: 20px;
    width: 20px;
    background: #5c6869;
    border-radius: 10px;
    position: relative;
    top: 10px;
    left: 10px;
  }
  .history-tab-point-outside {
    height: 40px;
    width: 40px;
    border-radius: 10px;
    background: #1c2e37;
  }
  .history-tab-vertical-line {
    border-left: 1px dotted #5c6869;
    height: 60px;
  }
  .history-date-title {
    border-radius: 10px;
    border: 1px solid #5c6869;
    background: #1c2e37;
    color: #fff;
    padding: 5px;
    width: fit-content;
  }

  /*================Notes=================*/
  .overflow-card {
    background: #1c2e37;
    border-radius: 10px;
  }
  .note-title {
    font: 16px "Nunito", sans-serif;
    font-weight: 400;
    color: #fff;
  }
  .notes-textarea {
    border-radius: 10px;
    border: 1px solid #5c6869;
    background: #1c2e37;
    padding: 5px;
    width: 550px;
    height: 130px;
    position: relative;
    top: 10px;
    left: 28px;
  }
  .note-btn {
    background: #00f579;
    color: #1c2e37;
    border-radius: 10px;
    padding: 10px 20px;
    width: fit-content;
    position: relative;
    top: 25px;
    left: 28px;
    text-transform: capitalize;
    font: 16px "Nunito", sans-serif;
    font-weight: 700;
  }
  .note-card {
    border-radius: 10px;
    padding: 10px;
    border: 1px solid #5c6869;
    background: #1c2e37;
    width: 750px;
    height: fit-content;
  }
  .note-card-img {
    height: 40px;
    width: 40px;
    border-radius: 10px;
  }
  .note-card-desc {
    border-top: 1px solid #5c6869;
  }
  /*=================Transaction Info======================*/
  .transaction-block-desc {
    overflow: scroll;
    background: #1c2e37;
    height:550px;
    overflow-x: hidden;
  }

  /*===============ItemCard========================*/
  .block-package-status {
    border-radius: 15px;
    background-color: #303d44;
    height:auto;
  }
  .order-title,.order-price{
    color:#fff;
    font: 25px "Nunito", sans-serif !important;
  }
  .order-price{
    position: relative;
    bottom:7px;
  }
  .order-line-divider{
    height:30px;
    width:3px;
    background: #fff;
  }
  .border-left-card-price{
    border-left:1px solid #919da1;
    height: auto;
    padding-left:30px;
  }
  .cube-btn-order{
    height: 40px;
    width:40px;
    position: relative;
    right:3px;
    bottom:17px;
    margin-right: 10px;
  }
  .reorder-progress-bar{
    margin-top:25px;
    height:4px;
    border-radius:10px;
    width:200px;
    background: #cbcccb;
  }
  .warehouse-location-title{
    position: relative;
    top:2px;
  }
  .reorder-dot{
    position: relative;
    top:5px;
    margin:0px 3px;
    height: 10px;
    width: 10px;
    background: #00d26d;
    border-radius: 100%;
  }

  .warehouse-title{
    position: relative;
    bottom:1px;
  }

  .package-status-subtitle{
    margin-top:10px;
  }

  /*====================Sales Order Card=======================*/
  .sales-order-card{
    border-radius:10px;
    width: fit-content;
    background: #1e292f;
    border: 1px #223842 solid;
    color:#fff;
    padding:20px;
  }
  .sales-order-subcard{
    border-radius:10px;
    width: fit-content;
    background: #1e292f;
    border: 1px #223842 solid;
    padding:10px;
  }

  /*====================End Sales Order Card===================*/


</style>
