

<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick">
    <div class="modal-form edit-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="7" class="pt-2 pb-4">
          <div class="d-flex flex-row justify-space-start">
            <v-btn class="close-btn" @click="emitClose">
              <i class="las la-times fs-2"></i>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <form @submit.prevent="handleSubmit" class="pb-6">
        <v-row no-gutters class="pb-4 ps-4">
          <v-col cols="6" class="ps-2 pe-2 pb-4">
            <div class="form-group">
              ID:{{ customerId }}
              <label for="first_name" class="wr-form-label">First Name</label
              ><br />
              <input
                type="text"
                id="first_name"
                v-model="form.first_name"
                class="wr-form-input"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2 pb-4">
            <div class="form-group">
              <label for="last_name" class="wr-form-label">Last Name</label
              ><br />
              <input
                type="text"
                id="last_name"
                v-model="form.last_name"
                class="wr-form-input"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2 pb-4">
            <div class="form-group">
              <label for="email" class="wr-form-label">Email</label><br />
              <input
                type="email"
                id="email"
                v-model="form.email"
                class="wr-form-input"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2 pb-4">
            <div class="form-group">
              <label for="phone" class="wr-form-label">Phone</label><br />
              <input
                type="tel"
                id="phone"
                v-model="form.phone"
                class="wr-form-input"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2 pb-4">
            <div class="form-group">
              <label for="customer_type" class="wr-form-label"
                >Customer Type</label
              ><br />
              <SelectOptionFromArray
                label="Customer Type"
                :options="customerTypeOptions"
                :selectedOption="selectedCustomerType"
                @update:selectedOption="selectCustomerTypeOption"
                aria-label="Customer Type"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2 pb-4">
            <div class="form-group">
              <label for="customer_status" class="wr-form-label"
                >Customer Status</label
              ><br />
              <SelectOptionFromArray
                label="Customer Status"
                :options="customerStatusOptions"
                :selectedOption="selectedCustomerStatus"
                @update:selectedOption="selectCustomerStatusOption"
                aria-label="Customer Status"
              />
            </div>
          </v-col>

          <v-col cols="12" class="ps-2 pe-4 pb-4">
            <div class="form-group">
              <label for="customer_photo_url" class="wr-form-label"
                >Photo URL</label
              ><br />
              <input
                type="url"
                id="customer_photo_url"
                v-model="form.customer_photo_url"
                class="wr-form-input wr-form-textarea"
              />
            </div>
          </v-col>
          <v-col cols="12" class="ps-2 pe-4 pb-4">
            <div class="form-group">
              <label for="remark" class="wr-form-label">Remark</label><br />
              <textarea
                id="remark"
                v-model="form.remark"
                class="wr-form-input wr-form-textarea"
                rows="5"
              ></textarea>
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2 pb-1">
            <div class="form-group">
              <label for="total_purchases" class="wr-form-label"
                >Total Purchases</label
              ><br />
              <input
                type="number"
                id="total_purchases"
                v-model="form.total_purchases"
                class="wr-form-input"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-6 pb-1">
            <div class="form-group">
              <label for="receivables" class="wr-form-label">Receivables</label>
              <input
                type="number"
                id="receivables"
                v-model="form.receivables"
                class="wr-form-input"
              />
            </div>
          </v-col>
        </v-row>
        <button type="submit" class="wr-primary-btn ms-6 pe-2 pb-8">
          Update Customer
        </button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, ref, onMounted, watch, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useCustomerByIdStore } from '@/modules/customer/store/useCustomerByIdStore';
import { useCustomerFiltersStore } from '@/modules/customer/store/useCustomerFiltersStore';
import { useCustomerStore } from '@/modules/customer/store/useCustomerStore';
import SelectOptionFromArray from '../../../../components/common/SelectOptionFromArray.vue';

const props = defineProps({
  isOpen: Boolean,
  customerId: Number,
});

const router = useRouter();
const emit = defineEmits(['close']);

const emitClose = () => {
  emit('close');
};

const handleBackdropClick = () => {
  emitClose();
};

const customerByIdStore = useCustomerByIdStore();
const customerStore = useCustomerStore();
const customerFiltersStore = useCustomerFiltersStore();

const form = ref({
  first_name: '',
  last_name: '',
  customer_photo_url: '',
  customer_type: '',
  customer_status: '',
  email: '',
  phone: '',
  remark: '',
  total_purchases: 1,
  receivables: 1,
});

const selectedCustomerType = ref(null);
const selectedCustomerStatus = ref(null);

const customerTypeOptions = computed(() =>
  customerFiltersStore.customerTypes.map(type => type.name)
);
const customerStatusOptions = computed(() =>
  customerFiltersStore.customerStatuses.map(status => status.name)
);

const selectCustomerTypeOption = option => {
  selectedCustomerType.value = option;
};
const selectCustomerStatusOption = option => {
  selectedCustomerStatus.value = option;
};

const loadCustomerData = async () => {
  if (props.customerId) {
    try {
      await customerByIdStore.fetchCustomerById(props.customerId);
      if (customerByIdStore.customer) {
        form.value = {
          first_name: customerByIdStore.customer.first_name,
          last_name: customerByIdStore.customer.last_name,
          email: customerByIdStore.customer.email,
          phone: customerByIdStore.customer.phone,
          customer_photo_url: customerByIdStore.customer.customer_photo_url,
          customer_type: customerByIdStore.customer.customer_type,
          customer_status: customerByIdStore.customer.customer_status,
          remark: customerByIdStore.customer.remark,
          total_purchases: customerByIdStore.customer.total_purchases,
          receivables: customerByIdStore.customer.receivables,
        };
        selectedCustomerType.value = customerByIdStore.customer.customer_type;
        selectedCustomerStatus.value = customerByIdStore.customer.customer_status;
      }
    } catch (error) {
      console.error('Failed to fetch customer data', error);
    }
  }
};

watch(
  () => props.customerId,
  newCustomerId => {
    if (newCustomerId) {
      loadCustomerData();
    }
  },
  { immediate: true }
);

onMounted(async () => {
  await customerFiltersStore.fetchCustomerFilters();
  if (props.customerId) {
    loadCustomerData();
  }
});

const handleSubmit = async () => {
  if (props.customerId !== undefined) {
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
      await customerStore.updateCustomer(props.customerId, payload);
      emitClose();
    } catch (error) {
      console.error('Failed to update customer', error);
    }
  }
};
</script>
