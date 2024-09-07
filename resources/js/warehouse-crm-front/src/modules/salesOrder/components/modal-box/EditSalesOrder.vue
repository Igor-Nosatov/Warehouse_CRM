<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick">
    <div class="modal-form edit-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="7" class="pt-2 pb-4">
          <div class="d-flex flex-row justify-space-start">
            <v-btn
              class="close-btn"
              @click="emitClose"
              aria-label="Close modal"
            >
              <i class="las la-times fs-2"></i>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <form @submit.prevent="handleSubmit">
            <v-row no-gutters class="pb-4 ps-3">
              <v-col cols="6" class="ps-4 pe-2 pb-3">
                <div class="form-group">
                  <label for="status" class="wr-form-label">Status</label>
                  <SelectOptionFromArray
                    label="Order Status"
                    :options="statusOptions"
                    :selectedOption="selectedStatus"
                    @update:selectedOption="selectStatusOption"
                    aria-label="Order Status"
                  />
                </div>
              </v-col>
              <v-col cols="6" class="ps-4 pe-2 pb-3">
                <div class="form-group">
                  <label for="total_amount" class="wr-form-label"
                    >Total Amount</label
                  >
                  <input
                    type="number"
                    id="total_amount"
                    v-model="form.total_amount"
                    class="wr-form-input"
                    min="1"
                    max="1000000"
                    aria-label="Enter total amount"
                    required
                  />
                </div>
              </v-col>
              <v-col cols="6" class="ps-4 pe-2 pb-3">
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
                    min="1"
                    max="1000000"
                    required
                  />
                </div>
              </v-col>
              <v-col cols="6" class="ps-4 pe-2 pb-3">
                <div class="form-group">
                  <label for="date_time_of_placement" class="wr-form-label"
                    >Date Time of Placement</label
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
              <v-col cols="6" class="ps-4 pe-2 pb-3">
                <div class="form-group">
                  <label for="date_time_of_delivery" class="wr-form-label"
                    >Date Time of Delivery</label
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
              <v-col cols="6" class="ps-4 pe-2 pb-3">
                <div class="form-group">
                  <label for="delivery_location" class="wr-form-label"
                    >Delivery Location</label
                  >
                  <input
                    type="text"
                    id="delivery_location"
                    v-model="form.delivery_location"
                    class="wr-form-input"
                    placeholder="Enter delivery location ..."
                    aria-label="Enter delivery location"
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
              class="wr-primary-btn ps-4 pe-2 pb-3 pt-1 pb-1 ms-7"
              aria-label="Update Sales Order"
            >
              Update Sales Order
            </button>
          </form>
        </v-col>
      </v-row>
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
  ref,
  onUnmounted,
  computed,
} from "vue";
import { useSalesOrderByIdStore } from "@/modules/salesOrder/store/useSalesOrderByIdStore";
import { useSalesOrderStore } from "@/modules/salesOrder/store/useSalesOrderStore";
import SelectOptionFromArray from "../../../../components/common/SelectOptionFromArray.vue";
import CustomSelectOption from "../../../../components/common/CustomSelectOption.vue";
import { useSalesOrderFilterStore } from "../../store/useSalesOrderFilterStore";

const props = defineProps<{
  isOpen: boolean;
  salesId: Number;
}>();

const emit = defineEmits<{
  (e: "close"): void;
}>();

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = () => {
  emitClose();
};

console.log("Received salesId:", props.salesId);

const salesOrderByIdStore = useSalesOrderByIdStore();
const salesOrderStore = useSalesOrderStore();
const salesOrderFilterStore = useSalesOrderFilterStore();

const form = reactive({
  status: "",
  total_amount: 1,
  total_quantity: 1,
  date_time_of_placement: "",
  date_time_of_delivery: "",
  delivery_location: "",
  customer_id: null,
  payment_status_id: null,
  product_id: null,
});

const selectedStatus = ref("");
const selectedPayment = ref<number | null>(null);

const showStatusOptions = ref(false);
const showPaymentOptions = ref(false);

const statusOptions = computed(() =>
  salesOrderFilterStore.orderStatus.map((status) => status.name)
);
const paymentOptions = computed(() =>
  salesOrderFilterStore.paymentStatus.map((status) => ({
    id: status.id,
    name: status.name,
  }))
);

const selectStatusOption = (option) => {
  console.log("Selected status option:", option);
  selectedStatus.value = option;
  showStatusOptions.value = false;
};
const selectStatusOptionOutClick = ref(null);
const handleStatusClickOutside = (event) => {
  if (
    selectStatusOptionOutClick.value &&
    !selectStatusOptionOutClick.value.contains(event.target)
  ) {
    showStatusOptions.value = false;
  }
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
const selectPaymentOptionOutClick = ref(null);
const handlePaymentClickOutside = (event) => {
  if (
    selectPaymentOptionOutClick.value &&
    !selectPaymentOptionOutClick.value.contains(event.target)
  ) {
    showPaymentOptions.value = false;
  }
};

onMounted(() => {
  document.addEventListener("mousedown", handleStatusClickOutside);
  document.addEventListener("mousedown", handlePaymentClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("mousedown", handleStatusClickOutside);
  document.addEventListener("mousedown", handlePaymentClickOutside);
});

watch(
  () => props.salesId,
  async (newSalesId) => {
    if (newSalesId) {
      console.log("Fetching sales order details for ID:", newSalesId);
      await loadSalesOrderData(newSalesId);
    }
  },
  { immediate: true }
);

const loadSalesOrderData = async (salesId) => {
  if (salesId) {
    try {
      await salesOrderByIdStore.fetchSalesOrderById(salesId);
      if (salesOrderByIdStore.salesOrder) {
        const {
          date_time_of_placement,
          date_time_of_delivery,
          ...otherFields
        } = salesOrderByIdStore.salesOrder;

        form.date_time_of_placement = date_time_of_placement
          ? new Date(date_time_of_placement).toISOString().slice(0, 16)
          : "";
        form.date_time_of_delivery = date_time_of_delivery
          ? new Date(date_time_of_delivery).toISOString().slice(0, 16)
          : "";
        Object.assign(form, otherFields);

        selectedStatus.value = salesOrderByIdStore.salesOrder.status || "";
        selectedPayment.value =
          salesOrderByIdStore.salesOrder.payment_status_id || null;
      }
    } catch (error) {
      console.error("Error fetching sales order data:", error);
    }
  }
};

const handleSubmit = async () => {
  if (props.salesId !== undefined) {
    try {
      const payload = {
        status: selectedStatus.value,
        total_amount: form.total_amount,
        total_quantity: form.total_quantity,
        date_time_of_placement: form.date_time_of_placement,
        date_time_of_delivery: form.date_time_of_delivery,
        delivery_location: form.delivery_location,
        customer_id: form.customer_id,
        payment_status_id: selectedPayment.value,
        product_id: form.product_id,
      };
      await salesOrderStore.updateSalesOrder(props.salesId, payload);
      emitClose();
    } catch (error) {
      console.error("Failed to update sales order", error);
    }
  } else {
    console.error("Sales ID is undefined");
  }
};
</script>

<style scoped>
.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal {
  padding: 20px;
  border-radius: 8px;
  max-width: 600px;
  width: 100%;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  position: relative;
}
</style>
