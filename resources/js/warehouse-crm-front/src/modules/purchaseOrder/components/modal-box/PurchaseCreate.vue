<template>
  <div
    v-if="isOpen"
    class="modal-backdrop"
    @click="handleBackdropClick"
    aria-labelledby="modalTitle"
  >
    <div
      class="modal-form"
      @click.stop
      role="dialog"
      aria-modal="true"
      aria-labelledby="modalTitle"
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
          <h2 id="modalTitle" class="modal-title pb-4">Create Purchase</h2>
          <form @submit.prevent="handleSubmit">
            <v-row>
              <v-col cols="6" class="pt-6">
                <label for="delivery_location" class="wr-form-label"
                  >Delivery Location:</label
                ><br />
                <input
                  type="text"
                  v-model="form.delivery_location"
                  id="delivery_location"
                  class="wr-form-input"
                  placeholder="Enter delivery location ..."
                  required
                  aria-label="Delivery Location"
                />
              </v-col>
              <v-col cols="6">
                <label for="product_id" class="wr-form-label"
                  >Select Product:</label
                ><br />
                <CustomSelectOption
                  label="Product"
                  :options="productOptions"
                  :selectedOption="currentProductOption"
                  @update:selectedOption="selectProductOption"
                  aria-label="Select Product"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="vendor_id" class="wr-form-label"
                  >Select Vendor:</label
                ><br />
                <CustomSelectOption
                  label="Vendor"
                  :options="vendorOptions"
                  :selectedOption="currentVendorOption"
                  @update:selectedOption="selectVendorOption"
                  aria-label="Select Vendor"
                />
              </v-col>
              <v-col cols="6">
                <label for="payment_status_id" class="wr-form-label"
                  >Payment Status:</label
                ><br />
                <CustomSelectOption
                  label="Payment"
                  :options="paymentOptions"
                  :selectedOption="currentPaymentOption"
                  @update:selectedOption="selectPaymentOption"
                  aria-label="Select Payment"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="customer_id" class="wr-form-label"
                  >Select Customer:</label
                ><br />
                <CustomSelectOption
                  label="Customer"
                  :options="customerOptions"
                  :selectedOption="currentCustomerOption"
                  @update:selectedOption="selectCustomerOption"
                  aria-label="Select Customer"
                />
              </v-col>
              <v-col cols="6" class="mt-2">
                <label for="status" class="wr-form-label">Status:</label><br />
                <SelectOptionFromArray
                  label="Order Status"
                  :options="statusOptions"
                  :selectedOption="selectedStatus"
                  @update:selectedOption="selectStatusOption"
                  aria-label="Order Status"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="total_amount" class="wr-form-label"
                  >Total Amount:</label
                ><br />
                <input
                  type="number"
                  v-model.number="form.total_amount"
                  id="total_amount"
                  class="wr-form-input"
                  min="1"
                  max="1000000000"
                  required
                  aria-label="Total Amount"
                />
              </v-col>
              <v-col cols="6">
                <label for="total_quantity" class="wr-form-label"
                  >Total Quantity:</label
                ><br />
                <input
                  type="number"
                  v-model.number="form.total_quantity"
                  id="total_quantity"
                  class="wr-form-input"
                  min="1"
                  max="1000000000"
                  required
                  aria-label="Total Quantity"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="date_time_of_placement" class="wr-form-label"
                  >Date Time of Placement:</label
                ><br />
                <input
                  type="datetime-local"
                  v-model="form.date_time_of_placement"
                  id="date_time_of_placement"
                  class="wr-form-input"
                  required
                  aria-label="Date and Time of Placement"
                />
              </v-col>
              <v-col cols="6">
                <label for="date_time_of_delivery" class="wr-form-label"
                  >Date Time of Delivery:</label
                ><br />
                <input
                  type="datetime-local"
                  v-model="form.date_time_of_delivery"
                  id="date_time_of_delivery"
                  class="wr-form-input"
                  required
                  aria-label="Date and Time of Delivery"
                />
              </v-col>
            </v-row>
            <button
              type="submit"
              :disabled="loading"
              class="wr-primary-btn ps-2 pe-2 pt-1 pb-1 mt-8"
              aria-label="Submit Purchase Form"
            >
              Create Purchase
            </button>
            <div v-if="error" aria-live="assertive">{{ error }}</div>
          </form>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script setup lang="ts">
import {
  ref,
  defineProps,
  defineEmits,
  onMounted,
  computed,
  onUnmounted,
} from "vue";
import { useCustomerStore } from "../../../customer/store/useCustomerStore";
import { useVendorStore } from "../../../vendors/store/useVendorsStore";
import { usePurchaseStore } from "../../store/usePurchaseStore";
import { useProductStore } from "../../../products/store/useProductStore";
import { usePurchaseFiltersStore } from "../../store/usePurchaseFilterStore";
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

const purchaseStore = usePurchaseStore();
const vendorStore = useVendorStore();
const customerStore = useCustomerStore();
const productStore = useProductStore();
const purchaseFiltersStore = usePurchaseFiltersStore();

onMounted(async () => {
  await vendorStore.fetchVendors();
  await productStore.fetchProducts();
  await customerStore.fetchCustomers();
  await purchaseFiltersStore.fetchPurchaseFilters();
});

const form = ref({
  total_amount: 1,
  total_quantity: 1,
  date_time_of_placement: "",
  date_time_of_delivery: "",
  delivery_location: "",
  product_id: null,
  vendor_id: null,
  status: "",
  payment_status_id: null,
  customer_id: null,
});

const loading = ref(false);
const error = ref("");

const paymentOptions = computed(() =>
  purchaseFiltersStore.paymentStatus.map((status) => ({
    id: status.id,
    name: status.name,
  }))
);
const productOptions = computed(() =>
  productStore.products.map((product) => ({
    id: product.id,
    name: product.title,
  }))
);
const customerOptions = computed(() =>
  customerStore.customers.map((customer) => ({
    id: customer.id,
    name: customer.first_name + " " + customer.last_name,
  }))
);
const vendorOptions = computed(() =>
  vendorStore.vendors.map((vendor) => ({
    id: vendor.id,
    name: vendor.company_name,
  }))
);

const statusOptions = computed(() =>
  purchaseFiltersStore.purchaseStatus.map((status) => status.name)
);

const selectedStatus = ref("");
const selectedProduct = ref(null);
const selectedCustomer = ref(null);
const selectedPayment = ref(null);
const selectedVendor = ref(null);

const showStatusOptions = ref(false);
const showProductOptions = ref(false);
const showCustomerOptions = ref(false);
const showPaymentOptions = ref(false);
const showVendorOptions = ref(false);

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
    productOptions.value.find(
      (product) => product.id === selectedProduct.value
    ) || {}
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
    customerOptions.value.find(
      (customer) => customer.id === selectedCustomer.value
    ) || {}
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

const currentVendorOption = computed(() => {
  return (
    vendorOptions.value.find((vendor) => vendor.id === selectedVendor.value) ||
    {}
  );
});
const selectVendorOption = (option) => {
  selectedVendor.value = option.id;
  showVendorOptions.value = false;
};
const selectVendorOptionOutClick = ref(null);
const handleVendorClickOutside = (event) => {
  if (
    selectVendorOptionOutClick.value &&
    !selectVendorOptionOutClick.value.contains(event.target)
  ) {
    showVendorOptions.value = false;
  }
};

const currentPaymentOption = computed(() => {
  return (
    paymentOptions.value.find(
      (payment) => payment.id === selectedPayment.value
    ) || {}
  );
});
const selectPaymentOption = (option) => {
  selectedPayment.value = option.id;
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
  document.addEventListener("mousedown", handleProductClickOutside);
  document.addEventListener("mousedown", handleCustomerClickOutside);
  document.addEventListener("mousedown", handleVendorClickOutside);
  document.addEventListener("mousedown", handlePaymentClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("mousedown", handleStatusClickOutside);
  document.removeEventListener("mousedown", handleProductClickOutside);
  document.removeEventListener("mousedown", handleCustomerClickOutside);
  document.removeEventListener("mousedown", handleVendorClickOutside);
  document.removeEventListener("mousedown", handlePaymentClickOutside);
});

const handleSubmit = async () => {
  loading.value = true;
  const payload = {
    status: selectedStatus.value,
    total_amount: form.value.total_amount,
    total_quantity: form.value.total_quantity,
    date_time_of_placement: form.value.date_time_of_placement,
    date_time_of_delivery: form.value.date_time_of_delivery,
    delivery_location: form.value.delivery_location,
    product_id: selectedProduct.value,
    customer_id: selectedCustomer.value,
    vendor_id: selectedVendor.value,
    payment_status_id: selectedPayment.value,
  };
  try {
    await purchaseStore.createPurchase(payload);
    form.value = {
      total_amount: 1,
      total_quantity: 1,
      date_time_of_placement: "",
      date_time_of_delivery: "",
      delivery_location: "",
      product_id: null,
      vendor_id: null,
      status: "",
      payment_status_id: null,
      customer_id: null,
    };

    selectedStatus.value = "";
    selectedProduct.value = null;
    selectedCustomer.value = null;
    selectedPayment.value = null;
    selectedVendor.value = null;

    emitClose();
  } catch (err) {
    console.error("Failed to create purchase:", err);
    error.value = "Failed to create purchase.";
  } finally {
    loading.value = false;
  }
};
</script>
