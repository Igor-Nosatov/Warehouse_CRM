<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick">
    <div class="modal-form edit-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="7" class="pt-2 pb-4">
          <div class="d-flex flex-row justify-space-start pt-3">
            <v-btn class="close-btn" @click="emitClose" aria-label="Close">
              <i class="las la-times fs-2"></i>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <form @submit.prevent="handleSubmit" class="ps-7 pb-12">
        <v-row no-gutters class="pb-4">
          <v-col cols="4" class="ps-2 pe-2">
            <div class="form-group pb-4">
              <label for="company_name" class="wr-form-label ps-1"
                >Company Name</label
              ><br />
              <input
                type="text"
                id="company_name"
                v-model="form.company_name"
                class="wr-form-input wr-form-input-small"
                aria-label="Company Name"
              />
            </div>
          </v-col>
          <v-col cols="4" class="ps-2 pe-2">
            <div class="form-group pb-4">
              <label for="vendor_first_name" class="wr-form-label ps-1"
                >Vendor First Name</label
              ><br />
              <input
                type="text"
                id="vendor_first_name"
                v-model="form.vendor_first_name"
                class="wr-form-input wr-form-input-small"
                aria-label="Vendor First Name"
              />
            </div>
          </v-col>
          <v-col cols="4" class="ps-2 pe-2">
            <div class="form-group pb-4">
              <label for="vendor_last_name" class="wr-form-label ps-1"
                >Vendor Last Name</label
              ><br />
              <input
                type="text"
                id="vendor_last_name"
                v-model="form.vendor_last_name"
                class="wr-form-input wr-form-input-small"
                aria-label="Vendor Last Name"
              />
            </div>
          </v-col>
          <v-col cols="4" class="ps-2 pe-2">
            <div class="form-group pb-4">
              <label for="email" class="wr-form-label ps-1">Email</label><br />
              <input
                type="email"
                id="email"
                v-model="form.email"
                class="wr-form-input wr-form-input-small"
                aria-label="Email"
              />
            </div>
          </v-col>
          <v-col cols="4" class="ps-2 pe-2">
            <div class="form-group pb-4">
              <label for="phone" class="wr-form-label ps-1">Phone</label><br />
              <input
                type="tel"
                id="phone"
                v-model="form.phone"
                class="wr-form-input wr-form-input-small"
                aria-label="Phone"
              />
            </div>
          </v-col>
          <v-col cols="4" class="ps-2 pe-2">
            <div class="form-group">
              <label for="receivables" class="wr-form-label">Receivables</label
              ><br />
              <input
                type="number"
                id="receivables"
                v-model="form.receivables"
                class="wr-form-input wr-form-input-small"
                aria-label="Receivables"
              />
            </div>
          </v-col>
          <v-col cols="12" class="ps-1 pe-2 pt-2">
            <div class="ps-2 pe-2 form-group pb-3">
              <label class="wr-checkbox-container pt-1">
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
          <v-col cols="6" class="ps-2 pe-2">
            <div class="form-group pb-4">
              <label for="location" class="wr-form-label ps-1">Location</label
              ><br />
              <input
                type="text"
                id="location"
                v-model="form.location"
                class="wr-form-input"
                aria-label="Location"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2">
            <div class="form-group pb-4">
              <label for="website" class="wr-form-label ps-1">Website</label
              ><br />
              <input
                type="url"
                id="website"
                v-model="form.website"
                class="wr-form-input"
                aria-label="Website"
              />
            </div>
          </v-col>
          <v-col cols="12" class="ps-2 pe-2">
            <div class="form-group pb-4 pe-4">
              <label for="remark" class="wr-form-label ps-1">Remark</label
              ><br />
              <textarea
                id="remark"
                v-model="form.remark"
                class="wr-form-input wr-form-textarea"
                rows="3"
                aria-label="Remark"
              ></textarea>
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2">
            <div class="form-group">
              <label for="vendor_type" class="wr-form-label">Vendor Type</label>
              <SelectOptionFromArray
                label="Vendor Type"
                :options="vendorTypeOptions"
                :selectedOption="selectedVendorType"
                @update:selectedOption="selectVendorTypeOption"
                aria-label="Vendor Type"
              />
            </div>
          </v-col>
          <v-col cols="6" class="ps-2 pe-2">
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
          <v-col cols="6" class="ps-2 pe-2">
            <div class="form-group">
              <label for="used_credits" class="wr-form-label"
                >Used Credits</label
              >
              <input
                type="number"
                id="used_credits"
                v-model="form.used_credits"
                class="wr-form-input"
                aria-label="Used Credits"
              />
            </div>
          </v-col>
        </v-row>
        <button
          type="submit"
          class="wr-primary-btn ps-2 pe-2 pt-2 pb-2 ms-2"
          aria-label="Update Vendor"
        >
          Update Vendor{{}}
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
  ref,
  onUnmounted,
  computed,
} from "vue";
import { useVendorByIdStore } from "@/modules/vendors/store/useVendorByIdStore";
import { useVendorStore } from "../../store/useVendorsStore";
import { useVendorsFilterStore } from "../../store/useVendorsFilterStore";
import SelectOptionFromArray from "../../../../components/common/SelectOptionFromArray.vue";

const props = defineProps({
  isOpen: Boolean,
  vendorId: Number,
});

const emit = defineEmits(["close"]);

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = () => {
  emitClose();
};

const vendorByIdStore = useVendorByIdStore();
const vendorStore = useVendorStore();
const vendorsFilterStore = useVendorsFilterStore();

const form = reactive({
  company_name: "",
  vendor_first_name: "",
  vendor_last_name: "",
  email: "",
  phone: "",
  location: "",
  website: "",
  remark: "",
  status: false,
  vendor_type: "",
  receivables: 1,
  used_credits: 1,
});

const selectedVendorType = ref(null);
const selectedVendorStatus = ref(null);

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

const loadVendorData = async () => {
  if (props.vendorId) {
    await vendorByIdStore.fetchVendorById(props.vendorId);
    if (vendorByIdStore.vendor) {
      form.company_name = vendorByIdStore.vendor.company_name;
      form.vendor_first_name = vendorByIdStore.vendor.vendor_first_name;
      form.vendor_last_name = vendorByIdStore.vendor.vendor_last_name;
      form.email = vendorByIdStore.vendor.email;
      form.phone = vendorByIdStore.vendor.phone;
      form.location = vendorByIdStore.vendor.location;
      form.website = vendorByIdStore.vendor.website;
      form.remark = vendorByIdStore.vendor.remark;
      form.status = vendorByIdStore.vendor.status === "active";
      form.vendor_type = vendorByIdStore.vendor.vendor_type;
      form.receivables = vendorByIdStore.vendor.receivables;
      form.used_credits = vendorByIdStore.vendor.used_credits;

      selectedVendorType.value = vendorByIdStore.vendor.vendor_type;
      selectedVendorStatus.value = vendorByIdStore.vendor.status;
    }
  }
};

watch(
  () => props.vendorId,
  (vendorId) => {
    if (vendorId) {
      loadVendorData();
    }
  },
  { immediate: true }
);

onMounted(async () => {
  await vendorsFilterStore.fetchVendorFilters();
  if (props.vendorId) {
    await loadVendorData();
  }
});

const handleSubmit = async () => {
  if (props.vendorId !== undefined) {
    const payload = {
      company_name: form.company_name,
      vendor_first_name: form.vendor_first_name,
      vendor_last_name: form.vendor_last_name,
      email: form.email,
      phone: form.phone,
      location: form.location,
      website: form.website,
      remark: form.remark,
      status: form.status,
      vendor_status: selectedVendorStatus.value,
      vendor_type: selectedVendorType.value,
      receivables: form.receivables,
      used_credits: form.used_credits,
    };
    try {
      await vendorStore.updateVendor(props.vendorId, payload);
      emitClose();
    } catch (error) {
      console.error("Failed to update vendor", error);
    }
  } else {
    console.error("Vendor ID is undefined");
  }
};
</script>
