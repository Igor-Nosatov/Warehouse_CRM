v<template>
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
      <h3 class="ps-3 pt-3 pb-2 filter-title">Product Status</h3>
      <v-row  no-gutters class="pb-3 ps-2">
        <v-col cols="6" class="d-flex justify-center" v-for="status in product_status" :key="status.id">
          <input
            type="radio"
            name="accept-status"
            :id="`status-${status.id}`"
            class="hidden radio-label"
            v-model="selectedProductStatus"
            :value="status.id"
          />
          <label :for="`status-${status.id}`" class="button-label" :class="{ 'active': selectedProductStatus === status.id }">
            <div class="d-flex justify-space-between">
              <div class="pt-2">{{ status.name }}</div>
              <div class="status-score">
                <span class="status-score-data"> {{ status.products_count }}</span>
              </div>
            </div>
          </label>
        </v-col>
      </v-row>
      <h3 class="ps-3 pt-3 pb-2 filter-title">Product Type</h3>
      <v-row  no-gutters class="pb-3 ps-2">
        <v-col cols="6" class="d-flex justify-center" v-for="type in product_type" :key="type.id">
          <input
            type="radio"
            name="product-type"
            :id="`type-${type.id}`"
            class="hidden radio-label"
            v-model="selectedProductType"
            :value="type.id"
          />
          <label :for="`type-${type.id}`" class="button-label" :class="{ 'active': selectedProductType === type.id }">
            <div class="d-flex justify-space-between">
              <div class="pt-2">{{ type.name }}</div>
              <div class="status-score"><span class="status-score-data">
                {{ type.products_count }}</span></div>
            </div>
          </label>
        </v-col>
      </v-row>
      <h3 class="ps-3 pt-3 pb-3 filter-title">Category</h3>
      <div class="pe-3">
        <div class="ps-3 select-wrapper-category">
          <select class="ps-3 select-btn" v-model="selectedCategory">
            <option value="" selected>All Category</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }} ({{ category.products_count }})
            </option>
          </select>
          <i class="ms-3 las la-cubes"></i>
        </div>
      </div>
      <h3 class="ps-3 pb-3 filter-title">Brand</h3>
      <div class="pe-3">
        <div class="ps-3 select-wrapper-brand">
          <select class="ps-3 select-btn" v-model="selectedBrand">
            <option value="" selected>All Brand</option>
            <option v-for="brand in brands" :key="brand.id" :value="brand.id">
              {{ brand.name }} ({{ brand.products_count }})
            </option>
          </select>
          <i class="ms-3 las la-globe"></i>
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
            v-model.number="min_price"
            min="1"
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
            v-model.number="max_price"
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
import { ref, defineProps, defineEmits, watch } from 'vue';

const props = defineProps<{
  brands: [];
  categories: [];
  product_type:[];
  product_status:[];
  loading: boolean;
  error: string | null;
  filters: {
    product_status: string;
    product_type: string;
    category: string;
    brand: string;
    min_price: number| null;
    max_price: number| null;
  };
}>();

const emit = defineEmits(['filters-changed', 'search-changed']);

const selectedProductStatus = ref(props.filters.product_status);
const selectedProductType = ref(props.filters.product_type);
const selectedCategory = ref(props.filters.category);
const selectedBrand = ref(props.filters.brand);
const min_price = ref(props.filters.min_price);
const max_price = ref(props.filters.max_price);
const search = ref('');

watch(() => props.filters, (newFilters) => {
  selectedProductStatus.value = newFilters.product_status;
  selectedProductType.value = newFilters.product_type;
  selectedCategory.value = newFilters.category;
  selectedBrand.value = newFilters.brand;
  min_price.value = newFilters.min_price;
  max_price.value = newFilters.max_price;
}, { immediate: true });


const applyFilters = () => {
  emit('filters-changed', {
    product_status: selectedProductStatus.value,
    product_type: selectedProductType.value,
    category: selectedCategory.value,
    brand: selectedBrand.value,
    min_price: min_price.value,
    max_price: max_price.value,
    search: search.value
  });
};

const resetFilters = () => {
  selectedProductStatus.value = '';
  selectedProductType.value = '';
  selectedCategory.value = '';
  selectedBrand.value = '';
  min_price.value = 0;
  max_price.value = 0;
  search.value = '';
  applyFilters();
  emit('filters-changed', {
    product_status: '',
    product_type: '',
    category: '',
    brand: '',
    min_price: '',
    max_price: '',
    search: ''
  });
};
</script>
