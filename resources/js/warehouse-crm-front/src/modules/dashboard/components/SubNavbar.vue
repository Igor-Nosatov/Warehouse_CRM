<template>
  <v-row class="sub-navbar" no-gutters>
    <v-col cols="3">
      <div class="d-flex flex-row">
        <h3 class="title-page text-h4 font-weight-bold">Dashboard</h3>
      </div>
    </v-col>
    <v-col cols="9" class="pt-4 pr-3">
      <div class="d-flex justify-end">
        <v-btn class="wr-primary-btn me-3" @click="openHelpDialog">
          <i class="las la-headphones pr-1"></i>Contact Help
        </v-btn>
        <v-menu>
          <template v-slot:activator="{ props }">
            <v-btn rounded class="wr-primary-btn" v-bind="props">
              Quick Action
              <i class="las la-caret-down"></i>
            </v-btn>
          </template>
          <v-list class="dropdown_list">
            <v-list-item
              v-for="(item, index) in items"
              :key="index"
              @click="openQuickActionDialog(item.title)"
            >
              <v-list-item-title>
                <i :class="item.icon"></i>
                {{ item.title }}
              </v-list-item-title>
              <v-divider></v-divider>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>
    </v-col>
    <QuickActionDialog
      :isOpen="isQuickActionDialogOpen"
      :title="quickActionTitle"
      @update:isOpen="isQuickActionDialogOpen = $event"
    />

    <ContactHelpDialog
      :isOpen="isHelpDialogOpen"
      @update:isOpen="isHelpDialogOpen = $event"
    />
  </v-row>
</template>

<script setup lang="ts">
import { ref } from "vue";
import QuickActionDialog from "@/modules/dashboard/components/QuickActionDialog.vue";
import ContactHelpDialog from  '@/modules/support/components/ContactHelpDialog.vue';

const items = ref([
  { title: "Report", icon: "las la-chart-line" },
  { title: "Product Price", icon: "las la-file-alt" },
]);

const isHelpDialogOpen = ref(false);
const helpIssueTitle = ref("");
const helpIssueDescription = ref("");

const isQuickActionDialogOpen = ref(false);
const quickActionTitle = ref("");

const openHelpDialog = () => {
  isHelpDialogOpen.value = true;
};

const openQuickActionDialog = (title: string) => {
  quickActionTitle.value = title;
  isQuickActionDialogOpen.value = true;
};
</script>
