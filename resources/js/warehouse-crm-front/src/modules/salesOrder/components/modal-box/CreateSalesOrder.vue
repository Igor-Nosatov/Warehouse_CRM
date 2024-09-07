<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick" aria-hidden="true">
    <div
      class="modal-form"
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
      <v-row no-gutters class="pb-4 ps-6 pe-6">
        <v-col cols="12" class="pt-2 pb-4">
          <h2 id="modalTitle" class="visually-hidden pb-4">Add New Order</h2>
          <form @submit.prevent="handleSubmit">
            <v-row>
              <v-col cols="6">
                <label for="status" class="wr-form-label" aria-label="Order status">Order Status:</label><br>
                <SelectOptionFromArray
                label="Order Status"
                :options="statusOptions"
                :selectedOption="selectedStatus"
                @update:selectedOption="selectStatusOption"
                aria-label="Order Status"
              />
              </v-col>
              <v-col cols="6">
                <label for="total_amount" class="wr-form-label" aria-label="Total amount">Total Amount:</label><br>
                <input
                  type="number"
                  v-model="form.total_amount"
                  id="total_amount"
                  class="wr-form-input"
                  required
                  aria-required="true"
                  aria-label="Enter total amount"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="total_quantity" class="wr-form-label" aria-label="Total quantity">Total Quantity:</label><br>
                <input
                  type="number"
                  v-model="form.total_quantity"
                  id="total_quantity"
                  class="wr-form-input"
                  required
                  aria-required="true"
                  aria-label="Enter total quantity"
                />
              </v-col>
              <v-col cols="6">
                <label for="date_time_of_placement" class="wr-form-label" aria-label="Date and time of placement">Date Time of Placement:</label><br>
                <input
                  type="datetime-local"
                  v-model="form.date_time_of_placement"
                  id="date_time_of_placement"
                  class="wr-form-input"
                  required
                  aria-required="true"
                  aria-label="Select date and time of placement"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="date_time_of_delivery" class="wr-form-label" aria-label="Date and time of delivery">Date Time of Delivery:</label><br>
                <input
                  type="datetime-local"
                  v-model="form.date_time_of_delivery"
                  id="date_time_of_delivery"
                  class="wr-form-input"
                  required
                  aria-required="true"
                  aria-label="Select date and time of delivery"
                />
              </v-col>
              <v-col cols="6">
                <label for="delivery_location" class="wr-form-label" aria-label="Delivery location">Delivery Location:</label><br>
                <input
                  type="text"
                  v-model="form.delivery_location"
                  id="delivery_location"
                  class="wr-form-input"
                  placeholder="Enter delivery location ..."
                  required
                  aria-required="true"
                  aria-label="Enter delivery location"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="product_id" class="wr-form-label" aria-label="Select product">Select Product:</label><br>
                <CustomSelectOption
                label="Product"
                :options="productOptions"
                :selectedOption="currentProductOption"
                @update:selectedOption="selectProductOption"
                aria-label="Select Product"
              />
              </v-col>
              <v-col cols="6">
                <label for="customer_id" class="wr-form-label" aria-label="Select customer">Select Customer:</label><br>
                <CustomSelectOption
                label="Customer"
                :options="customerOptions"
                :selectedOption="currentCustomerOption"
                @update:selectedOption="selectCustomerOption"
                aria-label="Select Customer"
              />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <label for="payment_status_id" class="wr-form-label" aria-label="Select payment status">Payment Status:</label><br>
                <CustomSelectOption
                label="Payment"
                :options="paymentOptions"
                :selectedOption="currentPaymentOption"
                @update:selectedOption="selectPaymentOption"
                aria-label="Select Payment"
              />
              </v-col>
            </v-row>
            <button
              type="submit"
              :disabled="loading"
              class="wr-primary-btn ps-2 pe-2 pt-1 pb-1 mt-4"
              aria-label="Create sales order"
            >
              Create Sales Order
            </button>
            <div v-if="error" aria-live="assertive">{{ error }}</div>
          </form>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits, onMounted, computed,onUnmounted } from "vue";
import { useSalesOrderStore } from "../../store/useSalesOrderStore";
import { useSalesOrderFilterStore } from "../../store/useSalesOrderFilterStore";
import { useProductStore } from "../../../products/store/useProductStore";
import { useCustomerStore } from "../../../customer/store/useCustomerStore";
import SelectOptionFromArray from "../../../../components/common/SelectOptionFromArray.vue";
import CustomSelectOption from "../../../../components/common/CustomSelectOption.vue";

const props = defineProps({
  isOpen: Boolean,
});

const emit = defineEmits(["close"]);

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = () => {
  emitClose();
};

const salesOrderStore = useSalesOrderStore();
const salesOrderFilterStore = useSalesOrderFilterStore();
const productStore = useProductStore();
const customerStore = useCustomerStore();

onMounted(async () => {
  await salesOrderFilterStore.fetchSalesOrderFilters();
  await productStore.fetchProducts();
  await customerStore.fetchCustomers();
});

const form = ref({
  status: "",
  total_amount: 1,
  total_quantity: 1,
  date_time_of_placement: "",
  date_time_of_delivery: "",
  delivery_location: "",
  product_id: null,
  customer_id: null,
  payment_status_id:null,
});

const statusOptions = ["Packed", "Processing", "Shipped", "Delivered"];
const productOptions = computed(() =>
  productStore.products.map((product) => ({
    id: product.id,
    name: product.title,
  }))
);
const customerOptions = computed(() =>
  customerStore.customers.map((customer) => ({
    id: customer.id,
    name: customer.first_name+' '+customer.last_name,
  }))
);
const paymentOptions = computed(() => salesOrderFilterStore.paymentStatus);

const loading = ref(false);
const selectedStatus = ref("");
const selectedProduct = ref("");
const selectedCustomer = ref("");
const selectedPayment = ref("");

const showStatusOptions = ref(false);
const showProductOptions = ref(false);
const showCustomerOptions = ref(false);
const showPaymentOptions = ref(false);

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

const currentProductOption = computed(() => {
  return (
    productOptions.value.find((product) => product.id === selectedProduct.value) ||
    {}
  );
});

const selectProductOption = (option) => {
  console.log("Selected status option:", option);
  selectedProduct.value = option.id;
  showProductOptions.value = false;
};
const selectProductOptionOutClick = ref(null);
const handleProductClickOutside = (event) => {
  if (
    selectProductOptionOutClick.value &&
    !selectProductOptionOutClick.value.contains(event.target)
  ) {
    showStatusOptions.value = false;
  }
};

const currentCustomerOption = computed(() => {
  return (
    customerOptions.value.find((customer) => customer.id === selectedCustomer.value) ||
    {}
  );
});
const selectCustomerOption = (option) => {
  selectedCustomer.value = option.id;
  showCustomerOptions.value = false;
};
const selectCustomerOptionOutClick = ref(null);
const handleCustomerClickOutside = (event) => {
  if (
    selectCustomerOptionOutClick.value &&
    !selectCustomerOptionOutClick.value.contains(event.target)
  ) {
    showCustomerOptions.value = false;
  }
};

const currentPaymentOption = computed(() => {
  return (
    paymentOptions.value.find((payment) => payment.id === selectedPayment.value) ||
    {}
  );
});
const selectPaymentOptionOutClick = ref(null);
const selectPaymentOption = (option) => {
  selectedPayment.value = option.id;
  showPaymentOptions.value = false;
};
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
  document.addEventListener("mousedown", handleProductClickOutside);
  document.addEventListener("mousedown", handleCustomerClickOutside);
  document.addEventListener("mousedown", handlePaymentClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("mousedown", handleStatusClickOutside);
  document.removeEventListener("mousedown", handleProductClickOutside);
  document.removeEventListener("mousedown", handleCustomerClickOutside);
  document.removeEventListener("mousedown", handlePaymentClickOutside);
});

const handleSubmit = async () => {
  const payload = {
    status: selectedStatus.value,
    total_amount: form.value.total_amount,
    total_quantity: form.value.total_quantity,
    date_time_of_placement: form.value.date_time_of_placement,
    date_time_of_delivery: form.value.date_time_of_delivery,
    delivery_location: form.value.delivery_location,
    product_id: selectedProduct.value,
    customer_id: selectedCustomer.value,
    payment_status_id: selectedPayment.value,
  };
  try {
    await salesOrderStore.createSalesOrder(payload);
    form.value = {
      status: "",
      total_amount: 1,
      total_quantity: 1,
      date_time_of_placement: "",
      date_time_of_delivery: "",
      delivery_location: "",
      product_id: null,
      customer_id: null,
      payment_status_id: null,
    };

    selectedStatus.value = "";
    selectedProduct.value = "";
    selectedCustomer.value = "";
    selectedPayment.value = "";

    emitClose();
  } catch (error) {
    console.error("Failed to create sales order", error);
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
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.modal {
  border-radius: 8px;
  padding: 16px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  position: relative;
  left: 21%;
}
.custom-select {
  position: relative;
  cursor: pointer;
}

.custom-select-header {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background: #fff;
}

.custom-select-list {
  position: absolute;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  background: #fff;
  max-height: 200px;
  overflow-y: auto;
  z-index: 1000;
}

.custom-select-item {
  padding: 10px;
}

.custom-select-item.selected {
  background: #f0f0f0;
}

.custom-select-item:hover {
  background: #e0e0e0;
}
</style>
