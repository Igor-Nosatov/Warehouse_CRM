<template>
  <v-dialog
    v-model="isOpen"
    class="modal-backdrop"
    @click="handleBackdropClick"
  >
    <div class="modal-form product-detail-form" @click.stop>
      <v-row no-gutters class="pb-12 ps-6" v-if="product">
        <v-col cols="12" class="pt-2 pb-4">
          <v-btn class="close-btn" @click="emitClose">
            <i class="las la-times fs-2"></i>
          </v-btn>
        </v-col>
        <v-col cols="12" class="pt-4 pb-4 ps-1">
          <h3 class="title-text">{{ product.title }}</h3>
          <div class="d-flex flex-row pt-2 pb-2">
            <p class="secondary-text pe-2">SKU: {{ product.sku }}</p>
            <div class="dot-for-modal-content1 me-2"></div>
            <p class="secondary-text pe-2">
              Category:{{ product.category.name }}
            </p>
            <div class="dot-for-modal-content2 me-2"></div>
            <i class="las la-box-open icon-size pe-2"></i>
            <p class="secondary-text pe-2 product-status">
              Type:{{ product.product_type.name }}
            </p>
          </div>
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
            <button
              class="tab-navigation-btn"
              :class="{ tab_navigation_btn_active: activeOpenTab === 2 }"
              @click="openTab(2)"
            >
              History
            </button>
            <button
              class="tab-navigation-btn"
              :class="{ tab_navigation_btn_active: activeOpenTab === 3 }"
              @click="openTab(3)"
            >
              Notes
            </button>
            <button
              class="tab-navigation-btn"
              :class="{ tab_navigation_btn_active: activeOpenTab === 4 }"
              @click="openTab(4)"
            >
              Product Stock
            </button>
          </div>
        </v-col>
      </v-row>
      <v-row no-gutters v-if="product">
        <v-col cols="12" v-if="activeOpenTab === 1" class="tab">
          <v-row no-gutters>
            <v-col cols="3">
              <img :src="nike" alt="" class="img-product-detail" />
            </v-col>
            <v-col cols="9">
              <v-row no-gutters>
                <v-col cols="12" class="ps-4">
                  <h4 class="card-detail-title text-capitalize pt-7 pb-3">
                    Sales Information
                  </h4>
                </v-col>
                <v-col cols="6" class="ps-4">
                  <v-row no-gutters>
                    <v-col cols="6">
                      <p class="item-field-name">Retail price</p>
                      <p class="item-field-name">Margin(%)</p>
                      <p class="item-field-name">Profit</p>
                    </v-col>
                    <v-col cols="6">
                      <p class="item-field-desc">
                        ${{ product?.retail_price }}
                      </p>
                      <p class="item-field-desc">35%</p>
                      <p class="item-field-desc">
                        ${{ (product?.retail_price * 0.35).toFixed(2) }}
                      </p>
                    </v-col>
                  </v-row>
                  <v-row no-gutters>
                    <v-col cols="12">
                      <v-btn class="mt-4 compare-btn">Product Compare</v-btn>
                    </v-col>
                  </v-row>
                </v-col>
                <v-col cols="6" class="ps-6">
                  <v-row no-gutters>
                    <v-col cols="6">
                      <p class="item-field-name">Wholesale price</p>
                      <p class="item-field-name">Margin(%)</p>
                      <p class="item-field-name">Profit</p>
                    </v-col>
                    <v-col cols="6">
                      <p class="item-field-desc">
                        ${{ product?.wholesale_price }}
                      </p>
                      <p class="item-field-desc">35%</p>
                      <p class="item-field-desc">
                        ${{ (product?.retail_price * 0.35).toFixed(2) }}
                      </p>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="12">
              <v-row no-gutters>
                <v-col cols="6" class="ps-7">
                  <h4 class="card-detail-title text-capitalize pb-3">
                    Basic Information
                  </h4>
                  <v-row no-gutters class="overflow-y-auto" max-height="100">
                    <v-col cols="6">
                      <p class="item-field-name">Total be packed</p>
                      <p class="item-field-name">Category</p>
                      <p class="item-field-name">Barcode</p>
                      <p class="item-field-name">Status</p>
                      <p class="item-field-name">Created at</p>
                      <p class="item-field-name">Updated at</p>
                    </v-col>
                    <v-col cols="6">
                      <p class="item-field-desc">Stocked product</p>
                      <p class="item-field-desc">{{ product.category.name }}</p>
                      <p class="item-field-desc">{{ product.barcode }}</p>
                      <p class="item-field-desc">
                        {{ product.product_status.name }}
                      </p>
                      <p class="item-field-desc">
                        {{ format(new Date(product.created_at), "MM/dd/yyyy") }}
                      </p>
                      <p class="item-field-desc">
                        {{ format(new Date(product.updated_at), "MM/dd/yyyy") }}
                      </p>
                    </v-col>
                  </v-row>
                </v-col>
                <v-col cols="6" class="pb-4 ps-6">
                  <h4 class="card-detail-title text-capitalize pb-3">
                    Measurement
                  </h4>
                  <v-row no-gutters>
                    <v-col cols="6">
                      <p class="item-field-name">width</p>
                      <p class="item-field-name">height</p>
                      <p class="item-field-name">weight</p>
                    </v-col>
                    <v-col cols="6">
                      <p class="item-field-desc">
                        {{ product.attribute.width }} cm
                      </p>
                      <p class="item-field-desc">
                        {{ product.attribute.height }} cm
                      </p>
                      <p class="item-field-desc">
                        {{ product.attribute.weight }} gr
                      </p>
                    </v-col>
                  </v-row>
                  <h4 class="card-detail-title text-capitalize pt-7 pb-2">
                    Purchase Information
                  </h4>
                  <v-row no-gutters>
                    <v-col cols="6">
                      <p class="item-field-name">purchase cost</p>
                    </v-col>
                    <v-col cols="6">
                      <p class="item-field-desc">${{ product.cost }}</p>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12" v-if="activeOpenTab === 2" class="tab scrollable">
          <div class="history-data-block ms-8">
            <v-row
              no-gutters
              v-for="history in product.product_histories"
              :key="history.id"
            >
              <v-col cols="1">
                <div class="d-flex flex-column">
                  <div class="history-tab-point-outside ms-7 mt-1">
                    <div class="history-tab-point-inside"></div>
                  </div>
                  <div class="history-tab-vertical-line ms-12 mt-1"></div>
                </div>
              </v-col>
              <v-col cols="11" class="pt-1">
                <p class="history-date-title mb-2">
                  {{ format(new Date(history.created_at), "MM/dd/yyyy") }}
                </p>
                <p class="primary-text pb-2">
                  {{ history.action || "No description available" }}
                </p>
                <p class="secondary-text pb-2">{{ history.user.name }}</p>
              </v-col>
            </v-row>
          </div>
        </v-col>
        <v-col cols="12" v-if="activeOpenTab === 3" class="tab">
          <v-row no-gutters class="pb-5">
            <v-col cols="12">
              <form
                @submit.prevent="submitForm(product.id)"
                class="d-flex flex-column"
              >
                <p class="primary-text note-title ps-7 text-capitalize">
                  Add new notes
                </p>
                <textarea
                  v-model="noteText"
                  name="note"
                  id="note"
                  cols="30"
                  rows="10"
                  class="notes-textarea mb-3"
                ></textarea>
                <v-btn type="submit" class="wr-primary-btn mt-5 ms-7"
                  >Add notes</v-btn
                >
              </form>
            </v-col>
            <v-card
              class="overflow-y-auto overflow-card mt-10 ms-6"
              height="310"
            >
              <v-col
                v-for="productNote in notes"
                :key="productNote.id"
                cols="12"
                class="pt-12 ps-7"
              >
                <v-card class="note-card">
                  <div class="d-flex flex-row pb-4">
                    <img :src="client_photo" alt="" class="note-card-img" />
                    <div class="d-flex flex-column ps-3">
                      <h4 class="primary-text">{{ productNote.user.name }}</h4>
                      <p class="primary-text">
                        {{
                          format(new Date(productNote.created_at), "MM/dd/yyyy")
                        }}
                      </p>
                    </div>
                  </div>
                  <p class="secondary-text note-card-desc pt-4">
                    {{ productNote.notes || "No description available" }}
                  </p>
                </v-card>
              </v-col>
            </v-card>
          </v-row>
        </v-col>
        <v-col cols="12" v-if="activeOpenTab === 4" class="tab">
          <v-row no-gutters class="ps-6">
            <v-col cols="6" class="pe-6">
              <h4 class="card-detail-title text-capitalize pt-7 pb-3">Stock</h4>
              <v-card class="stock-card">
                <v-row no-gutters>
                  <v-col cols="12" class="d-flex flex-column justify-center">
                    <p class="secondary-text text-center pt-2 pb-1">Total</p>
                    <h4 class="title-text text-center pt-1 pb-1">
                      {{ totalStockQuantity }}
                    </h4>
                    <div class="d-flex flex-row justify-center pt-2 pb-4">
                      <v-btn class="adjust-btn" @click="openModalAdjustStock"
                        >Adjust Stock</v-btn
                      >
                    </div>
                  </v-col>
                </v-row>
                <v-row
                  no-gutters
                  class="product-stock-card pt-4 pb-4"
                  v-for="adjustStock in adjustStockData.stock"
                  :key="adjustStock.id"
                >
                  <v-col cols="6" class="d-flex flex-row">
                    <div
                      class="dot-for-modal-content3 me-2 warehouse-title"
                    ></div>
                    <p class="secondary-text violet-color warehouse-title">
                      {{ adjustStock.warehouse.name }}
                    </p>
                  </v-col>
                  <v-col cols="1" offset="5">
                    <p class="primary-text qty-product-stock">
                      {{ adjustStock.product_quantity }}
                    </p>
                  </v-col>
                </v-row>
              </v-card>
            </v-col>
            <v-col cols="6">
              <h4 class="card-detail-title text-capitalize pt-7 pb-3">
                Reorder Points
              </h4>
              <v-card class="stock-card">
                <v-row
                  no-gutters
                  class="pb-4 pt-4"
                  v-for="latestAdjustment in adjustStockData.latest_adjustment"
                  :key="latestAdjustment.id"
                >
                  <v-col cols="12">
                    <div class="d-flex flex-row">
                      <i class="las la-map-marked-alt icon-size pe-2"></i>
                      <p class="primary-text pe-2">
                        {{ latestAdjustment.vendor.company_name }}
                      </p>
                      <div
                        class="dot-for-modal-content3 me-2 warehouse-title pe-2"
                      ></div>
                    </div>
                  </v-col>
                  <v-col cols="6" class="pb-3 pt-3">
                    <p class="secondary-text pb-1">Payment status</p>
                    <p class="primary-text">
                      {{ latestAdjustment.payment_status }}
                    </p>
                  </v-col>
                  <v-col cols="6" class="pb-3 pt-3">
                    <p class="secondary-text pb-1">Reason for inventory</p>
                    <p class="primary-text">
                      {{ latestAdjustment.reason_for_inventory }}
                    </p>
                  </v-col>
                  <v-col cols="6" class="pb-3">
                    <p class="secondary-text pb-1">Quantity available</p>
                    <p class="primary-text">
                      {{ latestAdjustment.quantity_available }}
                    </p>
                  </v-col>
                  <v-col cols="6" class="pb-3">
                    <p class="secondary-text pb-1">Reorder Quantity</p>
                    <p class="primary-text">
                      {{ latestAdjustment.new_quantity }}
                    </p>
                  </v-col>
                </v-row>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <AdjustStock
        :is-open-adjust-stock="isModalOpenAdjustStock"
        :productId="props.productId"
        :warehouseData="adjustStockData.warehouse_data"
        :vendorData="adjustStockData.vendors"
        @close="closeModalAdjustStock"
      />
    </div>
  </v-dialog>
</template>

<script setup lang="ts">
import { ref, watch, defineProps, defineEmits, computed, onMounted } from "vue";
import AdjustStock from "@/modules/products/components/AdjustStock.vue";
import nike from "@/assets/nike.jpg";
import client_photo from "@/assets/client_photo.png";
import { useProductDetailsStore } from "../store/useProductDetailsStore";
import { format } from "date-fns";
import { useProductNoteStore } from "@/modules/products/store/useProductNoteStore";
import { useAdjustStockStore } from "@/modules/products/store/useAdjustStockStore";

const props = defineProps({
  isOpen: Boolean,
  productId: Number,
});

const emit = defineEmits(["close"]);

const emitClose = () => {
  emit("close");
};

const handleBackdropClick = (event) => {
  emitClose();
};

const isOpen = ref(props.isOpen);

const activeOpenTab = ref(1);

const openTab = (buttonId: number) => {
  activeOpenTab.value = buttonId;
};

const isModalOpenAdjustStock = ref(false);

const openModalAdjustStock = () => {
  isModalOpenAdjustStock.value = true;
};

const closeModalAdjustStock = () => {
  isModalOpenAdjustStock.value = false;
};

const productDetailsStore = useProductDetailsStore();
const productNoteStore = useProductNoteStore();
const adjustStockStore = useAdjustStockStore();

watch(
  () => props.productId,
  (newProductId) => {
    if (newProductId) {
      productDetailsStore.fetchProductDetails(newProductId);
      productNoteStore.fetchNotes(newProductId);
      adjustStockStore
        .fetchAdjustStock(newProductId)
        .then(() => {})
        .catch((error) => {
          console.error("Error fetching adjust stock data:", error);
        });
    }
  }
);

const product = computed(() => productDetailsStore.product);
const noteText = ref("");
const userId = localStorage.getItem("userId");

const submitForm = (productId: number) => {
  if (noteText.value.trim() && userId) {
    productNoteStore
      .createNote({
        notes: noteText.value,
        product_id: productId,
        user_id: parseInt(userId),
      })
      .then(() => {
        productNoteStore.fetchNotes(props.productId);
        noteText.value = "";
      })
      .catch((error) => {
        console.error("Error creating note:", error);
      });
  }
};

onMounted(() => {
  if (props.productId) {
    productDetailsStore.fetchProductDetails(props.productId);
    productNoteStore.fetchNotes(props.productId);
    adjustStockStore
      .fetchAdjustStock(props.productId)
      .then(() => {})
      .catch((error) => {
        console.error("Error fetching adjust stock data on mount:", error);
      });
  }
});

const notes = computed(() => productNoteStore.notes);
const adjustStockData = computed(() => adjustStockStore.stockAdjustment);

const totalStockQuantity = computed(() => {
  return adjustStockData.value.stock.reduce(
    (total, item) => total + item.product_quantity,
    0
  );
});
</script>

<style scoped>
.product-detail-form {
  width: 1100px;
  margin-left: 550px;
}
.overflow-card {
  height: 300px !important;
}
/*===================General Info===================*/
.img-product-detail {
  width: 300px;
  height: 250px;
  padding: 30px 30px 30px 30px;
  border-radius: 50px !important;
}
.item-field-name {
  color: #5c6869;
  text-transform: uppercase;
  font: 16px "Nunito", sans-serif;
  font-weight: 700;
  padding: 5px 0px;
}
.item-field-desc {
  color: #fff;
  text-transform: capitalize;
  font: 16px "Nunito", sans-serif;
  font-weight: 400;
  padding: 5px 0px;
}

/*===================Product Stock==============================*/
.stock-card {
  background: #1e2830;
  border-radius: 10px;
  padding: 20px;
}
.product-stock-card {
  border-top: 1px solid #000;
}
.adjust-btn {
  border-radius: 10px;
  color: #00f579;
  border: 1px solid #00f579;
  padding: 5px;
  font: 16px "Nunito", sans-serif;
  font-weight: 400;
  width: 150px;
  background: #131a1f;
}
.warehouse-title,
.qty-product-stock {
  margin-top: 2px;
}

/*====================History Action=============================*/
.history-data-block {
  width: 950px;
  margin-bottom: 40px;
}
.history-tab-point-inside {
  height: 20px;
  width: 20px;
  background: #5c6869;
  border-radius: 10px;
  position: relative;
  top: 10px;
  left: 10px;
}
.history-tab-point-outside {
  height: 40px;
  width: 40px;
  border-radius: 10px;
  background: #1c2e37;
}
.history-tab-vertical-line {
  border-left: 1px dotted #5c6869;
  height: 60px;
}
.history-date-title {
  border-radius: 10px;
  border: 1px solid #5c6869;
  background: #1c2e37;
  color: #fff;
  padding: 5px;
  width: fit-content;
}
/*================Notes=================*/
.overflow-card {
  background: #1c2e37;
  border-radius: 10px;
  height: 320px;
  overflow-y: auto;
}
.note-title {
  font: 16px "Nunito", sans-serif;
  font-weight: 400;
  color: #fff;
}
.notes-textarea {
  border-radius: 10px;
  border: 1px solid #5c6869;
  background: #1c2e37;
  padding: 5px;
  width: 550px;
  height: 130px;
  position: relative;
  top: 10px;
  left: 28px;
}
.note-btn {
  background: #00f579;
  color: #1c2e37;
  border-radius: 10px;
  padding: 10px 20px 10px 20px;
  width: fit-content;
  position: relative;
  top: 25px;
  left: 28px;
  text-transform: capitalize;
  font: 16px "Nunito", sans-serif;
  font-weight: 700;
  height: 45px;
}
.note-card {
  border-radius: 10px;
  padding: 10px;
  border: 1px solid #5c6869;
  background: #1c2e37;
  width: 750px;
  height: fit-content;
}
.note-card-img {
  height: 40px;
  width: 40px;
  border-radius: 10px;
}
.note-card-desc {
  border-top: 1px solid #5c6869;
}
</style>
