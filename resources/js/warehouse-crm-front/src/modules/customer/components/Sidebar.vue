<template>
  <v-card class="sidebar ml-3 mr-2 pe-2 ps-2">
    <form @submit.prevent="applyFilters">
      <div class="d-flex flex-row">
        <v-btn type="reset" class="reset-btn-top" @click="resetFilters">
          <i class="las la-sync mr-1 ml-1"></i> Reset Filters
        </v-btn>
        <v-btn type="submit" class="apply-btn-top">
          <i class="las la-filter mr-1 ml-1"></i> Apply Filters
        </v-btn>
      </div>
      <h3 class="ps-3 mt-4 pb-2 filter-title pt-1">Customer Type</h3>
      <v-row no-gutters class="ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="type in customerTypes"
          :key="type.name"
        >
          <input
            type="radio"
            name="customer-type"
            :id="`type-${type.name}`"
            class="hidden radio-label"
            v-model="selectedCustomerType"
            :value="type.name"
            @change="handleTypeChange(type.name)"
          />
          <label
            :for="`type-${type.name}`"
            class="button-label"
            :class="{ active: selectedCustomerType === type.name }"
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
      <h3 class="ps-3 pt-4 pb-3 filter-title text-uppercase">Sort By</h3>
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
      <h3 class="ps-3 pt-3 pb-2 filter-title">Customer Status</h3>
      <v-row no-gutters class="pb-3 ps-2">
        <v-col
          cols="6"
          class="d-flex justify-center"
          v-for="status in customerStatuses"
          :key="status.name"
        >
          <input
            type="radio"
            name="customer-status"
            :id="`status-${status.name}`"
            class="hidden radio-label"
            v-model="selectedCustomerStatus"
            :value="status.name"
            @change="handleStatusChange(status.name)"
          />
          <label
            :for="`status-${status.name}`"
            class="button-label"
            :class="{ active: selectedCustomerStatus === status.name }"
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
      <h3 class="ps-3 pt-3 pb-2 filter-title">Purchases amount</h3>
      <div class="ps-3 pe-3">
        <div class="d-flex flex-row pb-4">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="numberInput"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="min-price-input"
            placeholder="Enter min price..."
            v-model.number="purchasesMinAmount"
          />
        </div>
        <div class="d-flex flex-row pb-2">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="numberInput"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="max-price-input mb-4"
            placeholder="Enter max price..."
            v-model.number="purchasesMaxAmount"
          />
        </div>
      </div>
      <h3 class="ps-3 pb-2 filter-title">Receivables range</h3>
      <div class="ps-3 pe-3">
        <div class="d-flex flex-row pb-4">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="numberInput"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="min-price-input"
            placeholder="Enter min price..."
            min="1"
            v-model.number="receivablesMinAmount"
          />
        </div>
        <div class="d-flex flex-row mb-12">
          <div>
            <i class="las la-dollar-sign"></i>
          </div>
          <input
            type="text"
            id="numberInput"
            pattern="[0-9]*"
            title="Please enter only numbers"
            class="max-price-input"
            placeholder="Enter max price..."
            min="2"
            v-model.number="receivablesMaxAmount"
          />
        </div>
      </div>
      <div class="d-flex flex-row">
        <v-btn type="reset" class="reset-btn-bottom" @click="resetFilters">
          <i class="las la-sync mr-1 ml-1"></i> Reset Filters
        </v-btn>
        <v-btn type="submit" class="apply-btn-bottom">
          <i class="las la-filter mr-1 ml-1"></i> Apply Filters
        </v-btn>
      </div>
    </form>
  </v-card>
</template>

<script setup lang="ts">
import { ref, watch, computed, defineProps, defineEmits } from "vue";

const props = defineProps<{
  customerTypes: { name: string, count: number }[];
  customerStatuses: { name: string, count: number }[];
  filters: {
    customer_type: string;
    customer_status: string;
    order_by_name: string;
    order_by_param: string;
    purchases_min_amount: number| null;
    purchases_max_amount: number| null;
    receivables_min_amount: number| null;
    receivables_max_amount: number| null;
  };
}>();

const sortOptions = [
  {
    text: "First Name By ASC",
    value: { order_by_name: "first_name", order_by_param: "asc" },
  },
  {
    text: "First Name By DESC",
    value: { order_by_name: "first_name", order_by_param: "desc" },
  },
  {
    text: "Last Name By ASC",
    value: { order_by_name: "last_name", order_by_param: "asc" },
  },
  {
    text: "Last Name By DESC",
    value: { order_by_name: "last_name", order_by_param: "desc" },
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

const selectedCustomerType = ref(props.filters.customer_type);
const selectedCustomerStatus = ref(props.filters.customer_status);
const purchasesMinAmount = ref(props.filters.purchases_min_amount);
const purchasesMaxAmount = ref(props.filters.purchases_max_amount);
const receivablesMinAmount = ref(props.filters.receivables_min_amount);
const receivablesMaxAmount = ref(props.filters.receivables_max_amount);
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
    selectedCustomerType.value = newFilters.customer_type;
    selectedCustomerStatus.value = newFilters.customer_status;
    purchasesMinAmount.value = newFilters.purchases_min_amount;
    purchasesMaxAmount.value = newFilters.purchases_max_amount;
    receivablesMinAmount.value = newFilters.receivables_min_amount;
    receivablesMaxAmount.value = newFilters.receivables_max_amount;
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
    customer_type: selectedCustomerType.value,
    customer_status: selectedCustomerStatus.value,
    purchases_min_amount: purchasesMinAmount.value,
    purchases_max_amount: purchasesMaxAmount.value,
    receivables_min_amount: receivablesMinAmount.value,
    receivables_max_amount: receivablesMaxAmount.value,
    order_by_name: sortOption.value.value.order_by_name,
    order_by_param: sortOption.value.value.order_by_param,
  });
};

const resetFilters = () => {
  selectedCustomerType.value = "";
  selectedCustomerStatus.value = "";
  purchasesMinAmount.value = null;
  purchasesMaxAmount.value = null;
  receivablesMinAmount.value = null;
  receivablesMaxAmount.value = null;
  sortOption.value = sortOptions[0];
  applyFilters();
};

const handleTypeChange = (typeName: string) => {
  selectedCustomerType.value = typeName;
};

const handleStatusChange = (statusName: string) => {
  selectedCustomerStatus.value = statusName;
};
</script>
