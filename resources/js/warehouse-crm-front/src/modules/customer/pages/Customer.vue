<template>
  <v-row no-gutters>
    <v-col cols="12" >
      <SubNavbar @search-changed="handleSearchChange" :total-customer="customerStore.meta.total" />
    </v-col>
    <v-col cols="3" class="ps-4 pe-4 pt-6">
      <Sidebar
        :customerTypes="customerFiltersStore.customerTypes"
        :customerStatuses="customerFiltersStore.customerStatuses"
        :filters="currentFilters"
        @filters-changed="applyFilters"
        @search-changed="handleSearchChange"
      />
    </v-col>
    <v-col cols='9' class="ps-4 pe-4 pt-9">
      <v-row no-gutters>
        <v-col cols='12' v-for='customer in customerStore.customers' :key='customer.id' class='pb-3'>
          <CustomerCard
            :customer="customer"
            :customerPhoto="client_photo"
            @view-detail="handleDetailCustomer"
            @edit="handleEditCustomer"
            @delete="handleDeleteCustomer"
          />
        </v-col>
      </v-row>
    </v-col>
    <v-col offset="3" cols="9" class="pt-6 pb-12">
      <Pagination
        :current-page='customerStore.meta.current_page'
        :last-page='customerStore.meta.last_page'
        @page-changed='fetchPage'
      />
    </v-col>
    <v-col cols='12'>
      <CustomerDetail :is-open='isCustomerDetailOpen' :customerId='selectedCustomerId' @close='closeCustomerDetail' />
    </v-col>
    <v-col cols='12'>
      <EditCustomer :is-open='isCustomerEditFormOpen' @close='closeCustomerEditForm' :customer-id='selectedCustomerId' />
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useCustomerStore } from '@/modules/customer/store/useCustomerStore';
import { useCustomerFiltersStore } from '@/modules/customer/store/useCustomerFiltersStore';
import SubNavbar from '@/modules/customer/components/SubNavbar.vue';
import Sidebar from '@/modules/customer/components/Sidebar.vue';
import Pagination from '@/modules/products/components/Pagination.vue';
import CustomerDetail from '@/modules/customer/components/modal-box/CustomerDetail.vue';
import EditCustomer from '@/modules/customer/components/modal-box/EditCustomer.vue';
import CustomerCard from '@/modules/customer/components/CustomerCard.vue';
import client_photo from '@/assets/client_photo.png';

const customerStore = useCustomerStore();
const customerFiltersStore = useCustomerFiltersStore();

const currentFilters = ref({
  search: '',
  customer_type: '',
  customer_status: '',
  order_by_name: 'first_name',
  order_by_param: 'desc',
  purchases_min_amount: null,
  purchases_max_amount: null,
  receivables_min_amount: null,
  receivables_max_amount: null,
});

const handleSearchChange = (search: string) => {
  currentFilters.value.search = search;
  applyFilters(currentFilters.value);
  fetchPage(1);
};

const fetchPage = async (page) => {
  const params: any = { page, ...currentFilters.value };
  for (const key in params) {
    if (params[key] === '' || params[key] === undefined || params[key] === null|| params[key] === 0) {
      delete params[key];
    }
  }
  await customerStore.fetchCustomers(params);
};

onMounted(async () => {
  await fetchPage(1);
  await customerFiltersStore.fetchCustomerFilters();
});

const applyFilters = async (filters) => {
  currentFilters.value = filters;
  await fetchPage(1);
};

const handleDeleteCustomer = async (customerId) => {
  await customerStore.deleteCustomer(customerId);
  await fetchPage(1);
};

const isCustomerDetailOpen = ref(false);
const isCustomerEditFormOpen = ref(false);
const selectedCustomerId = ref<number | null>(null);

const closeCustomerDetail = () => {
  isCustomerDetailOpen.value = false;
};
const closeCustomerEditForm = () => {
  isCustomerEditFormOpen.value = false;
};

const handleDetailCustomer = (customerId: number) => {
  selectedCustomerId.value = customerId;
  isCustomerDetailOpen.value = true;
};
const handleEditCustomer = (customerId: number) => {
  selectedCustomerId.value = customerId;
  isCustomerEditFormOpen.value = true;
};
</script>
