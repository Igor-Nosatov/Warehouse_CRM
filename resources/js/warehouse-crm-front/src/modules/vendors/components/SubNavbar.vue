<template>
  <v-row class="sub-navbar" no-gutters>
    <v-col cols="3">
      <div class="d-flex flex-row">
        <h4 class="title-page text-h4 font-weight-bold">Vendor</h4>
        <div class="rounded-pill score-pill mt-8">
          <span class="score-pill-number">1708</span>
          <span class="score-pill-text">Total customer</span>
        </div>
      </div>
    </v-col>
    <v-col cols="9" class="pt-3">
      <v-row no-gutters>
        <v-col cols="8" class="ps-12">
          <form @submit.prevent="handleSearch" class="pt-3 search-form">
            <div class="d-flex flex-row justify-center search-wrapper">
              <v-btn type="submit" class="search-bar-btn">
                <i class="las la-search"></i>
              </v-btn>
              <input
                type="search"
                class="search-input mr-6"
                id="search-input"
                name="search"
                placeholder="Search by vendor company name..."
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
            <v-btn class="sub-navbar-btn" @click="handleOpenVendorCreateForm"
              >Add Vendor</v-btn
            >
          </div>
        </v-col>
      </v-row>
    </v-col>
    <CreateVendor
      :isOpen="isVendorCreateFormOpen"
      @close="closeVendorCreateFormOpen"
    />
    <ContactHelpDialog
      :isOpen="isHelpDialogOpen"
      @update:isOpen="isHelpDialogOpen = $event"
    />
  </v-row>
</template>

<script setup lang="ts">
import { ref, defineEmits, watch, defineProps } from "vue";
import CreateVendor from "@/modules/vendors/components/modal-box/CreateVendor.vue";
import ContactHelpDialog from  '@/modules/support/components/ContactHelpDialog.vue';
import debounce from 'lodash.debounce';

const props = defineProps<{
  total_vendors: number,
}>();

const emit = defineEmits(["search-changed"]);

const search = ref("");

const handleSearch = () => {
  emit("search-changed", search.value);
};

const debouncedSearch = debounce(handleSearch, 300);

const handleInput = () => {
  debouncedSearch();
};

const clearSearch = () => {
  search.value = "";
  handleSearch();
};

watch(search, (newSearch) => {
  if (newSearch === "") {
    handleSearch();
  }
});

const isHelpDialogOpen = ref(false);
const handleOpenHelpDialog = () => {
  isHelpDialogOpen.value = true;
};

const isVendorCreateFormOpen = ref(false);

const handleOpenVendorCreateForm = () => {
  isVendorCreateFormOpen.value = true;
};

const closeVendorCreateFormOpen = () => {
  isVendorCreateFormOpen.value = false;
};
</script>

<style scoped>
</style>
