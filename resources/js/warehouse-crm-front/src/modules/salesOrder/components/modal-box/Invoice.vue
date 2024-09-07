<template>
  <div v-if="isOpenInvoice" class="modal-backdrop" @click="handleBackdropClickInvoice">
    <div class="modal" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="12" class="pt-2 pb-4">
          <v-btn class="close-btn" @click="emitCloseInvoice">
            <i class="las la-times fs-2"></i>
          </v-btn>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col cols="12">
          <v-card class="invoice-report ps-4 pe-4 pt-4 pb-4">
            <div class="d-flex flex-row justify-center">
              <img :src="logo" alt="" class="slide-logo me-2">
              <h2 class="text-center slide-logo-title">StockSavvy</h2>
            </div>
            <v-row no-gutters class="pt-4 pb-4 invoice-bar">
              <v-col cols="12">
                <div class="d-flex flex-row justify-space-between">
                  <h3 class="text-uppercase invoice-ind-title">
                     INV-124
                  </h3>
                  <p class="text-capitalize">
                   <span class="secondary-text pe-2">Invoice to:</span>
                   <span class="primary-text-1">Jhnoe Doe</span>
                  </p>
                </div>
              </v-col>
            </v-row>
            <v-row no-gutters class="pt-4 pb-2">
              <v-col cols="12">
                <div class="d-flex flex-row justify-space-between pb-2">
                  <p class="text-capitalize">
                    <span class="secondary-text pe-2">Invoice date:</span>
                    <span class="primary-text-1">7-11-2025</span>
                   </p>
                   <p class="text-capitalize">
                    <span class="secondary-text pe-2">Terms:</span>
                    <span class="primary-text-1">Due On Receipt</span>
                   </p>
                </div>
              </v-col>
              <v-col cols="12">
                <div class="d-flex flex-row justify-space-between pb-2">
                  <p class="text-capitalize">
                    <span class="secondary-text pe-2">Due date:</span>
                    <span class="primary-text-1">Jhnoe Doe</span>
                   </p>
                   <p class="text-capitalize">
                    <span class="secondary-text pe-2">#PO</span>
                    <span class="primary-text-1">SO-562</span>
                   </p>
                </div>
              </v-col>
              <v-col cols="12" class="bg-grey pb-3 pt-3 ps-2 pe-2">
                <v-row no-gutters class="">
                  <v-col cols="4" class="ps-2">
                    <p class="secondary-text text-uppercase">Product</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text text-uppercase">Qty</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text text-uppercase">Rate</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text text-uppercase">Tax</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text text-uppercase">Subtotal</p>
                  </v-col>
                </v-row>
                <v-row no-gutters class="pb-2 pt-3 invoice-bar">
                  <v-col cols="4">
                      <div class="d-flex flex-column">
                        <span class="text-capitalize primary-text-1 ps-2">Nike 23KJ</span>
                      </div>
                  </v-col>
                  <v-col cols="2" ><span class="primary-text-1">2(pcs)</span></v-col>
                  <v-col cols="2"><span class="primary-text-1">24.00</span></v-col>
                  <v-col cols="2"><span class="primary-text-1">10%</span></v-col>
                  <v-col cols="2"><span class="primary-text-1">58.00</span></v-col>
                </v-row>
                <v-row no-gutters class="pt-4">
                  <v-col cols="6" offset="6">
                    <div class="d-flex flex-row justify-space-between pb-2">
                      <p class="text-uppercase secondary-text">SUB Total</p>
                      <p class="primary-text-1 pe-12 me-2">58.00</p>
                    </div>
                    <div class="d-flex flex-row justify-space-between pb-2">
                      <p class="text-uppercase secondary-text">Discount</p>
                      <p class="primary-text-1 pe-12 me-2"> - </p>
                    </div>
                    <div class="d-flex flex-row justify-space-between pb-2">
                      <p class="text-capitalize secondary-text">Total</p>
                      <p class="primary-text-1 pe-12 me-2">58.00</p>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>

          </v-card>
        </v-col>
        <v-col cols="12">
          <div class="slide-footer d-flex flex-row">
           <v-btn class="send-btn mt-4 ms-6">Send Email</v-btn>
           <v-btn class="standard-btn mt-4 me-6 ms-2">Print Invoice</v-btn>
          </div>
        </v-col>
      </v-row>
  </div>
</div>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits } from "vue";
import logo from '@/assets/logo.png';

const props = defineProps({
  isOpenInvoice: Boolean,
});

const emit = defineEmits(["close"]);

const emitCloseInvoice = () => {
  emit("close");
};

const handleBackdropClickInvoice = (event) => {
  emitCloseInvoice();
};
</script>
<style>

  /*====================Tab Navbar=====================*/
  .slide-logo-title{
    color: #000;
    font: 25px/1 "Nunito", sans-serif;
    margin-top:5px;
  }
  .invoice-ind-title{
    color: #000;
    font: 20px/1 "Nunito", sans-serif;
    margin-top:5px;
  }
  .primary-text {
    color: #fff;
    font: 18px/1 "Nunito", sans-serif;
  }

  .primary-text-1 {
    color: #000;
    font: 16px/1 "Nunito", sans-serif;
  }

  .icon-size {
    font-size: 25px;
    color: #fff;
  }

  .secondary-text {
    font: 16px/1 "Nunito", sans-serif;
    color: #999ea0;
    font-weight: 800;
  }

  .green-color {
    color: #00d26d;
  }

  /*===============Main Form Content==============*/
  .invoice-bar{
    border-bottom:1px solid #151c20;
  }
  .slide-logo{
  width:30px;
  height: auto;
  }

  /*=============Slide Footer====================*/

  .slide-footer{
    background: #1e292f;
    border: 1px #223842 solid;
    color: #fff;
    font: 16px "Nunito", sans-serif;
    text-transform: capitalize;
    height: 80px !important;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    transition: all 0.5s ease-out;
    width: 100%;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }

  .slide-footer{
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
  }

  .cancel-btn,.standard-btn,.send-btn{
    font: 18px "Nunito", sans-serif;
    text-transform: capitalize;
    height:50px !important;
    width:170px !important;
  }

  .cancel-btn{
    background: #1e292f;
    border: 1px #223842 solid;
    border-radius: 10px;
    color: #00f579;
  }
  .standard-btn{
    color: #000;
    background: #00f579;
    font-weight:700;
    border-radius: 10px;
  }
  .send-btn{
    background: #1e292f;
    border: 2px #223842 solid;
    border-radius: 10px;
    color: #ffffff;
  }

</style>
