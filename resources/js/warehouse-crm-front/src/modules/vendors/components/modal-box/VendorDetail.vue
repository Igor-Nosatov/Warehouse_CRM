<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick">
    <div class="modal-form vendor-detail-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="12" class="pt-2 pb-4">
          <v-btn class="close-btn" @click="emitClose">
            <i class="las la-times fs-2"></i>
          </v-btn>
        </v-col>
        <v-col cols="12" class="pt-4 pb-4 ps-1">
          <h3 class="primary-text text-uppercase">Globex-Corp</h3>
        </v-col>
        <v-col cols="12">
          <div class="tab-navigation d-flex flex-row">
            <button
              class="tab-navigation-btn"
              :class="{ tab_navigation_btn_active: activeOpenTab === 1 }"
              @click="openTab(1)"
            >
              General Information
            </button>
          </div>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col cols="12" v-if="activeOpenTab === 1" class="tab ps-6">
          <template v-if="vendorStore.vendor">
            <v-row no-gutters>
              <v-col cols="6" class="ps-2">
                <h3 class="text-capitalize primary-text pb-2 pt-4">Details</h3>

                <v-row no-gutters class="pt-2 pb-2">
                  <v-col cols="3">
                    <p class="text-uppercase secondary-text-1">Customer Type</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text">
                      {{ vendorStore.vendor.vendor_type }}
                    </p>
                  </v-col>
                </v-row>
                <v-row no-gutters class="pt-2 pb-2">
                  <v-col cols="3">
                    <p class="text-uppercase secondary-text-1">Company Name</p>
                  </v-col>
                  <v-col cols="4">
                    <p class="secondary-text">
                      {{ vendorStore.vendor.company_name }}
                    </p>
                  </v-col>
                </v-row>
                <v-row no-gutters class="pt-2 pb-2">
                  <v-col cols="3">
                    <p class="text-uppercase secondary-text-1">Status</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text">
                      {{ vendorStore.vendor.status ? "Active" : "Inactive" }}
                    </p>
                  </v-col>
                </v-row>
                <v-row no-gutters class="pt-2 pb-2">
                  <v-col cols="3">
                    <p class="text-uppercase secondary-text-1">Remark</p>
                  </v-col>
                  <v-col cols="7">
                    <p class="secondary-text">
                      {{ vendorStore.vendor.remark }}
                    </p>
                  </v-col>
                  <v-card class="mt-2 mb-2 address-card">
                    <p class="text-capitalize">Billing Address</p>
                    <p class="secondary-text-1 pt-2">
                      {{ vendorStore.vendor.location }}
                    </p>
                  </v-card>
                  <v-card class="mt-2 mb-2 address-card">
                    <p class="text-capitalize">Shipping Address</p>
                    <p class="secondary-text-1 pt-2">
                      {{ vendorStore.vendor.location }}
                    </p>
                  </v-card>
                </v-row>
              </v-col>
              <v-col cols="6">
                <h3 class="text-capitalize primary-text pb-2 pt-4">
                  Contact Information
                </h3>
                <v-row no-gutters class="pt-2 pb-2">
                  <v-col cols="3">
                    <p class="text-uppercase secondary-text-1">Phone</p>
                  </v-col>
                  <v-col cols="5">
                    <p class="secondary-text">{{ vendorStore.vendor.phone }}</p>
                  </v-col>
                </v-row>
                <v-row no-gutters class="pt-2 pb-2">
                  <v-col cols="3">
                    <p class="text-uppercase secondary-text-1">Email</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text">{{ vendorStore.vendor.email }}</p>
                  </v-col>
                </v-row>
                <v-row no-gutters class="pt-2 pb-2">
                  <v-col cols="3">
                    <p class="text-uppercase secondary-text-1">Website</p>
                  </v-col>
                  <v-col cols="2">
                    <p class="secondary-text">
                      {{ vendorStore.vendor.website }}
                    </p>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </template>
          <template v-else>
            <p>Loading...</p>
          </template>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, onMounted } from "vue";
import { useVendorByIdStore } from "@/modules/vendors/store/useVendorByIdStore";

const props = defineProps({
  isOpen: Boolean,
  vendorId: Number,
});

const vendorStore = useVendorByIdStore();
const isLoading = ref(true);

onMounted(() => {
  vendorStore.fetchVendorById(props.vendorId).then(() => {
    isLoading.value = false;
  });
});

const emit = defineEmits(["close"]);

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = () => {
  emitClose();
};

const activeOpenTab = ref(1);

const openTab = (buttonId) => {
  activeOpenTab.value = buttonId;
};
</script>

<style scoped>
.vendor-detail-form {
  width: 1200px;
  height: 700px;
}

.block-package-status {
  border-radius: 15px;
  background-color: #303d44;
  height: auto;
}

.order-title,
.order-price {
  color: #fff;
  font: 25px "Nunito", sans-serif !important;
}

.order-price {
  position: relative;
  bottom: 7px;
}

.order-line-divider {
  height: 30px;
  width: 3px;
  background: #fff;
}

.reorder-progress-bar {
  margin-top: 25px;
  height: 4px;
  border-radius: 10px;
  width: 20%;
  background: #cbcccb;
}

.warehouse-location-title {
  position: relative;
  top: 2px;
}

.reorder-dot {
  position: relative;
  top: 5px;
  margin: 0px 3px;
  height: 10px;
  width: 10px;
  background: #00d26d;
  border-radius: 100%;
}

.warehouse-title {
  position: relative;
  bottom: 1px;
}

.package-status-subtitle {
  margin-top: 10px;
}

/*===================General Information==========================*/
.customer-photo {
  width: 80px;
  border-radius: 10px;
}

.cutomer-title,
.sales-order-title {
  color: #fff;
  font: 22px "Nunito", sans-serif;
  font-weight: 700;
}

.address-card {
  padding: 10px;
  color: #fff;
  border-radius: 10px;
  border: 1px solid #5c6869;
  background: #1c2e37;
}
</style>
