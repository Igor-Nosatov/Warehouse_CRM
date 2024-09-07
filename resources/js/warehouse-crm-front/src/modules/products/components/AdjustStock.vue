<template>
  <div
    v-if="isOpenAdjustStock"
    class="modal-backdrop"
    @click="handleBackdropAdjustStock"
  >
    <div class="modal-form" @click.stop>
      <v-row no-gutters class="pb-1 ps-2">
        <v-col cols="11">
          <h4 class="modal-title pt-1">New Adjustment</h4>
        </v-col>
        <v-col cols="1" class="pt-2 pb-4 pe-2">
          <v-btn class="close-btn" @click="emitCloseAdjustStock">
            <i class="las la-times fs-2"></i>
          </v-btn>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col cols="12" class="ps-2">
          <v-card class="item-card mr-2 ml-1">
            <v-row no-gutters>
              <v-col cols="12" class="d-flex flex-row pt-2">
                <img :src="image1" alt="New Balance" class="card-img" />
                <div class="d-flex flex-column">
                  <h5 class="card-product-title ps-5 pt-5">New Balance 997</h5>
                  <div class="ps-5 pt-2 d-flex flex-row">
                    <div class="card-product-category pe-1">Man shoes</div>
                    <div class="card-product-type">
                      <i class="las la-warehouse pe-1 ps-2 pt-1"></i>Stocked
                      Product:
                    </div>
                    <div class="card-product-count-stock">12 in stock</div>
                    <div class="indicator d-flex flex-column">
                      <div class="empty-indicator-part"></div>
                      <div class="colorful-indicator-part"></div>
                    </div>
                    <div class="card-product-stock-level ps-3">low</div>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
        <v-col cols="12" class="ps-4 pe-2 pt-8">
          <p class="label-forma-adjust-stock pb-2">Adjustment Type</p>
          <div class="d-flex flex-row justify-space-between">
            <div
              :class="[
                'adjust-stock-radio-input  me-2 d-flex flex-row justify-space-between',
                { active: selectedAdjustment === 'Quantity Adjustment' },
              ]"
              @click="selectAdjustment('quantity_adjustment')"
            >
              <label for="quantity_adjustment" class="text-capitalize pe-12"
                >Quantity Adjustment</label
              >
              <input
                type="radio"
                id="quantity_adjustment"
                name="adjustment"
                value="Quantity Adjustment"
                v-model="selectedAdjustment"
              />
            </div>
            <div
              :class="[
                'adjust-stock-radio-input ms-2 d-flex flex-row justify-space-between',
                { active: selectedAdjustment === 'Value Adjustment' },
              ]"
              @click="selectAdjustment('value_adjustment')"
            >
              <label for="value_adjustment" class="text-capitalize pe-12"
                >Value Adjustment</label
              >
              <input
                type="radio"
                id="value_adjustment"
                name="adjustment"
                value="Value Adjustment"
                v-model="selectedAdjustment"
              />
            </div>
          </div>
        </v-col>
        <v-col cols="12" class="ps-4 pe-2 pt-3 select-block">
          <p class="label-forma-adjust-stock pb-2">Location</p>
          <div @click="toggleDropdownLocation" class="select-label">
            <p v-if="selectedItemLocation" class="select-text">
              <span class="text-capitalize">
                {{ selectedItemLocation.name }}</span
              >
            </p>
            <p v-else class="select-text">Select Location</p>
          </div>
          <transition name="fade">
            <div v-if="isDropdownOpenLocation" class="dropdown-menu">
              <div
                v-for="(item, index) in warehouseData"
                :key="index"
                class="dropdown-item"
                @click="selectItemLocation(item)"
              >
                <span class="text-capitalize select-text">
                  {{ item.name }}</span
                >
              </div>
            </div>
          </transition>
        </v-col>
        <v-col cols="6" class="ps-4 pe-2 pt-3">
          <p class="label-forma-adjust-stock pb-2">Date</p>
          <input
            type="date"
            v-model="form.adjust_stock_date"
            class="input-date"
            placeholder="select date"
          />
        </v-col>

        <v-col cols="6" class="ps-4 pe-2 pt-3">
          <p class="label-forma-adjust-stock pb-2">Reason</p>
          <div @click="toggleDropdownReason" class="select-label">
            <p v-if="selectedItemReason" class="select-text">
              <span class="text-capitalize"> {{ selectedItemReason }}</span>
            </p>
            <p v-else class="select-text">Select Reason</p>
          </div>
          <transition name="fade">
            <div v-if="isDropdownOpenReason" class="dropdown-menu-reason">
              <div
                v-for="item in itemsReason"
                :key="item.id"
                class="dropdown-item"
                @click="selectItemReason(item)"
              >
                <span class="text-capitalize select-text"> {{ item }}</span>
              </div>
            </div>
          </transition>
        </v-col>

        <v-col cols="12" class="ps-4 pe-2 pt-3 select-block">
          <p class="label-forma-adjust-stock pb-2">Vendor</p>
          <div @click="toggleDropdownVendor" class="select-label">
            <p v-if="selectedVendor" class="select-text">
              <span class="text-capitalize">
                {{ selectedVendor.company_name }}</span
              >
            </p>
            <p v-else class="select-text">Select Vendor</p>
          </div>
          <transition name="fade">
            <div v-if="isDropdownOpenVendor" class="dropdown-menu-vendor">
              <div
                v-for="item in vendorData"
                :key="item.id"
                class="dropdown-item"
                @click="selectVendor(item)"
              >
                <span class="text-capitalize select-text">
                  {{ item.company_name }}</span
                >
              </div>
            </div>
          </transition>
        </v-col>

        <v-col cols="6" class="ps-4 pe-2 pt-3">
          <p class="label-forma-adjust-stock pb-2">Quantity Available</p>
          <div class="d-flex flex-row qty-input justify-content-between">
            <v-row no-gutters>
              <v-col cols="4">
                <button
                  @click="decrementQuantityAvailable"
                  class="btn-circle ms-2"
                >
                  <i class="las la-minus pt-1"></i>
                </button>
              </v-col>
              <v-col cols="3" offset="1">
                <div class="product-count pt-5 ps-5 pe-7">
                  {{ countQuantityAvailable }}
                </div>
              </v-col>
              <v-col cols="2" offset="2">
                <button @click="incrementQuantityAvailable" class="btn-circle">
                  <i class="las la-plus pt-1"></i>
                </button>
              </v-col>
            </v-row>
          </div>
        </v-col>
        <v-col cols="6" class="ps-4 pe-2 pt-3">
          <p class="label-forma-adjust-stock pb-2">New Quantity</p>
          <div class="d-flex flex-row qty-input justify-content-between">
            <v-row no-gutters>
              <v-col cols="4">
                <button @click="decrementNewQuantity" class="btn-circle ms-2">
                  <i class="las la-minus pt-1"></i>
                </button>
              </v-col>
              <v-col cols="3" offset="1">
                <div class="product-count pt-5 ps-5 pe-7">
                  {{ countNewQuantity }}
                </div>
              </v-col>
              <v-col cols="2" offset="2">
                <button @click="incrementNewQuantity" class="btn-circle">
                  <i class="las la-plus pt-1"></i>
                </button>
              </v-col>
            </v-row>
          </div>
        </v-col>
        <v-col cols="12" class="ps-4 pe-2 pt-4">
          <p class="label-forma-adjust-stock pb-2">Description</p>
          <textarea
            v-model="form.description"
            id="story"
            name="story"
            rows="2"
            cols="33"
            class="adjust-stock-textarea"
          ></textarea>
        </v-col>
        <v-col cols="12">
          <div
            class="footer-new-adjustment d-flex flex-row justify-space-between"
          >
            <v-btn class="cancel-btn mt-4 ms-6" @click="handleClose"
              >Cancel</v-btn
            >
            <v-btn class="standard-btn mt-4 me-6" @click="handleSubmit"
              >Save</v-btn
            >
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useAdjustStockStore } from "@/modules/products/store/useAdjustStockStore";
import image1 from "@/assets/product1.jpg";

const userId = localStorage.getItem("userId");

const props = defineProps({
  isOpenAdjustStock: Boolean,
  productId: Number,
  warehouseData: Array,
  vendorData: Array,
});

const emit = defineEmits(["close"]);
const emitCloseAdjustStock = () => {
  emit("close");
};
const handleBackdropAdjustStock = (event) => {
  if (event.target === event.currentTarget) {
    emitCloseAdjustStock();
  }
};

const store = useAdjustStockStore();

watch(
  () => props.productId,
  (newProductId) => {
    form.value.product_id = newProductId;
  }
);

const selectedAdjustment = ref("quantity_adjustment");

const form = ref({
  adjust_stock_date: "",
  reason_for_inventory: "Other",
  quantity_available: 0,
  new_quantity: 0,
  description: "",
  product_id: props.productId,
  vendor_id: "",
  warehouse_id: "",
  user_id: parseInt(userId),
});

function selectAdjustment(value) {
  selectedAdjustment.value = value;
}

const isDropdownOpenLocation = ref(false);
const selectedItemLocation = ref(null);

const toggleDropdownLocation = () => {
  isDropdownOpenLocation.value = !isDropdownOpenLocation.value;
};

const selectItemLocation = (item) => {
  selectedItemLocation.value = item;
  form.value.warehouse_id = item.id;
  isDropdownOpenLocation.value = false;
};

const isDropdownOpenVendor = ref(false);
const selectedVendor = ref(null);

const toggleDropdownVendor = () => {
  isDropdownOpenVendor.value = !isDropdownOpenVendor.value;
};

const selectVendor = (item) => {
  selectedVendor.value = item;
  form.value.vendor_id = item.id;
  isDropdownOpenVendor.value = false;
};

const isDropdownOpenReason = ref(false);

const itemsReason = ref(["Stolen Goods", "Missing Goods", "Accident", "Other"]);

const selectedItemReason = ref(itemsReason[0]);

const toggleDropdownReason = () => {
  isDropdownOpenReason.value = !isDropdownOpenReason.value;
};

const selectItemReason = (item) => {
  selectedItemReason.value = item;
  form.value.reason_for_inventory = item;
  isDropdownOpenReason.value = false;
};

const countQuantityAvailable = ref(form.value.quantity_available || 0);
const countNewQuantity = ref(form.value.new_quantity || 0);

function incrementQuantityAvailable() {
  countQuantityAvailable.value++;
  form.value.quantity_available = countQuantityAvailable.value;
}

function decrementQuantityAvailable() {
  if (countQuantityAvailable.value !== 0) {
    countQuantityAvailable.value--;
    form.value.quantity_available = countQuantityAvailable.value;
  }
}

function incrementNewQuantity() {
  countNewQuantity.value++;
  form.value.new_quantity = countNewQuantity.value;
}

function decrementNewQuantity() {
  if (countNewQuantity.value !== 0) {
    countNewQuantity.value--;
    form.value.new_quantity = countNewQuantity.value;
  }
}

const handleClose = () => {
  emitCloseAdjustStock();
};

const handleSubmit = async () => {
  const adjustmentData = {
    payment_status: selectedAdjustment.value,
    ...form.value,
  };
  try {
    await store.createAdjustStock(adjustmentData);
    emitCloseAdjustStock();
  } catch (error) {
    console.error("Error creating adjustment:", error);
  }
};
</script>

<style scoped>
  /*============Adjustment Form===========================*/
  .label-forma-adjust-stock{
    color:#fff;
    font: 14px "Nunito", sans-serif !important;
  }
  .adjust-stock-radio-input{
    border: 1px solid #2f3943;
    background: #19222a;
    color:#fff;
    font: 16px "Nunito", sans-serif !important;
    padding:15px;
    border-radius: 10px;
    transition: all 0.6s ease-out;
    width:100%;
  }
  .adjust-stock-radio-input.active {
    border: 1px solid #00f579;
  }

  .adjust-stock-radio-input input[type="radio"]:checked {
    accent-color: #00f579;
  }
  .select-block {
    position: relative;
  }

  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
  }

  .fade-enter-from, .fade-leave-to {
    opacity: 0;
  }

  .select-label {
    border: 1px solid #2f3943;
    background: #19222a;
    padding: 10px 0px 10px 30px;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    user-select: none;
  }

  .dropdown-menu,.dropdown-menu-reason,.dropdown-menu-vendor {
    border: 1px solid #2f3943;
    background: #19222a;
    padding: 10px 0;
    border-radius: 10px;
    overflow: hidden;
  }
  .dropdown-menu {
    position: absolute;
    z-index:999;
    width:96.5%;
    top:105%;
  }
  .dropdown-menu-reason{
    position: absolute;
    z-index:999;
    width:43.5%;
    top:54.2%;
  }

  .dropdown-menu-vendor{
    overflow-y: auto !important;
    height: 200px !important;
    position: absolute;
    z-index: 999;
    width: 96.5%;
    top: 105%;
  }

  .dropdown-item {
    padding: 10px 30px;
    color: #fff;
    cursor: pointer;
  }

  .dropdown-item:hover {
    background-color: #2a3b44;
  }
  .select-text{
    position: relative;
    right:15px;
  }

  /*===============Input Increment and Decrement====================*/
  .btn-circle {
    border-radius: 100%;
    border: 1px solid #2f3943;
    background: #19222a;
    cursor: pointer;
    color: #fff;
    padding: 6px 9px 3px 9px;
    transition: all 0.5s ease-out;
    margin-top: 5px;
  }
  .btn-circle:hover {
    background-color: #2f3943 !important;
  }
  .la-plus,
  .la-minus {
    font-size: 22px !important;
  }
  .add-new-warehouse-link {
    color: #39db7d;
    text-decoration: none;
    font-weight: 800;
    font-family: "Nunito", sans-serif !important;
  }
  .la-plus-add-location {
    padding-top: 10px !important;
    color: #39db7d;
    font-weight: 800;
    position: relative;
    top: 2px;
    right: 5px;
  }
  .product-count{
    position: relative;
    bottom:5px;
    font-size:18px;
    font-family: "Nunito", sans-serif ;
    z-index:11;
  }
  /*===============End Input Increm and Decrement====================*/
  .input-date{
    border: 1px solid #2f3943;
    background: #19222a;
    height: 47px !important;
    color: #fff;
    border-radius: 10px;
    font-family: "Nunito", sans-serif !important;
    width:100%;
    padding:15px;
  }
  .adjust-stock-textarea{
    border: 1px solid #919da1;
    border-radius: 10px;
    font: 18px "Nunito", sans-serif !important;
    padding: 15px;
    width:100%;
    color: #fff;
  }
  /*=============New Adjustment Footer====================*/
  .footer-new-adjustment {
    background: #1e292f;
    border: 1px #223842 solid;
    color: #fff;
    font: 16px "Nunito", sans-serif;
    text-transform: capitalize;
    height: 80px !important;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    transition: all 0.5s ease-out;
    width: 100%;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }
  .footer-new-adjustment{
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
  }

  .cancel-btn,.standard-btn{
    font: 18px "Nunito", sans-serif;
    text-transform: capitalize;
    height:50px !important;
    width:170px !important;
  }

  .cancel-btn{
    background: #1e292f;
    border: 1px #223842 solid;
    border-radius: 10px;
    color: #00f579;
  }
  .standard-btn{
    font: 18px "Nunito", sans-serif;
    text-transform: capitalize;
    color: #000;
    background: #00f579;
    font-weight:700;
    border-radius: 10px;
  }
</style>
