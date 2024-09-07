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
      <h3 class="ps-3 mt-2 pb-2 filter-title pt-3">Purchase Status</h3>
      <v-row no-gutters class=" ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="status in purchaseStatus"
          :key="status.name"
        >
          <input
            type="radio"
            name="customer-type"
            :id="`type-${status.name}`"
            class="hidden radio-label"
            v-model="selectedPurchaseStatus "
            :value="status.name"
          />
          <label
            :for="`type-${status.name}`"
            class="button-label"
            :class="{ active: selectedPurchaseStatus  === status.name }"
          >
            <div class="d-flex justify-space-between">
              <div class="pt-2">{{ status.name }}</div>
              <div class="status-score">
                <span class="status-score-data">{{ status.status_count }}</span>
              </div>
            </div>
          </label>
        </v-col>
      </v-row>
      <h3 class="ps-3 pb-2 pt-4 filter-title text-uppercase">Sort By</h3>
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
      <h3 class="ps-3 mt-4 pb-2 filter-title pt-3">Payment Status</h3>
      <v-row no-gutters class="pb-3 ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="status in paymentStatus"
          :key="status.id"
        >
          <input
            type="radio"
            name="customer-type"
            :id="`type-${status.id}`"
            class="hidden radio-label"
            v-model="selectedPaymentStatus "
            :value="status.id"
          />
          <label
            :for="`type-${status.id}`"
            class="button-label"
            :class="{ active: selectedPaymentStatus  === status.id }"
          >
            <div class="d-flex justify-space-between">
              <div class="pt-2">{{ status.name }}</div>
              <div class="status-score">
                <span class="status-score-data">{{ status.purchase_count }}</span>
              </div>
            </div>
          </label>
        </v-col>
      </v-row>
      <h3 class="ps-3  pt-3 pb-2 filter-title text-uppercase">
        Total Order Range
      </h3>
      <div class="ps-3 pe-3 pb-6">
        <div class="d-flex flex-row pb-4">
          <input
            type="text"
            id="minOrderRange"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="min-range-input"
            placeholder="Minimum order range..."
            min="1"
            v-model.number="minOrderRange"
          />
        </div>
        <div class="d-flex flex-row">
          <input
            type="text"
            id="maxOrderRange"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="max-range-input"
            placeholder="Maximum order range..."
            min="2"
            v-model.number="maxOrderRange"
          />
        </div>
      </div>
      <h3 class="ps-3 pb-2 filter-title">Price</h3>
      <div class="ps-3 pe-3 mb-12 pb-8">
        <div class="d-flex flex-row pb-4">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="minPrice"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="min-price-input"
            placeholder="Enter min price..."
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
            id="maxPrice"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="max-price-input"
            placeholder="Enter max price..."
            min="2"
            v-model.number="maxPrice"
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
import { ref, watch, computed, defineProps, defineEmits } from "vue";

const props = defineProps<{
  purchaseStatus: Array<{ name: string; status_count: number }>;
  paymentStatus: Array<{ id: number; name: string; purchase_count: number }>;
  loading: boolean;
  error: string | null;
  filters: {
    purchase_sales_order_status: string;
    purchase_status: number | null;
    min_price: number| null;
    max_price: number| null;
    min_purchase_qty: number| null;
    max_purchase_qty: number| null;
    order_by_name: string;
    order_by_param: string;
  };
}>();

const sortOptions = [
  {
    text: "Date Time of Placement Ascending",
    value: { order_by_name: "date_time_of_placement", order_by_param: "asc" },
  },
  {
    text: "Date Time of Placement Descending",
    value: { order_by_name: "date_time_of_placement", order_by_param: "desc" },
  },
  {
    text: "Date Time of Delivery Ascending",
    value: { order_by_name: "date_time_of_delivery", order_by_param: "asc" },
  },
  {
    text: "Date Time of Delivery Descending",
    value: { order_by_name: "date_time_of_delivery", order_by_param: "desc" },
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

const emit = defineEmits(["filters-changed", "search-changed"]);

const selectedPurchaseStatus = ref(props.filters.purchase_sales_order_status);
const selectedPaymentStatus = ref(props.filters.purchase_status);
const minOrderRange = ref(props.filters.min_purchase_qty);
const maxOrderRange = ref(props.filters.max_purchase_qty);
const minPrice = ref(props.filters.min_price);
const maxPrice = ref(props.filters.max_price);
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
    selectedPurchaseStatus.value = newFilters.purchase_sales_order_status;
    selectedPaymentStatus.value = newFilters.purchase_status;
    minOrderRange.value = newFilters.min_purchase_qty;
    maxOrderRange.value = newFilters.max_purchase_qty;
    minPrice.value = newFilters.min_price;
    maxPrice.value = newFilters.max_price;
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
    purchase_sales_order_status: selectedPurchaseStatus.value,
    purchase_status: selectedPaymentStatus.value,
    min_purchase_qty: minOrderRange.value,
    max_purchase_qty: maxOrderRange.value,
    min_price: minPrice.value,
    max_price: maxPrice.value,
    order_by_name: sortOption.value.value.order_by_name,
    order_by_param: sortOption.value.value.order_by_param,
  });
};

const resetFilters = () => {
  selectedPurchaseStatus.value = "";
  selectedPaymentStatus.value = null;
  minOrderRange.value = 0;
  maxOrderRange.value = 0;
  minPrice.value = 0;
  maxPrice.value = 0;
  sortOption.value = sortOptions[0];
  emit("filters-changed", {
    sales_order_status: "",
    payment_status: null,
    min_product_quantity: null,
    max_product_quantity: null,
    min_price: null,
    max_price: null,
    order_by_name: sortOptions[0].value.order_by_name,
    order_by_param: sortOptions[0].value.order_by_param,
  });
};
</script>
