<template>
  <v-row class="sub-navbar" no-gutters>
    <v-col cols="3">
      <div class="d-flex flex-row">
        <h3 class="title-page text-h4 font-weight-bold">Sales Order</h3>
        <div class="rounded-pill score-pill mt-8">
          <span class="score-pill-number">{{ props.totalSales }}</span>
          <span class="score-pill-text">total sales</span>
        </div>
      </div>
    </v-col>
    <v-col cols="9" class="pt-3">
      <v-row no-gutters>
        <v-col cols="8" class="ps-12">
        </v-col>
        <v-col cols="4" class="ps-12">
          <div class="d-flex justify-end flex-row pe-5">
            <v-btn class="sub-navbar-btn" @click="handleOpenHelpDialog">
              <i class="las la-headphones pr-1"></i>Contact Help
            </v-btn>
            <v-btn
              class="sub-navbar-btn"
              @click="handleOpenSalesOrderCreateForm"
              >Add New Order</v-btn
            >
          </div>
        </v-col>
      </v-row>
    </v-col>
    <CreateSalesOrder
      :isOpen="isSalesOrderCreateFormOpen"
      @close="closeSalesOrderCreateFormOpen"
    />
    <ContactHelpDialog
      :isOpen="isHelpDialogOpen"
      @update:isOpen="isHelpDialogOpen = $event"
    />
  </v-row>
</template>

<script setup lang="ts">
import { ref, defineEmits, watch, defineProps } from "vue";
import CreateSalesOrder from "@/modules/salesOrder/components/modal-box/CreateSalesOrder.vue";
import ContactHelpDialog from  '@/modules/support/components/ContactHelpDialog.vue';

const props = defineProps<{
  totalSales: number,
}>();

const isHelpDialogOpen = ref(false);
const handleOpenHelpDialog = () => {
  isHelpDialogOpen.value = true;
};

const isSalesOrderCreateFormOpen = ref(false);

const handleOpenSalesOrderCreateForm = () => {
  isSalesOrderCreateFormOpen.value = true;
};

const closeSalesOrderCreateFormOpen = () => {
  isSalesOrderCreateFormOpen.value = false;
};
</script>
