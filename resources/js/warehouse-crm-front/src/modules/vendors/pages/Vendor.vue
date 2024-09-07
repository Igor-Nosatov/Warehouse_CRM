<template>
  <v-row no-gutters>
    <v-col cols="12">
      <SubNavbar
        @search-changed="handleSearchChange"
        :total-vendor="vendorStore.meta.total"
      />
    </v-col>
    <v-col cols="3" class="ps-4 pe-4 pt-6">
      <Sidebar
        :vendorStatus="vendorFilterStore.vendorStatus"
        :vendorType="vendorFilterStore.vendorType"
        :filters="currentFilters"
        @filters-changed="applyFilters"
        @search-changed="handleSearchChange"
      />
    </v-col>
    <v-col cols="9" class="ps-4 pe-4 pt-7">
      <v-row no-gutters>
        <v-col
          cols="12"
          v-for="vendor in vendorStore.vendors"
          :key="vendor.id"
          class="pb-5"
        >
          <VendorCard
            :vendor="vendor"
            :handleDetailVendor="handleDetailVendor"
            :handleEditVendor="handleEditVendor"
            :handleDeleteVendor="handleDeleteVendor"
          />
        </v-col>
      </v-row>
    </v-col>
    <v-col offset="3" cols="9" class="pt-6 pb-12">
      <Pagination
        :current-page="vendorStore.meta.current_page"
        :last-page="vendorStore.meta.last_page"
        @page-changed="fetchPage"
      />
    </v-col>
    <v-col cols="12">
      <VendorDetail
        :is-open="isVendorDetailOpen"
        @close="closeVendorDetail"
        :vendor-id="selectedVendorId"
      />
    </v-col>
    <v-col cols="12">
      <EditVendor
        :is-open="isVendorEditFormOpen"
        @close="closeVendorEditForm"
        :vendor-id="selectedVendorId"
      />
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useVendorStore } from "@/modules/vendors/store/useVendorsStore";
import { useVendorsFilterStore } from "@/modules/vendors/store/useVendorsFilterStore";
import VendorDetail from "@/modules/vendors/components/modal-box/VendorDetail.vue";
import EditVendor from "@/modules/vendors/components/modal-box/EditVendor.vue";
import Sidebar from "@/modules/vendors/components/Sidebar.vue";
import Pagination from "@/modules/products/components/Pagination.vue";
import SubNavbar from "@/modules/vendors/components/SubNavbar.vue";
import VendorCard from "@/modules/vendors/components/VendorCard.vue";

const vendorStore = useVendorStore();
const vendorFilterStore = useVendorsFilterStore();
const currentFilters = ref({
  search: "",
  vendor_status: "",
  vendor_type: "",
  min_price: null,
  max_price: null,
  min_used_credits: null,
  max_used_credits: null,
  order_by_name: "company_name",
  order_by_param: "desc",
});

const applyFilters = async (filters: any) => {
  currentFilters.value = filters;
  await fetchPage(1);
};

const handleSearchChange = (search: string) => {
  currentFilters.value.search = search;
  applyFilters(currentFilters.value);
  fetchPage(1);
};

const fetchPage = async (page: number) => {
  const params: any = { page, ...currentFilters.value };
  for (const key in params) {
    if (
      params[key] === "" ||
      params[key] === undefined ||
      params[key] === null ||
      params[key] === 0
    ) {
      delete params[key];
    }
  }
  await vendorStore.fetchVendors(params);
};

onMounted(async () => {
  await fetchPage(1);
  await vendorFilterStore.fetchVendorFilters();
});

const handleDeleteVendor = async (id: number) => {
  await vendorStore.deleteVendor(id);
};

const isVendorDetailOpen = ref(false);
const isVendorEditFormOpen = ref(false);
const selectedVendorId = ref<number | null>(null);

const handleDetailVendor = (vendorId: number) => {
  selectedVendorId.value = vendorId;
  isVendorDetailOpen.value = true;
};

const handleEditVendor = (vendorId: number) => {
  selectedVendorId.value = vendorId;
  isVendorEditFormOpen.value = true;
};

const closeVendorDetail = () => {
  selectedVendorId.value = null;
  isVendorDetailOpen.value = false;
};

const closeVendorEditForm = () => {
  selectedVendorId.value = null;
  isVendorEditFormOpen.value = false;
};
</script>
