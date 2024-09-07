<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick">
    <div class="modal-form create-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="7" class="pt-2 pb-4">
          <div class="d-flex flex-row justify-space-start">
            <v-btn class="close-btn" @click="emitClose">
              <i class="las la-times fs-2"></i>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="12" class="pt-2 pb-4">
          <form @submit.prevent="handleSubmit">
            <v-row no-gutters>
              <v-col cols="4">
                <label for="first_name" class="wr-form-label pb-3"
                  >First Name:</label
                ><br />
                <input
                  type="text"
                  v-model="form.first_name"
                  id="first_name"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter first name ..."
                  required
                />
              </v-col>
              <v-col cols="4">
                <label for="last_name" class="wr-form-label pb-3"
                  >Last Name:</label
                ><br />
                <input
                  type="text"
                  v-model="form.last_name"
                  id="last_name"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter last name ..."
                  required
                />
              </v-col>
              <v-col cols="4">
                <label for="email" class="wr-form-label pb-3">Email:</label
                ><br />
                <input
                  type="email"
                  v-model="form.email"
                  id="email"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter email ..."
                  required
                />
              </v-col>
              <v-col cols="4" class="pt-4">
                <label for="phone" class="wr-form-label pb-3">Phone:</label
                ><br />
                <input
                  type="tel"
                  v-model="form.phone"
                  id="phone"
                  class="wr-form-input wr-form-input-small"
                  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                  placeholder="Enter phone ..."
                  required
                />
              </v-col>
              <v-col cols="4" class="pt-4">
                <label for="customer_type" class="wr-form-label pb-3"
                  >Customer Type:</label
                ><br />
                <SelectOptionFromArray
                  label="Customer Type"
                  :options="customerTypeOptions"
                  :selectedOption="selectedCustomerType"
                  @update:selectedOption="selectCustomerTypeOption"
                  aria-label="Customer Type"
                />
              </v-col>
              <v-col cols="4" class="pt-4">
                <label for="customer_status" class="wr-form-label pb-3"
                  >Customer Status:</label
                ><br />
                <SelectOptionFromArray
                  label="Customer Status"
                  :options="customerStatusOptions"
                  :selectedOption="selectedCustomerStatus"
                  @update:selectedOption="selectCustomerStatusOption"
                  aria-label="Customer Status"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" class="pe-9">
                <label for="customer_photo_url" class="wr-form-label"
                  >Photo URL:</label
                ><br />
                <input
                  type="url"
                  v-model="form.customer_photo_url"
                  id="customer_photo_url"
                  class="wr-form-input wr-form-textarea"
                  placeholder="Enter photo url ..."
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" class="pe-9">
                <label for="remark" class="wr-form-label">Remark:</label><br />
                <input
                  type="text"
                  v-model="form.remark"
                  id="remark"
                  class="wr-form-input wr-form-textarea me-3"
                  placeholder="Enter more information ..."
                  rows="5"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <label for="receivables" class="wr-form-label"
                  >Receivables:</label
                ><br />
                <input
                  type="number"
                  v-model="form.receivables"
                  id="receivables"
                  class="wr-form-input"
                  min="1"
                  max="1000000000"
                  required
                />
              </v-col>
              <v-col cols="6">
                <label for="total_purchases" class="wr-form-label"
                  >Total Purchases:</label
                ><br />
                <input
                  type="number"
                  v-model="form.total_purchases"
                  id="total_purchases"
                  class="wr-form-input"
                  min="1"
                  max="1000000000"
                  required
                />
              </v-col>
            </v-row>
            <button
              type="submit"
              :disabled="loading"
              class="wr-primary-btn ps-2 pe-2 pt-1 pb-1 mt-3"
            >
              Create Customer
            </button>
            <div v-if="error">{{ error }}</div>
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
import { useCustomerStore } from "../../store/useCustomerStore";
import { useCustomerFiltersStore } from "../../store/useCustomerFiltersStore";
import SelectOptionFromArray from "../../../../components/common/SelectOptionFromArray.vue";

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

const customerStore = useCustomerStore();
const customerFiltersStore = useCustomerFiltersStore();

onMounted(async () => {
  await customerFiltersStore.fetchCustomerFilters();
});

const form = ref({
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
  customer_photo_url: "",
  customer_type: "",
  customer_status: "",
  remark: "",
  receivables: 1,
  total_purchases: 1,
});

const selectedCustomerType = ref(null);
const selectedCustomerStatus = ref(null);

const customerTypeOptions = computed(() =>
  customerFiltersStore.customerTypes.map((type) => type.name)
);
const customerStatusOptions = computed(() =>
  customerFiltersStore.customerStatuses.map((status) => status.name)
);

const showCustomerTypeOptions = ref(false);
const showCustomerStatusOptions = ref(false);

const selectCustomerTypeOption = (option) => {
  selectedCustomerType.value = option;
  showCustomerTypeOptions.value = false;
};
const selectCustomerStatusOption = (option) => {
  selectedCustomerStatus.value = option;
  showCustomerStatusOptions.value = false;
};

const selectCustomerStatusOptionOutClick = ref(null);
const handleCustomerStatusClickOutside = (event) => {
  if (
    selectCustomerStatusOptionOutClick.value &&
    !selectCustomerStatusOptionOutClick.value.contains(event.target)
  ) {
    showCustomerStatusOptions.value = false;
  }
};

const selectCustomerTypeOptionOutClick = ref(null);
const handleCustomerTypeClickOutside = (event) => {
  if (
    selectCustomerTypeOptionOutClick.value &&
    !selectCustomerTypeOptionOutClick.value.contains(event.target)
  ) {
    showCustomerTypeOptions.value = false;
  }
};

onMounted(() => {
  document.addEventListener("mousedown", handleCustomerStatusClickOutside);
  document.addEventListener("mousedown", handleCustomerTypeClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("mousedown", handleCustomerStatusClickOutside);
  document.removeEventListener("mousedown", handleCustomerTypeClickOutside);
});

const handleSubmit = async () => {
  const payload = {
    first_name: form.value.first_name,
    last_name: form.value.last_name,
    email: form.value.email,
    phone: form.value.phone,
    customer_photo_url: form.value.customer_photo_url,
    customer_type: selectedCustomerType.value,
    customer_status: selectedCustomerStatus.value,
    remark: form.value.remark,
    receivables: form.value.receivables,
    total_purchases: form.value.total_purchases,
  };
  try {
    console.log(payload);
    await customerStore.createCustomer(payload);
    emitClose();
  } catch (error) {
    console.error("Failed to create customer", error);
  }
};
</script>

