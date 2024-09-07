<template>
  <div
    v-if="isOpenRecordPayment"
    class="modal-backdrop record-payment-form modal-form"
    @click="handleBackdropClickRecordPayment"
    aria-label="Record payment modal backdrop"
  >
    <div class="record-payment-form" @click.stop aria-label="Record payment modal">
      <v-row no-gutters class="pb-4 ps-2">
        <v-col cols="12" class="pt-2">
          <v-btn class="close-btn" @click="emitCloseRecordPayment" aria-label="Close record payment modal">
            <i class="las la-times fs-2"></i>
          </v-btn>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col cols="12">
          <h2 class="ps-2 slide-title">Record Payment</h2>
        </v-col>
        <v-col cols="12" class="ps-2 pe-2 pt-4">
          <v-card class="card-payment-info" aria-label="Payment information">
            <p class="text-uppercase secondary-text pt-2 pb-2">Payment for</p>
            <div class="d-flex flex-row justify-space-between pt-2 pb-2">
              <h3 class="primary-text">#INV-001</h3>
              <p class="primary-text">
                <span class="text-uppercase secondary-text pe-2"
                  >Total payment:</span
                >21.00
              </p>
            </div>
          </v-card>
        </v-col>
        <v-col cols="12" class="pt-3 ps-2 pe-2">
          <p class="label-form pb-2 text-capitalize">Amount received</p>
          <input type="text" placeholder="Enter amount..." class="qty-input" aria-label="Enter amount received" />
        </v-col>
        <v-col cols="12" class="pt-3 ps-2 pe-2">
          <p class="label-form pb-2 text-capitalize">Bank Charges (if any)</p>
          <input type="text" placeholder="Enter charge..." class="qty-input" aria-label="Enter bank charges" />
        </v-col>
        <v-col cols="12">
          <v-row no-gutters>
            <v-col cols="6" class="pt-3 ps-2 pe-2">
              <p class="label-form pb-2">Payment method</p>
              <div @click="toggleDropdownPaymentMethod" class="select-label" aria-label="Select payment method">
                <p v-if="selectedItemPaymentMethod" class="select-text">
                  <span class="text-capitalize">
                    {{ selectedItemPaymentMethod }}</span
                  >
                </p>
                <p v-else class="select-text">Select Payment Method</p>
              </div>
              <transition name="fade">
                <div
                  v-if="isDropdownOpenPaymentMethod"
                  class="dropdown-menu-reason"
                  aria-label="Payment method options"
                >
                  <div
                    v-for="(item, index) in itemsPaymentMethod"
                    :key="index"
                    class="dropdown-item"
                    @click="selectItemPaymentMethod(item)"
                    aria-label="Payment method option"
                  >
                    <span class="text-capitalize select-text"> {{ item }}</span>
                  </div>
                </div>
              </transition>
            </v-col>
            <v-col cols="6" class="pt-3 ps-2 pe-2">
              <p class="label-form pb-2">Deposit to</p>
              <div @click="toggleDropdownDepositTo" class="select-label" aria-label="Select deposit account">
                <p v-if="selectedItemDepositTo" class="select-text">
                  <span class="text-capitalize">
                    {{ selectedItemDepositTo }}</span
                  >
                </p>
                <p v-else class="select-text">Select Deposit Account</p>
              </div>
              <transition name="fade">
                <div
                  v-if="isDropdownOpenDepositTo"
                  class="dropdown-menu-reason"
                  aria-label="Deposit account options"
                >
                  <div
                    v-for="(item, index) in itemsDepositTo"
                    :key="index"
                    class="dropdown-item"
                    @click="selectItemDepositTo(item)"
                    aria-label="Deposit account option"
                  >
                    <span class="text-capitalize select-text"> {{ item }}</span>
                  </div>
                </div>
              </transition>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12" class="pt-3 ps-2 pe-2">
          <p class="label-form pb-2 text-capitalize">Attach files</p>
          <input type="file" name="file-input" id="file-input" aria-label="Attach files" />
        </v-col>
        <v-col cols="12" class="pt-3 ps-2 pe-2">
          <p class="label-form pb-2 text-capitalize">Notes</p>
          <textarea
            name=""
            id=""
            cols="5"
            rows="4"
            class="notes-textarea"
            aria-label="Enter notes"
          ></textarea>
        </v-col>
        <v-col cols="12" class="pt-3 ps-2 pe-2">
          <div class="slide-footer d-flex flex-row justify-space-between">
            <v-btn class="cancel-btn mt-4 ms-6" aria-label="Cancel">Cancel</v-btn>
            <v-btn class="standard-btn mt-4 me-6" aria-label="Save">Save</v-btn>
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits } from "vue";

const props = defineProps({
  isOpenRecordPayment: Boolean,
});

const emit = defineEmits(["close"]);

const emitCloseRecordPayment = () => {
  emit("close");
};

const handleBackdropClickRecordPayment = (event) => {
  emitCloseRecordPayment();
};

/*Select Payment Method*/
const isDropdownOpenPaymentMethod = ref(false);
const itemsPaymentMethod = ref([
  "Stolen Goods",
  "Missing Goods",
  "Accident",
  "Other",
]);
const selectedItemPaymentMethod = ref("");

const toggleDropdownPaymentMethod = () => {
  isDropdownOpenPaymentMethod.value = !isDropdownOpenPaymentMethod.value;
};

const selectItemPaymentMethod = (item) => {
  selectedItemPaymentMethod.value = item;
  isDropdownOpenPaymentMethod.value = false;
};

/*Select Deposit To*/
const isDropdownOpenDepositTo = ref(false);
const itemsDepositTo = ref([
  "Stolen Goods",
  "Missing Goods",
  "Accident",
  "Other",
]);
const selectedItemDepositTo = ref("");

const toggleDropdownDepositTo = () => {
  isDropdownOpenDepositTo.value = !isDropdownOpenDepositTo.value;
};

const selectItemDepositTo = (item) => {
  selectedItemDepositTo.value = item;
  isDropdownOpenDepositTo.value = false;
};
</script>
<style scoped>
.record-payment-form {
  width: 1100px;
  height: 720px;
}
/*============Card block===========================*/
.card-payment-info {
  padding: 10px;
  border-radius: 10px;
  background: #1e2830;
}

/*============Record Payment Form===========================*/
.label-form {
  color: #fff;
  font: 14px "Nunito", sans-serif !important;
}

/*Select Pseudo Input*/

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.select-label {
  border: 1px solid #2f3943;
  background: #19222a;
  padding: 10px 0px 10px 30px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  user-select: none;
}

.dropdown-menu,
.dropdown-menu-reason {
  border: 1px solid #2f3943;
  background: #19222a;
  padding: 10px 0;
  border-radius: 10px;
  overflow: hidden;
}

.dropdown-menu {
  position: absolute;
  z-index: 999;
  width: 96.5%;
  bottom: 400px !important;
}

.dropdown-menu-reason {
  position: absolute;
  z-index: 999;
  width: 44.8%;
  bottom: 36%;
}

.dropdown-item {
  padding: 10px 30px;
  color: #fff;
  cursor: pointer;
}

.dropdown-item:hover {
  background-color: #2a3b44;
}

.select-text {
  position: relative;
  right: 15px;
}

.notes-textarea,
.qty-input {
  border: 1px solid #919da1;
  border-radius: 10px;
  font: 16px "Nunito", sans-serif !important;
  padding: 10px;
  width: 100%;
  color: #fff;
}

/*==============Input File=====================*/

label[for="file-input"] {
  display: block;
  margin-bottom: 1em;
  font-size: 1em;
  color: #fff;
  opacity: 0.9;
  font-weight: bold;
}

input[type="file"] {
  cursor: pointer !important;
}

input[type="file"]::-webkit-file-upload-button,
input[type="file"]::-ms-browse {
  background: #e62163;
  border: 0;
  padding: 1em 2em;
  cursor: pointer;
  color: #fff;
  border-radius: 0.2em;
}

/*=============Slide Footer====================*/

.slide-footer {
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

.slide-footer {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}

.cancel-btn,
.standard-btn {
  font: 18px "Nunito", sans-serif;
  text-transform: capitalize;
  height: 50px !important;
  width: 170px !important;
}

.cancel-btn {
  background: #1e292f;
  border: 1px #223842 solid;
  border-radius: 10px;
  color: #00f579;
}

.standard-btn {
  font: 18px "Nunito", sans-serif;
  text-transform: capitalize;
  color: #000;
  background: #00f579;
  font-weight: 700;
  border-radius: 10px;
}
</style>
