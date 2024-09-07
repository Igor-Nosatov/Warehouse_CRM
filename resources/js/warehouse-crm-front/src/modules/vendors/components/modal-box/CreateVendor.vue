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
              <v-col cols="4" class="mt-3">
                <label for="company_name" class="wr-form-label pb-4"
                  >Company Name:</label
                ><br />
                <input
                  type="text"
                  v-model="form.company_name"
                  id="company_name"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter company name ..."
                  aria-label="Company Name"
                  required
                />
              </v-col>
              <v-col cols="4" class="mt-3">
                <label for="vendor_first_name" class="wr-form-label"
                  >First Name:</label
                ><br />
                <input
                  type="text"
                  v-model="form.vendor_first_name"
                  id="vendor_first_name"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter first name ..."
                  aria-label="First Name"
                  required
                />
              </v-col>
              <v-col cols="4" class="mt-3">
                <label for="vendor_last_name" class="wr-form-label"
                  >Last Name:</label
                ><br />
                <input
                  type="text"
                  v-model="form.vendor_last_name"
                  id="vendor_last_name"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter last name ..."
                  aria-label="Last Name"
                  required
                />
              </v-col>
            </v-row>
            <v-row no-gutters>
              <v-col cols="4" class="mt-3">
                <label for="email" class="wr-form-label">Email:</label><br />
                <input
                  type="email"
                  v-model="form.email"
                  id="email"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter email ..."
                  aria-label="Email"
                  required
                />
              </v-col>
              <v-col cols="4" class="mt-3">
                <label for="location" class="wr-form-label pt-4"
                  >Location:</label
                ><br />
                <input
                  type="text"
                  v-model="form.location"
                  id="location"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter vendor location ..."
                  aria-label="Location"
                  required
                />
              </v-col>
              <v-col cols="4" class="mt-3">
                <label for="phone" class="wr-form-label">Phone:</label><br />
                <input
                  type="tel"
                  v-model="form.phone"
                  id="phone"
                  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter phone ..."
                  aria-label="Phone"
                  required
                />
              </v-col>
            </v-row>
            <v-row no-gutters class="pt-4">
              <v-col cols="6" class="pe-2">
                <div class="form-group">
                  <label for="vendor_type" class="wr-form-label"
                    >Vendor Type</label
                  ><br />
                  <SelectOptionFromArray
                    label="Vendor Type"
                    :options="vendorTypeOptions"
                    :selectedOption="selectedVendorType"
                    @update:selectedOption="selectVendorTypeOption"
                    aria-label="Vendor Type"
                  />
                </div>
              </v-col>
              <v-col cols="6" class="ps-2 pe-5">
                <div class="form-group">
                  <label for="vendor_type" class="wr-form-label"
                    >Vendor Status</label
                  ><br />
                  <SelectOptionFromArray
                    label="Vendor Status"
                    :options="vendorStatusOptions"
                    :selectedOption="selectedVendorStatus"
                    @update:selectedOption="selectVendorStatusOption"
                    aria-label="Vendor Status"
                  />
                </div>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4" class="mt-3">
                <label for="website" class="wr-form-label pt-4">Website:</label
                ><br />
                <input
                  type="url"
                  v-model="form.website"
                  id="website"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter vendor website ..."
                  aria-label="Website"
                />
              </v-col>
              <v-col cols="4" class="mt-3">
                <label for="used_credits" class="wr-form-label"
                  >Used Credits:</label
                >
                <input
                  type="number"
                  v-model="form.used_credits"
                  id="used_credits"
                  class="wr-form-input wr-form-input-small"
                  aria-label="Used Credits"
                  required
                />
              </v-col>
              <v-col cols="4" class="mt-3">
                <label for="receivables" class="wr-form-label"
                  >Receivables:</label
                ><br />
                <input
                  type="number"
                  v-model="form.receivables"
                  id="receivables"
                  class="wr-form-input wr-form-input-small"
                  placeholder="Enter receivables ..."
                  aria-label="Receivables"
                  required
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" class="ps-2 pe-2">
                <div class="ps-2 pe-2 form-group">
                  <label class="wr-checkbox-container">
                    Vendor is checked
                    <input
                      type="checkbox"
                      v-model="form.status"
                      aria-label="Vendor is checked"
                    />
                    <span class="wr-form-checkbox"></span>
                  </label>
                </div>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" class="pe-12">
                <label for="remark" class="wr-form-label">Remark:</label><br />
                <input
                  type="text"
                  v-model="form.remark"
                  id="remark"
                  class="wr-form-input wr-form-textarea"
                  placeholder="Enter more information ..."
                  aria-label="Remark"
                  rows="5"
                />
              </v-col>
            </v-row>
            <button
              type="submit"
              :disabled="loading"
              class="wr-primary-btn ps-2 pe-2 pt-1 pb-1 mt-6"
              aria-label="Create Vendor"
            >
              Create Vendor
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
import { useVendorStore } from "../../store/useVendorsStore";
import { useVendorsFilterStore } from "../../store/useVendorsFilterStore";
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

const vendorStore = useVendorStore();
const form = ref({
  company_name: "",
  vendor_first_name: "",
  vendor_last_name: "",
  email: "",
  phone: "",
  location: "",
  website: "",
  remark: "",
  status: false,
  vendor_status: "",
  vendor_type: "",
  receivables: 1,
  used_credits: 1,
});

const vendorsFilterStore = useVendorsFilterStore();

onMounted(async () => {
  await vendorsFilterStore.fetchVendorFilters();
});

const selectedVendorType = ref("");
const selectedVendorStatus = ref("");

const vendorTypeOptions = computed(() =>
  vendorsFilterStore.vendorType.map((type) => type.name)
);
const vendorStatusOptions = computed(() =>
  vendorsFilterStore.vendorStatus.map((status) => status.name)
);

const showVendorTypeOptions = ref(false);
const showVendorStatusOptions = ref(false);

const selectVendorTypeOption = (option) => {
  selectedVendorType.value = option;
  showVendorTypeOptions.value = false;
};
const selectVendorStatusOption = (option) => {
  selectedVendorStatus.value = option;
  showVendorStatusOptions.value = false;
};

const selectVendorStatusOptionOutClick = ref(null);
const handleVendorStatusClickOutside = (event) => {
  if (
    selectVendorStatusOptionOutClick.value &&
    !selectVendorStatusOptionOutClick.value.contains(event.target)
  ) {
    showVendorStatusOptions.value = false;
  }
};

const selectVendorTypeOptionOutClick = ref(null);
const handleVendorTypeClickOutside = (event) => {
  if (
    selectVendorTypeOptionOutClick.value &&
    !selectVendorTypeOptionOutClick.value.contains(event.target)
  ) {
    showVendorTypeOptions.value = false;
  }
};

onMounted(() => {
  document.addEventListener("mousedown", handleVendorStatusClickOutside);
  document.addEventListener("mousedown", handleVendorTypeClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("mousedown", handleVendorStatusClickOutside);
  document.removeEventListener("mousedown", handleVendorTypeClickOutside);
});

const handleSubmit = async () => {
  const payload = {
    company_name: form.value.company_name,
    vendor_first_name: form.value.vendor_first_name,
    vendor_last_name: form.value.vendor_last_name,
    email: form.value.email,
    phone: form.value.phone,
    location: form.value.location,
    website: form.value.website,
    remark: form.value.remark,
    status: form.value.status,
    vendor_status: selectedVendorStatus.value,
    vendor_type: selectedVendorType.value,
    receivables: form.value.receivables,
    used_credits: form.value.used_credits,
  };
  try {
    await vendorStore.createVendor(payload);
    form.value = {
      company_name: "",
      vendor_first_name: "",
      vendor_last_name: "",
      email: "",
      phone: "",
      location: "",
      website: "",
      remark: "",
      status: false,
      vendor_status: "",
      vendor_type: "",
      receivables: 1,
      used_credits: 1,
    };

    selectedVendorStatus.value = "";
    selectedVendorType.value = "";

    emitClose();
  } catch (error) {
    console.error("Failed to create vendor", error);
  }
};
</script>
