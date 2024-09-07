<template>
  <div
    v-if="isOpen"
    class="modal-backdrop"
    @click="handleBackdropClick"
    aria-hidden="true"
  >
    <div
      class="modal-form edit-form"
      @click.stop
      role="dialog"
      aria-labelledby="modalTitle"
      aria-modal="true"
    >
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="7" class="pt-2 pb-4">
          <div class="d-flex flex-row justify-space-start">
            <v-btn
              class="close-btn"
              @click="emitClose"
              aria-label="Close modal"
            >
              <i class="las la-times fs-2" aria-hidden="true"></i>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <h2 id="modalTitle" class="visually-hidden ps-7 pb-6">Update Purchase</h2>
      <form @submit.prevent="handleSubmit">
        <v-row no-gutters class="pb-4 ps-4">
          <v-col cols="6" class="ps-3 pe-2 pb-3">
            <div class="form-group">
              <label for="status" class="wr-form-label">Order Status</label>
              <SelectOptionFromArray
                label="Order Status"
                :options="statusOptions"
                :selectedOption="selectedStatus"
                @update:selectedOption="selectStatusOption"
                aria-label="Order Status"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-3 pe-2 pb-3">
            <div class="form-group">
              <label for="total_amount" class="wr-form-label"
                >Total Amount</label
              >
              <input
                type="number"
                id="total_amount"
                v-model="form.total_amount"
                class="wr-form-input"
                aria-label="Enter total amount"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-3 pe-2 pb-3">
            <div class="form-group">
              <label for="total_quantity" class="wr-form-label"
                >Total Quantity</label
              >
              <input
                type="number"
                id="total_quantity"
                v-model="form.total_quantity"
                class="wr-form-input"
                aria-label="Enter total quantity"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-3 pe-2 pb-3">
            <div class="form-group">
              <label for="date_time_of_placement" class="wr-form-label"
                >Date of Placement</label
              >
              <input
                type="datetime-local"
                id="date_time_of_placement"
                v-model="form.date_time_of_placement"
                class="wr-form-input"
                aria-label="Select date and time of placement"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-3 pe-2 pb-3">
            <div class="form-group">
              <label for="date_time_of_delivery" class="wr-form-label"
                >Date of Delivery</label
              >
              <input
                type="datetime-local"
                id="date_time_of_delivery"
                v-model="form.date_time_of_delivery"
                class="wr-form-input"
                aria-label="Select date and time of delivery"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-3 pe-2 pb-3">
            <div class="form-group">
              <label for="delivery_location" class="wr-form-label"
                >Delivery Location</label
              >
              <input
                type="text"
                id="delivery_location"
                v-model="form.delivery_location"
                class="wr-form-input"
                aria-label="Enter delivery location"
                placeholder="Enter delivery location ..."
                required
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2 pb-3">
            <div class="form-group">
              <label for="payment_status_id" class="wr-form-label"
                >Payment Status</label
              >
              <CustomSelectOption
                label="Payment"
                :options="paymentOptions"
                :selectedOption="currentPaymentOption"
                @update:selectedOption="selectPaymentOption"
                aria-label="Select Payment"
              />
            </div>
          </v-col>
        </v-row>
        <button
          type="submit"
          class="wr-primary-btn ps-2 pe-2 pt-1 pb-1 ms-6 mt-3"
          aria-label="Update purchase"
        >
          Update Purchase
        </button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import {
  defineProps,
  defineEmits,
  reactive,
  onMounted,
  watch,
  computed,
  onUnmounted,
  ref
} from "vue";
import { usePurchaseStore } from "../../store/usePurchaseStore";
import { usePurchaseFiltersStore } from "../../store/usePurchaseFilterStore";
import SelectOptionFromArray from "../../../../components/common/SelectOptionFromArray.vue";
import CustomSelectOption from "../../../../components/common/CustomSelectOption.vue";

const props = defineProps({
  isOpen: Boolean,
  purchaseId: Number,
});

const purchaseFiltersStore = usePurchaseFiltersStore();
const purchaseStore = usePurchaseStore();

const form = reactive({
  status: "",
  total_amount: 1,
  total_quantity: 1,
  date_time_of_placement: "",
  date_time_of_delivery: "",
  delivery_location: "",
  customer_id: null,
  payment_status_id: null,
});

const selectedStatus = ref("");
const selectedPayment = ref("");

const paymentOptions = computed(() =>
  purchaseFiltersStore.paymentStatus.map((status) => ({
    id: status.id,
    name: status.name,
  }))
);
const statusOptions = computed(() =>
  purchaseFiltersStore.purchaseStatus.map((status) => status.name)
);

const showStatusOptions = ref(false);
const showPaymentOptions = ref(false);

const emit = defineEmits(["close"]);

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = () => {
  emitClose();
};

const selectStatusOption = (option) => {
  console.log("Selected status option:", option);
  selectedStatus.value = option;
  form.status = option;
  showStatusOptions.value = false;
};

const currentPaymentOption = computed(() => {
  return (
    paymentOptions.value.find((payment) => payment.id === selectedPayment.value) ||
    {}
  );
});

const selectPaymentOption = (option) => {
  selectedPayment.value = option.id;
  form.payment_status_id = option.id;
  showPaymentOptions.value = false;
};

const loadPurchaseData = async () => {
  if (props.purchaseId) {
    try {
      await purchaseStore.fetchPurchaseById(props.purchaseId);
      if (purchaseStore.purchase) {
        const {
          date_time_of_placement,
          date_time_of_delivery,
          status,
          payment_status_id,
          ...otherFields
        } = purchaseStore.purchase;

        form.date_time_of_placement = date_time_of_placement
          ? new Date(date_time_of_placement).toISOString().slice(0, 16)
          : "";
        form.date_time_of_delivery = date_time_of_delivery
          ? new Date(date_time_of_delivery).toISOString().slice(0, 16)
          : "";

        Object.assign(form, otherFields);

        selectedStatus.value = status || "";
        selectedPayment.value = payment_status_id || "";
      }
    } catch (error) {
      console.error("Failed to fetch purchase data", error);
    }
  }
};

watch(
  () => props.purchaseId,
  async (newPurchaseId) => {
    if (newPurchaseId) {
      await loadPurchaseData();
    }
  },
  { immediate: true }
);

const selectPaymentOptionOutClick = ref(null);
const selectStatusOptionOutClick = ref(null);

const handleStatusClickOutside = (event) => {
  if (
    selectStatusOptionOutClick.value &&
    !selectStatusOptionOutClick.value.contains(event.target)
  ) {
    showStatusOptions.value = false;
  }
};
const handlePaymentClickOutside = (event) => {
  if (
    selectPaymentOptionOutClick.value &&
    !selectPaymentOptionOutClick.value.contains(event.target)
  ) {
    showPaymentOptions.value = false;
  }
};

onMounted(async () => {
  await purchaseFiltersStore.fetchPurchaseFilters();
  await loadPurchaseData();

  document.addEventListener("mousedown", handleStatusClickOutside);
  document.addEventListener("mousedown", handlePaymentClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("mousedown", handleStatusClickOutside);
  document.removeEventListener("mousedown", handlePaymentClickOutside);
});

const handleSubmit = async () => {
  if (props.purchaseId !== undefined) {
    try {
      const payload = {
        status: selectedStatus.value,
        total_amount: form.total_amount,
        total_quantity: form.total_quantity,
        date_time_of_placement: new Date(form.date_time_of_placement).toISOString(),
        date_time_of_delivery: new Date(form.date_time_of_delivery).toISOString(),
        delivery_location: form.delivery_location,
        product_id: form.product_id,
        customer_id: form.customer_id,
        vendor_id: form.vendor_id,
        payment_status_id: selectedPayment.value,
      };
      console.log(payload);
      await purchaseStore.updatePurchase(props.purchaseId, payload);
      emitClose();
    } catch (error) {
      console.error('Failed to update purchase', error);
    }
  } else {
    console.error('Purchase ID is undefined');
  }
};
</script>
