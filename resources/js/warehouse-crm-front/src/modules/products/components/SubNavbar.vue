<template>
  <v-row class="sub-navbar" no-gutters>
    <v-col cols="3">
      <div class="d-flex flex-row">
        <h3 class="title-page text-h4 font-weight-bold">Product</h3>
        <div class="rounded-pill score-pill mt-8">
          <span class="score-pill-number">{{ props.total_products }}</span>
          <span class="score-pill-text">total products</span>
        </div>
      </div>
    </v-col>
    <v-col cols="9" class="pt-3">
      <v-row no-gutters>
        <v-col cols="8" class="ps-12">
          <form @submit.prevent="handleSearch" class="pt-3 search-form">
            <div class="d-flex flex-row justify-center">
              <v-btn type="submit" class="search-bar-btn">
                <i class="las la-search"></i>
              </v-btn>
              <input
                type="search"
                class="search-input mr-6"
                id="search-input"
                name="search_product"
                placeholder="Search product..."
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
        <v-col cols="4">
          <div class="d-flex flex-row justify-end pe-5 subnav-btn-block">
            <v-btn class="sub-navbar-btn" @click="handleOpenHelpDialog">
              <i class="las la-headphones pr-1"></i>Contact Help
            </v-btn>
            <RouterLink to="/add-product" class="link-style-disabled">
              <v-btn class="sub-navbar-btn">Add Product</v-btn>
            </RouterLink>
          </div>
        </v-col>
      </v-row>
    </v-col>
    <ContactHelpDialog
    :isOpen="isHelpDialogOpen"
    @update:isOpen="isHelpDialogOpen = $event"
  />
  </v-row>
</template>

<script setup lang="ts">
import { ref, defineEmits, watch, defineProps } from 'vue';
import debounce from 'lodash.debounce';
import ContactHelpDialog from  '@/modules/support/components/ContactHelpDialog.vue';

const props = defineProps<{
  total_products: number;
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

</script>

<style scoped>
.clear-search-btn {
  color: #aaa;
  background: transparent;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
}
.clear-search-btn:hover {
  color: #333;
}
</style>
