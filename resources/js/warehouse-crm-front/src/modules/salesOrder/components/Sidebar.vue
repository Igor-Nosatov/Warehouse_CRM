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
      <h3 class="ps-3 mt-4 pb-2 pt-1 filter-title">Sales Order Status</h3>
      <v-row no-gutters class="pb-3 ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="status in salesOrderStatus"
          :key="status.name"
        >
          <input
            type="radio"
            name="customer-status"
            :id="`status-${status.name}`"
            class="hidden radio-label"
            v-model="selectedOrderProductStatus"
            :value="status.name"
            @change="handleStatusChange(status.name)"
          />
          <label
            :for="`status-${status.name}`"
            class="button-label"
            :class="{ active: selectedOrderProductStatus === status.name }"
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
      <h3 class="ps-3 mt-4 pb-2 filter-title">Payment Status</h3>
      <v-row no-gutters class="pb-3 ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="status in paymentStatus"
          :key="status.name"
        >
          <input
            type="radio"
            name="customer-status"
            :id="`status-${status.id}`"
            class="hidden radio-label"
            v-model="selectedPaymentStatus"
            :value="status.id"
            @change="handleStatusChange(status.name)"
          />
          <label
            :for="`status-${status.id}`"
            class="button-label"
            :class="{ active: selectedPaymentStatus === status.id }"
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
      <h3 class="ps-3 mt-4 pb-2 filter-title text-uppercase">Sort By</h3>
      <div class="ps-3 pe-3 pb-3">
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

      <h3 class="ps-3 mt-4 pt-3 pb-3 filter-title text-uppercase">
        Total Order Range
      </h3>
      <div class="ps-3 pe-3 pb-3">
        <div class="d-flex flex-row pb-4">
          <input
            type="text"
            id="minOrderRange"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="min-range-input"
            placeholder="Minimum order range..."
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
            v-model.number="maxOrderRange"
          />
        </div>
      </div>

      <h3 class="ps-3 mt-4 pb-2 filter-title">Price</h3>
      <div class="ps-3 pe-3 mb-6 pb-3">
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
  salesOrderStatus: { name: string; count: number }[];
  paymentStatus: { id: number; name: string; purchase_count: number }[];
  filters: {
    sales_order_status: string;
    payment_status: number | null;
    min_product_quantity: number| null;
    max_product_quantity: number| null;
    min_price: number | null;
    max_price: number| null;
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

const selectedOrderProductStatus = ref(props.filters.sales_order_status);
const selectedPaymentStatus = ref(props.filters.payment_status);
const minOrderRange = ref(props.filters.min_product_quantity);
const maxOrderRange = ref(props.filters.max_product_quantity);
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
    selectedOrderProductStatus.value = newFilters.sales_order_status;
    selectedPaymentStatus.value = newFilters.payment_status;
    minOrderRange.value = newFilters.min_product_quantity;
    maxOrderRange.value = newFilters.max_product_quantity;
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
    sales_order_status: selectedOrderProductStatus.value,
    payment_status: selectedPaymentStatus.value,
    min_product_quantity: minOrderRange.value,
    max_product_quantity: maxOrderRange.value,
    min_price: minPrice.value,
    max_price: maxPrice.value,
    order_by_name: sortOption.value.value.order_by_name,
    order_by_param: sortOption.value.value.order_by_param,
  });
};

const resetFilters = () => {
  selectedOrderProductStatus.value = "";
  selectedPaymentStatus.value = null;
  minOrderRange.value = null;
  maxOrderRange.value = null;
  minPrice.value = null;
  maxPrice.value = null;
  sortOption.value = sortOptions[0];
  emit("filters-changed", {
    sales_order_status: "",
    payment_status: "",
    min_product_quantity: null,
    max_product_quantity: null,
    min_price: null,
    max_price: null,
    order_by_name: sortOptions[0].value.order_by_name,
    order_by_param: sortOptions[0].value.order_by_param,
  });
};
</script>
