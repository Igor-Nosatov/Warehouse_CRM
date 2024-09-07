<template>
  <v-card class="sidebar ml-3 mr-2 pe-2 ps-2 pb-3 sidebar-filter-list">
    <form @submit.prevent="applyFilters">
      <div class="d-flex flex-row">
        <v-btn type="reset" class="reset-btn-top" @click="resetFilters">
          <i class="las la-sync mr-1 ml-1"></i> Reset Filters
        </v-btn>
        <v-btn type="submit" class="apply-btn-top">
          <i class="las la-filter mr-1 ml-1"></i> Apply Filters
        </v-btn>
      </div>
      <h2 class="ps-3 mt-4 pb-2 filter-title pt-1">Vendor Type</h2>
      <v-row no-gutters class="pb-3 ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="status in vendorStatus"
          :key="status.name"
        >
          <input
            type="radio"
            name="customer-type"
            :id="`type-${status.name}`"
            class="hidden radio-label"
            v-model="selectedVendorStatus"
            :value="status.name"
            @change="handleStatusChange(status.name)"
          />
          <label
            :for="`type-${status.name}`"
            class="button-label"
            :class="{ active: selectedVendorStatus === status.name }"
          >
            <div class="d-flex justify-space-between">
              <div class="pt-2">{{ status.name }}</div>
              <div class="status-score">
                <span class="status-score-data">{{ status.count }}</span>
              </div>
            </div>
          </label>
        </v-col>
      </v-row>

      <h3 class="ps-3 mt-4 pb-3 filter-title text-uppercase pt-1">Sort By</h3>
      <div class="ps-3 pe-3">
        <div class="sort-select">
          <div class="selected-option selected-option-sidebar" @click="toggleSortOptions">
            {{ currentSortOption.text }}
            <i class="las la-chevron-down ml-2"></i>
          </div>
          <div class="sort-options" v-if="showSortOptions">
            <div
              v-for="(option, index) in sortOptions"
              :key="index"
              class="sort-option"
              :class="{ active: option.value === sortOption.value }"
              @click="selectSortOption(option)"
            >
              {{ option.text }}
            </div>
          </div>
        </div>
      </div>

      <h3 class="ps-3 mt-4 pb-2 filter-title pt-2">Vendor Type</h3>
      <v-row no-gutters class="ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="type in vendorType"
          :key="type.name"
        >
          <input
            type="radio"
            name="customer-type"
            :id="`type-${type.name}`"
            class="hidden radio-label"
            v-model="selectedVendorType"
            :value="type.name"
            @change="handleTypeChange(type.name)"
          />
          <label
            :for="`type-${type.name}`"
            class="button-label"
            :class="{ active: selectedVendorType === type.name }"
          >
            <div class="d-flex justify-space-between">
              <div class="pt-2">{{ type.name }}</div>
              <div class="status-score">
                <span class="status-score-data">{{ type.count }}</span>
              </div>
            </div>
          </label>
        </v-col>
      </v-row>

      <h3 class="ps-3 pt-3 pb-4 filter-title">Receivables Range</h3>
      <div class="ps-3 pe-3">
        <div class="d-flex flex-row pb-4">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="minReceivables"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="min-price-input"
            placeholder="Enter min receivables..."
            min="1"
            v-model.number="minPrice"
          />
        </div>
        <div class="d-flex flex-row">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="maxReceivables"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="max-price-input mb-4"
            placeholder="Enter max receivables..."
            min="2"
            v-model.number="maxPrice"
          />
        </div>
      </div>
      <h3 class="ps-3 pb-2 filter-title">Used Credits Range</h3>
      <div class="ps-3 pe-3">
        <div class="d-flex flex-row pb-4">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="minCredits"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="min-price-input"
            placeholder="Enter min credits..."
            min="1"
            v-model.number="minUsedCredits"
          />
        </div>
        <div class="d-flex flex-row mb-12 ">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="maxCredits"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="max-price-input"
            placeholder="Enter max credits..."
            min="2"
            v-model.number="maxUsedCredits"
          />
        </div>
      </div>
      <div class="d-flex flex-row">
        <v-btn type="reset" class="reset-btn-bottom btn-position" @click="resetFilters">
          <i class="las la-sync mr-1 ml-1"></i> Reset Filters
        </v-btn>
        <v-btn type="submit" class="apply-btn-bottom btn-position">
          <i class="las la-filter mr-1 ml-1"></i> Apply Filters
        </v-btn>
      </div>
    </form>
  </v-card>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits, computed, watch } from "vue";

const props = defineProps<{
  vendorStatus: { name: string; count: number }[];
  vendorType: { name: string; count: number }[];
  filters: {
    vendor_type: string;
    vendor_status: string;
    order_by_name: string;
    order_by_param: string;
    min_price: number| null;
    max_price: number| null;
    min_used_credits: number| null;
    max_used_credits: number| null;
  };
}>();

const emit = defineEmits(["filters-changed", "search-changed"]);

const sortOptions = [
  {
    text: "Company Name By ASC",
    value: { order_by_name: "company_name", order_by_param: "asc" },
  },
  {
    text: "Company  Name By DESC",
    value: { order_by_name: "company_name", order_by_param: "desc" },
  },
];
const showSortOptions = ref(false);
const toggleSortOptions = () => {
  showSortOptions.value = !showSortOptions.value;
};
const selectSortOption = (option: (typeof sortOptions)[0]) => {
  sortOption.value = option;
  showSortOptions.value = false;
};
const currentSortOption = computed(() => sortOption.value);

const selectedVendorType = ref(props.filters.vendor_type);
const selectedVendorStatus = ref(props.filters.vendor_status);
const minPrice = ref(props.filters.min_price);
const maxPrice = ref(props.filters.max_price);
const minUsedCredits = ref(props.filters.min_used_credits);
const maxUsedCredits = ref(props.filters.max_used_credits);
const sortOption = ref(
  sortOptions.find(
    (option) =>
      option.value.order_by_name === props.filters.order_by_name &&
      option.value.order_by_param === props.filters.order_by_param
  ) || sortOptions[0]
);

watch(
  () => props.filters,
  (newFilters) => {
    selectedVendorType.value = newFilters.vendor_type;
    selectedVendorStatus.value = newFilters.vendor_status;
    minPrice.value = newFilters.min_price;
    maxPrice.value = newFilters.max_price;
    minUsedCredits.value = newFilters.min_used_credits;
    maxUsedCredits.value = newFilters.max_used_credits;
    sortOption.value =
      sortOptions.find(
        (option) =>
          option.value.order_by_name === newFilters.order_by_name &&
          option.value.order_by_param === newFilters.order_by_param
      ) || sortOptions[0];
  },
  { immediate: true }
);

const applyFilters = () => {
  emit("filters-changed", {
    vendor_type: selectedVendorType.value,
    vendor_status: selectedVendorStatus.value,
    min_price: minPrice.value,
    max_price: maxPrice.value,
    min_used_credits: minUsedCredits.value,
    max_used_credits: maxUsedCredits.value,
    order_by_name: sortOption.value.value.order_by_name,
    order_by_param: sortOption.value.value.order_by_param,
  });
};

const resetFilters = () => {
  selectedVendorType.value = "";
  selectedVendorStatus.value = "";
  minPrice.value = null;
  maxPrice.value = null;
  minUsedCredits.value = null;
  maxUsedCredits.value = null;
  sortOption.value = sortOptions[0];
  applyFilters();
};

const handleTypeChange = (typeName: string) => {
  selectedVendorType.value = typeName;
};

const handleStatusChange = (statusName: string) => {
  selectedVendorStatus.value = statusName;
};
</script>
