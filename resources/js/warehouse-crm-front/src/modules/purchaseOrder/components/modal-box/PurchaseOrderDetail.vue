<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick">
    <div class="modal-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="12" class="pt-2 pb-4">
          <v-btn class="close-btn" @click="emitClose">
            <i class="las la-times fs-2"></i>
          </v-btn>
        </v-col>
        <v-col cols="12" class="pt-2 pb-2 ps-1">
          <h3 class="title-text text-capitalize">Order Number:SO-654</h3>
        </v-col>
        <v-col cols="12" class="pt-4 pb-4 ps-1">
          <v-row no-gutters>
            <v-col cols="8">
              <h4 class="card-title text-capitalize">Order Details</h4>
              <v-col cols="12">
                <v-row no-gutters>
                  <v-col cols="6" class="ps-2 pe-2">
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase card-title-secondary">Source</p>
                      <p class="text-capitalize card-text-desc">Amazon</p>
                    </div>
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase card-title-secondary">
                        Order Date
                      </p>
                      <p class="text-capitalize card-text-desc">30 Sep, 2025</p>
                    </div>
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase card-title-secondary">
                        Due Date
                      </p>
                      <p class="text-capitalize card-text-desc">30 Sep, 2025</p>
                    </div>
                  </v-col>
                  <v-col cols="6" class="ps-2 pe-2">
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase card-title-secondary">
                        Assign to
                      </p>
                      <p class="text-capitalize card-text-desc">John Doe</p>
                    </div>
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase card-title-secondary">
                        Payment term
                      </p>
                      <p class="card-text-desc">Due on receipt</p>
                    </div>
                  </v-col>
                </v-row>
              </v-col>

              <h4 class="card-title text-capitalize">Product Ordered</h4>
              <v-col cols="12">
                <v-row no-gutters>
                  <v-col cols="4">
                    <p class="card-title text-uppercase">Product</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="card-title text-uppercase">Qty</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="card-title text-uppercase">Rate</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="card-title text-uppercase">Tax</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="card-title text-uppercase">Subtotal</p>
                  </v-col>
                </v-row>
                <v-row no-gutters class="pb-2">
                  <v-col cols="4">
                    <div class="d-flex flex-row justify-space-between">
                      <img :src="nike" alt="" class="card-img" />
                      <div class="d-flex flex-column">
                        <span class="text-capitalize card-text-desc"
                          >Nike 23KJ</span
                        >
                        <span class="text-uppercase card-text-desc"
                          >SKU:ADDS-GRS-22</span
                        >
                      </div>
                    </div>
                  </v-col>
                  <v-col cols="2" class="pt-6"
                    ><span class="card-text-desc">2(pcs)</span></v-col
                  >
                  <v-col cols="2" class="pt-6"
                    ><span class="card-text-desc">24.00</span></v-col
                  >
                  <v-col cols="2" class="pt-6"
                    ><span class="card-text-desc">10%</span></v-col
                  >
                  <v-col cols="2" class="pt-6"
                    ><span class="card-text-desc">58.00</span></v-col
                  >
                </v-row>
                <v-row no-gutters>
                  <v-col cols="6" offset="6">
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase ps-3 card-title-secondary">
                        SUB Total
                      </p>
                      <p class="card-text-desc">58.00</p>
                    </div>
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase ps-3 card-title-secondary">
                        Total Quantity
                      </p>
                      <p class="card-text-desc">2</p>
                    </div>
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-uppercase ps-3 card-title-secondary">
                        Discont
                      </p>
                      <p class="card-text-desc">-</p>
                    </div>
                    <div class="d-flex flex-row justify-space-between">
                      <p class="text-capitalize ps-3 card-title-secondary">
                        Total
                      </p>
                      <p class="card-text-desc">58.00</p>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
            </v-col>
            <v-col cols="4">
              <v-card class="sales-order-card">
                <h4 class="card-title">Invoices</h4>
                <v-card class="mt-1 mb-2 invoice-card">
                  <div class="d-flex flex-row justify-space-between">
                    <h4 class="invoice-title pb-2">#INNV-001</h4>
                    <span class="invoice-link" @click="openModalInvoice"
                      >View Invoice</span
                    >
                  </div>
                  <div class="d-flex flex-row justify-space-between">
                    <p class="text-uppercase pb-2">Received</p>
                    <p class="sales-order-price">$0.00</p>
                  </div>
                  <div class="d-flex flex-row justify-space-between">
                    <p class="text-uppercase pb-2">Total Payment</p>
                    <p class="sales-order-price">$21.00</p>
                  </div>
                  <div class="d-flex flex-row justify-center pt-2 pb-2">
                    <v-btn class="payment-btn" @click="openModalRecordPayment"
                      >Record payment</v-btn
                    >
                  </div>
                </v-card>
                <h4 class="card-title">Contact Person</h4>
                <v-card class="mt-1 mb-2 customer-card">
                  <div class="d-flex flex-row pb-2">
                    <img
                      :src="client_photo"
                      alt=""
                      class="img-client-photo-invoice"
                    />
                    <h3 class="text-capitalize ps-2 pt-3">
                      Cameron Williamson
                    </h3>
                  </div>
                  <div class="d-flex flex-row justify-space-between pb-2">
                    <p class="text-uppercase">Phone</p>
                    <p>+971-2321-2312</p>
                  </div>
                  <div class="d-flex flex-row justify-space-between pb-2">
                    <p class="text-uppercase">Email</p>
                    <p>cameron@casca.net</p>
                  </div>
                  <div class="d-flex flex-row justify-space-between pb-2">
                    <p class="text-uppercase">Website</p>
                    <p>-</p>
                  </div>
                  <span class="invoice-link">View Profile</span>
                </v-card>
                <h4 class="card-title">Address</h4>
                <v-card class="mt-1 mb-2 billing-address">
                  <h5 class="text-capitalize">Billing Address</h5>
                  <p>702 SW 8th St, Bentonville, AR 72716, USA</p>
                </v-card>
                <v-card class="mt-1 mb-2 shipping-address">
                  <h5 class="text-capitalize">Shipping Address</h5>
                  <p>702 SW 8th St, Bentonville, AR 72716, USA</p>
                </v-card>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12">
          <Invoice
            :is-open-invoice="isModalOpenInvoice"
            @close="closeModalInvoice"
          />
        </v-col>
        <v-col cols="12">
          <RecordPayment
            :is-open-record-payment="isModalOpenRecordPayment"
            @close="closeModalRecordPayment"
          />
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits } from "vue";
import client_photo from "@/assets/client_photo.png";
import nike from "@/assets/nike.jpg";
import Invoice from "@/modules/salesOrder/components/modal-box/Invoice.vue";
import RecordPayment from "@/modules/salesOrder/components/modal-box/RecordPayment.vue";

const props = defineProps({
  isOpen: Boolean,
  purchaseId: Number,
});

const emit = defineEmits(["close"]);

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = (event) => {
  emitClose();
};

/*===Record Payment===*/
const isModalOpenRecordPayment = ref(false);

const openModalRecordPayment = () => {
  isModalOpenRecordPayment.value = true;
};

const closeModalRecordPayment = () => {
  isModalOpenRecordPayment.value = false;
};

/*===Invoice===*/
const isModalOpenInvoice = ref(false);

const openModalInvoice = () => {
  isModalOpenInvoice.value = true;
};

const closeModalInvoice = () => {
  isModalOpenInvoice.value = false;
};
</script>

<style scoped>
/*================Order progress=================*/
.reorder-progress-bar {
  margin-top: 25px;
  height: 4px;
  border-radius: 10px;
  width: 17%;
  background: #cbcccb;
}
/*============Invoice Card======================*/
.sales-order-card {
  background: #1a2228;
  border-radius: 10px;
  padding: 10px;
}
.invoice-card,
.customer-card,
.billing-address,
.shipping-address {
  background: #1e2830;
  border-radius: 10px;
  color: #fff;
  font: 14px "Nunito", sans-serif;
  padding: 10px 15px;
}
.payment-btn {
  border-radius: 10px;
  font-weight: 700 !important;
  color: #000;
  font: 14px "Nunito", sans-serif;
  background: #00d26d;
}
.img-client-photo-invoice {
  width: 15%;
  border-radius: 10px;
}
.invoice-link {
  font: 14px "Nunito", sans-serif;
  color: #00d26d;
  cursor: pointer;
}
</style>
