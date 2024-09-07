<template>
  <v-row class="sub-navbar" no-gutters>
    <v-col cols="3">
      <div class="d-flex flex-row">
        <h4 class="title-page text-h4 font-weight-bold">Customer</h4>
        <div class="rounded-pill score-pill mt-8">
          <span class="score-pill-number">{{ props.totalCustomers }}</span>
          <span class="score-pill-text">Total customer</span>
        </div>
      </div>
    </v-col>
    <v-col cols="9" class="pt-3">
      <v-row no-gutters>
        <v-col cols="8" class="ps-12">
          <form @submit.prevent="handleSearch" class="search-form pt-3">
            <div class="d-flex flex-row justify-center search-wrapper">
              <v-btn type="submit" class="search-bar-btn">
                <i class="las la-search"></i>
              </v-btn>
              <input
                type="search"
                class="search-input mr-6"
                id="search-input"
                name="search_product"
                placeholder="Search customer by full name..."
                autocomplete="off"
                v-model="search"
                @input="handleInput"
              />
              <v-btn
                v-if="search"
                @click="clearSearch"
                class="clear-search-btn"
              >
                <i class="las la-times"></i>
              </v-btn>
            </div>
          </form>
        </v-col>
        <v-col cols="4" class="ps-12">
          <div class="d-flex justify-end flex-row pe-5">
            <v-btn class="sub-navbar-btn" @click="handleOpenHelpDialog">
              <i class="las la-headphones pr-1"></i>Contact Help
            </v-btn>
            <v-btn class="sub-navbar-btn" @click="handleOpenCustomerCreateForm"
              >Add Customer</v-btn
            >
          </div>
        </v-col>
      </v-row>
    </v-col>
    <CreateCustomer
      :isOpen="isCustomerCreateFormOpen"
      @close="closeCustomerCreateFormOpen"
    />
    <ContactHelpDialog
      :isOpen="isHelpDialogOpen"
      @update:isOpen="isHelpDialogOpen = $event"
    />
  </v-row>
</template>

<script setup lang="ts">
import { ref, defineEmits, watch, defineProps  } from "vue";
import CreateCustomer from "@/modules/customer/components/modal-box/CreateCustomer.vue";
import ContactHelpDialog from '@/modules/support/components/ContactHelpDialog.vue';
import debounce from 'lodash.debounce';

const props = defineProps<{
  totalCustomers: number,
}>();

const emit = defineEmits(['search-changed']);

const search = ref('');

const handleSearch = () => {
  emit('search-changed', search.value);
};

const debouncedSearch = debounce(handleSearch, 300);

const handleInput = () => {
  debouncedSearch();
};

const clearSearch = () => {
  search.value = '';
  handleSearch();
};

watch(search, (newSearch) => {
  if (newSearch === '') {
    handleSearch();
  }
});

const isHelpDialogOpen = ref(false);
const handleOpenHelpDialog = () => {
  isHelpDialogOpen.value = true;
};

const isCustomerCreateFormOpen = ref(false);

const handleOpenCustomerCreateForm = () => {
  isCustomerCreateFormOpen.value = true;
};

const closeCustomerCreateFormOpen = () => {
  isCustomerCreateFormOpen.value = false;
};

</script>
