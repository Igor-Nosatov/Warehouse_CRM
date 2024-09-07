<template>
  <div v-if="isOpen" class="modal-backdrop" @click="handleBackdropClick" aria-label="Close modal">
    <div class="modal-form edit-form" @click.stop>
      <v-row no-gutters class="pb-4 ps-6">
        <v-col cols="7" class="pt-2 pb-4">
          <div class="d-flex flex-row justify-space-start">
            <v-btn class="close-btn" @click="emitClose" aria-label="Close">
              <i class="las la-times fs-2"></i>
            </v-btn>
            <v-btn class="close-btn ms-3" @click="updateProduct" aria-label="Save">
              <i class="las la-save fs-2"></i>
            </v-btn>
          </div>
        </v-col>
        <v-col cols="12">
          <div class="tab-navigation d-flex flex-row">
            <button
              class="tab-navigation-btn"
              :class="{ tab_navigation_btn_active: activeOpenTab === 1 }"
              @click="openTab(1)"
              aria-label="Basic Information Tab"
            >
              Basic Information
            </button>
            <button
              class="tab-navigation-btn"
              :class="{ tab_navigation_btn_active: activeOpenTab === 2 }"
              @click="openTab(2)"
              aria-label="Sales Information Tab"
            >
              Sales Information
            </button>
            <button
              class="tab-navigation-btn"
              :class="{ tab_navigation_btn_active: activeOpenTab === 3 }"
              @click="openTab(3)"
              aria-label="Measurement Tab"
            >
              Measurement
            </button>
          </div>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col cols="12" v-if="activeOpenTab === 1" class="tab">
          <v-row no-gutters class="ps-6 pe-6">
            <v-col cols="12" class="pb-6">
              <h3 class="add-form-title ps-2 pt-2">Basic Information</h3>
            </v-col>
            <v-col cols="12" class="ps-1 pe-12">
              <label for="productName" class="add-form-label ps-1" aria-label="Product Name">Product name:</label><br />
              <input
                type="text"
                id="productName"
                name="productName"
                class="common-input-style mt-2"
                v-model="product.title"
                required
                aria-label="Product Name Input"
              /><br />
            </v-col>
            <v-col cols="12">
              <div class="d-flex flex-row pt-6">
                <div class="ps-2 pe-2">
                  <label class="checkbox-container" aria-label="Returnable Product">
                    Returnable product
                    <input type="checkbox" v-model="product.is_returnable" />
                    <span class="add-form-checkbox"></span>
                  </label>
                </div>
                <div class="ps-2 pe-2">
                  <label class="checkbox-container" aria-label="Have Variant">
                    Have variant
                    <input type="checkbox" v-model="product.is_have_variant" />
                    <span class="add-form-checkbox"></span>
                  </label>
                </div>
              </div>
            </v-col>
            <v-col cols="6" class="ps-1 pe-2 mt-4">
              <label class="add-form-label ps-1" aria-label="Product Type">Product Type:</label><br />
              <CustomSelectOption
                label="Type"
                :options="typeOptions"
                :selectedOption="currentTypeOption"
                @update:selectedOption="selectTypeOption"
                aria-label="Product Type Select"
              />
            </v-col>
            <v-col cols="6" class="ps-1 pe-2 mt-4">
              <label class="add-form-label ps-1" aria-label="Product Status">Product Status:</label><br />
              <CustomSelectOption
                label="Status"
                :options="statusOptions"
                :selectedOption="currentStatusOption"
                @update:selectedOption="selectStatusOption"
                aria-label="Product Status Select"
              />
            </v-col>
            <v-col cols="6" class="ps-1 pe-2 mt-4">
              <label class="add-form-label ps-1" aria-label="Product Category">Product Category:</label><br />
              <CustomSelectOption
                label="Category"
                :options="categoryOptions"
                :selectedOption="currentCategoryOption"
                @update:selectedOption="selectCategoryOption"
                aria-label="Product Category Select"
              />
            </v-col>
            <v-col cols="6" class="ps-1 pe-2 mt-4">
              <label class="add-form-label ps-1" aria-label="Product Brand">Product Brand:</label><br />
              <CustomSelectOption
                label="Brand"
                :options="brandOptions"
                :selectedOption="currentBrandOption"
                @update:selectedOption="selectBrandOption"
                aria-label="Product Brand Select"
              />
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12" v-if="activeOpenTab === 2" class="tab">
          <v-row no-gutters class="ps-6 pe-6">
            <v-col cols="12" class="pb-6">
              <h3 class="add-form-title ps-2 pt-2">Sales Information</h3>
            </v-col>
            <v-col cols="7" class="ps-1 pe-1 pb-3">
              <label for="retail_price" class="add-form-label ps-1" aria-label="Retail Price">Retail Price $:</label><br />
              <input
                type="text"
                id="retail_price"
                name="retail_price"
                class="common-input-style mt-2"
                placeholder="Enter retail price ..."
                pattern="[0-9]+(\\.[0-9][0-9]?)?"
                v-model="product.retail_price"
                required
                aria-label="Retail Price Input"
              /><br />
            </v-col>
            <v-col cols="7" class="ps-1 pe-1 pb-3">
              <label for="wholesale_price" class="add-form-label ps-1" aria-label="Wholesale Price">Wholesale Price $:</label><br />
              <input
                type="text"
                id="wholesale_price"
                name="wholesale_price"
                class="common-input-style mt-2"
                placeholder="Enter wholesale price ..."
                pattern="[0-9]+(\\.[0-9][0-9]?)?"
                v-model="product.wholesale_price"
                required
                aria-label="Wholesale Price Input"
              /><br />
            </v-col>
            <v-col cols="7" class="ps-1 pe-1 pb-3">
              <label for="cost" class="add-form-label ps-1" aria-label="Product Cost">Product Cost $:</label><br />
              <input
                type="text"
                id="cost"
                name="cost"
                class="common-input-style mt-2"
                placeholder="Enter cost price ..."
                pattern="[0-9]+(\\.[0-9][0-9]?)?"
                v-model="product.cost"
                required
                aria-label="Product Cost Input"
              /><br />
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12" v-if="activeOpenTab === 3" class="tab">
          <v-row no-gutters class="ps-6 pe-6">
            <v-col cols="12" class="pb-6">
              <h3 class="add-form-title ps-2 pt-2">Measurement</h3>
            </v-col>
            <v-col cols="4" class="ps-1 pe-1 pb-3">
              <label for="width" class="add-form-label ps-1" aria-label="Width">Width (cm):</label><br />
              <input
                type="text"
                id="width"
                name="width"
                class="common-input-style mt-2"
                placeholder="Enter width ..."
                pattern="[0-9]+(\\.[0-9][0-9]?)?"
                v-model="product.attribute.width"
                min="1"
                max="100000000"
                required
                aria-label="Width Input"
              /><br />
            </v-col>
            <v-col cols="4" class="ps-1 pe-1 pb-3">
              <label for="height" class="add-form-label ps-1" aria-label="Height">Height (cm):</label><br />
              <input
                type="text"
                id="height"
                name="height"
                class="common-input-style mt-2"
                placeholder="Enter height ..."
                pattern="[0-9]+(\\.[0-9][0-9]?)?"
                v-model="product.attribute.height"
                min="1"
                max="100000000"
                aria-label="Height Input"
              /><br />
            </v-col>
            <v-col cols="4" class="ps-1 pe-1 pb-1">
              <label for="weight" class="add-form-label ps-1"
                >Weight (kg):</label
              ><br />
              <input
                type="text"
                id="weight"
                name="weight"
                class="common-input-style mt-2"
                placeholder="Enter weight ..."
                pattern="[0-9]+(\\.[0-9][0-9]?)?"
                v-model="product.attribute.weight"
                min="1"
                max="100000000"
                aria-label="Weight Input"
              /><br />
            </v-col>
            <v-col cols="6" class="ps-1 pe-2 mt-4">
              <label class="add-form-label ps-1">Select Size:</label><br />
              <SelectOptionFromArray
                label="Size"
                :options="sizeOptions"
                :selectedOption="selectedSize"
                @update:selectedOption="selectSizeOption"
                aria-label="Product Select Size"
              />
            </v-col>
            <v-col cols="6" class="ps-1 pe-2 mt-4">
              <label class="add-form-label ps-1">Select Color:</label><br />
              <SelectOptionFromArray
                label="Color"
                :options="colorOptions"
                :selectedOption="selectedColor"
                @update:selectedOption="selectColorOption"
                aria-label="Product Select Color"
              />
            </v-col>
            <v-col cols="6" class="ps-1 pe-2 mt-4">
              <label class="add-form-label ps-1">Select Material:</label><br />
              <SelectOptionFromArray
                label="Material"
                :options="materialOptions"
                :selectedOption="selectedMaterial"
                @update:selectedOption="selectMaterialOption"
                aria-label="Product Select Material"
              />
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </div>
  </div>
</template>
<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from "vue";
import { useInventoryFiltersStore } from "@/modules/products/store/useInventoryFiltersStore";
import { useProductDetailsStore } from "../store/useProductDetailsStore";
import { useProductStore } from "../store/useProductStore";
import CustomSelectOption from "../../../components/common/CustomSelectOption.vue";
import SelectOptionFromArray from "../../../components/common/SelectOptionFromArray.vue";

const props = defineProps({
  isOpen: Boolean,
  productId: Number,
});

const emit = defineEmits(["close"]);

const inventoryFiltersStore = useInventoryFiltersStore();
const productDetailsStore = useProductDetailsStore();
const productStore = useProductStore();

const userId = localStorage.getItem("userId")
  ? Number(localStorage.getItem("userId"))
  : null;

const product = ref({
  is_returnable: false,
  is_have_variant: false,
  title: "",
  retail_price: null,
  wholesale_price: null,
  cost: null,
  product_type_id: null,
  product_status_id: null,
  category_id: null,
  brand_id: null,
  width: null,
  height: null,
  weight: null,
  size: null,
  color: null,
  material: null,
  user_id: userId,
  product_id: null,
});

const selectedType = ref(null);
const selectedStatus = ref(null);
const selectedCategory = ref(null);
const selectedBrand = ref(null);
const selectedSize = ref(null);
const selectedColor = ref(null);
const selectedMaterial = ref(null);

onMounted(async () => {
  await productDetailsStore.fetchProductDetails(props.productId);
  const productData = productDetailsStore.product;
  if (productData) {
    product.value = { ...product.value, ...productData };
    selectedType.value = productData.product_type_id;
    selectedStatus.value = productData.product_status_id;
    selectedCategory.value = productData.category_id;
    selectedBrand.value = productData.brand_id;
    selectedSize.value = productData.attribute.size;
    selectedMaterial.value = productData.attribute.material;
    selectedColor.value = productData.attribute.color;
  }
});

const updateProduct = async () => {
  try {
    const updatedProductData = {
      is_returnable: product.value.is_returnable,
      is_have_variant: product.value.is_have_variant,
      title: product.value.title,
      retail_price:  Number(product.value.retail_price),
      wholesale_price:  Number(product.value.wholesale_price),
      cost:  Number(product.value.cost),
      product_type_id: selectedType.value ? selectedType.value : null,
      product_status_id: selectedStatus.value ? selectedStatus.value : null,
      category_id: selectedCategory.value ? selectedCategory.value : null,
      brand_id: selectedBrand.value ? selectedBrand.value : null,
      product_attribute_id: product.value.product_attribute_id,
      width: Number(product.value.attribute.width),
      height: Number(product.value.attribute.height),
      weight: Number(product.value.attribute.weight),
      size: selectedSize.value,
      color: selectedColor.value,
      material: selectedMaterial.value,
      product_id: Number(props.productId),
    };
    console.log(updatedProductData);
    await productStore.updateProduct(updatedProductData);
    emitClose();
  } catch (error) {
    console.error("Error updating product:", error);
  }
};

const emitClose = () => {
  emit("close");
};

const activeOpenTab = ref(1);

const openTab = (tabIndex) => {
  activeOpenTab.value = tabIndex;
};

const handleBackdropClick = () => {
  emitClose();
};

const typeOptions = computed(() => inventoryFiltersStore.productTypes);
const statusOptions = computed(() => inventoryFiltersStore.productStatuses);
const categoryOptions = computed(() => inventoryFiltersStore.categories);
const brandOptions = computed(() => inventoryFiltersStore.brands);
const sizeOptions = ["S", "L", "XL", "XXL"];
const colorOptions = ["Red", "Blue", "Green"];
const materialOptions = ["Cotton", "Wool", "Synthetic"];

const showTypeOptions = ref(false);
const showStatusOptions = ref(false);
const showCategoryOptions = ref(false);
const showBrandOptions = ref(false);
const showSizeOptions = ref(false);
const showColorOptions = ref(false);
const showMaterialOptions = ref(false);

const selectTypeOption = (option) => {
  selectedType.value = option.id;
  showTypeOptions.value = false;
};
const selectStatusOption = (option) => {
  selectedStatus.value = option.id;
  showStatusOptions.value = false;
};
const selectCategoryOption = (option) => {
  selectedCategory.value = option.id;
  showCategoryOptions.value = false;
};
const selectBrandOption = (option) => {
  selectedBrand.value = option.id;
  showBrandOptions.value = false;
};
const selectSizeOption = (option) => {
  selectedSize.value = option;
  showSizeOptions.value = false;
};
const selectMaterialOption = (option) => {
  selectedMaterial.value = option;
  showMaterialOptions.value = false;
};
const selectColorOption = (option) => {
  selectedColor.value = option;
  showColorOptions.value = false;
};

const currentTypeOption = computed(() => {
  return typeOptions.value.find((type) => type.id === selectedType.value) || {};
});
const selectTypeOptionOutClick = ref(null);
const handleTypeClickOutside = (event) => {
  if (
    selectTypeOptionOutClick.value &&
    !selectTypeOptionOutClick.value.contains(event.target)
  ) {
    showTypeOptions.value = false;
  }
};

const currentStatusOption = computed(() => {
  return (
    statusOptions.value.find((status) => status.id === selectedStatus.value) ||
    {}
  );
});
const selectStatusOptionOutClick = ref(null);
const handleStatusClickOutside = (event) => {
  if (
    selectStatusOptionOutClick.value &&
    !selectStatusOptionOutClick.value.contains(event.target)
  ) {
    showStatusOptions.value = false;
  }
};

const currentCategoryOption = computed(() => {
  return (
    categoryOptions.value.find(
      (category) => category.id === selectedCategory.value
    ) || {}
  );
});
const selectCategoryOptionOutClick = ref(null);
const handleCategoryClickOutside = (event) => {
  if (
    selectCategoryOptionOutClick.value &&
    !selectCategoryOptionOutClick.value.contains(event.target)
  ) {
    showCategoryOptions.value = false;
  }
};

const currentBrandOption = computed(() => {
  return (
    brandOptions.value.find((brand) => brand.id === selectedBrand.value) || {}
  );
});

const selectBrandOptionOutClick = ref(null);
const handleBrandClickOutside = (event) => {
  if (
    selectBrandOptionOutClick.value &&
    !selectBrandOptionOutClick.value.contains(event.target)
  ) {
    showBrandOptions.value = false;
  }
};

const selectSizeOptionOutClick = ref(null);
const handleSizeClickOutside = (event) => {
  if (
    selectSizeOptionOutClick.value &&
    !selectSizeOptionOutClick.value.contains(event.target)
  ) {
    showSizeOptions.value = false;
  }
};

const selectColorOptionOutClick = ref(null);
const handleColorClickOutside = (event) => {
  if (
    selectColorOptionOutClick.value &&
    !selectColorOptionOutClick.value.contains(event.target)
  ) {
    showColorOptions.value = false;
  }
};

const selectMaterialOptionOutClick = ref(null);
const handleMaterialClickOutside = (event) => {
  if (
    selectMaterialOptionOutClick.value &&
    !selectMaterialOptionOutClick.value.contains(event.target)
  ) {
    showMaterialOptions.value = false;
  }
};

onMounted(() => {
  document.addEventListener("mousedown", handleTypeClickOutside);
  document.addEventListener("mousedown", handleStatusClickOutside);
  document.addEventListener("mousedown", handleCategoryClickOutside);
  document.addEventListener("mousedown", handleBrandClickOutside);
  document.addEventListener("mousedown", handleSizeClickOutside);
  document.addEventListener("mousedown", handleColorClickOutside);
  document.addEventListener("mousedown", handleMaterialClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("mousedown", handleTypeClickOutside);
  document.removeEventListener("mousedown", handleStatusClickOutside);
  document.removeEventListener("mousedown", handleCategoryClickOutside);
  document.removeEventListener("mousedown", handleBrandClickOutside);
  document.removeEventListener("mousedown", handleSizeClickOutside);
  document.removeEventListener("mousedown", handleColorClickOutside);
  document.removeEventListener("mousedown", handleMaterialClickOutside);
});
</script>

<style scoped>
.modal-backdrop-remove {
  opacity: 1 !important;
  animation: fadeOut 0.5s forwards !important;
  -webkit-animation: fadeOut 0.5s forwards !important;
}

.modal-remove {
  transform: translateX(0) !important;
  animation: slideOut 0.5s forwards !important;
  -webkit-animation: slideOut 0.5s forwards !important;
}

/*==================Common style for input==================*/
.input-title,
.add-form-label,
.common-input-style {
  color: #fff;
  font-size: 18px;
  font-family: "Nunito", sans-serif !important;
  font-weight: 500 !important;
}
.common-input-style,
.qty-input {
  margin-top: 8px;
  border-radius: 15px;
  font-weight: 500;
  border: 1px solid #2f3943;
  background: #19222a;
  min-height: 55px;
  width: 100%;
  outline: none;
  cursor: pointer;
  padding: 0px 15px;
}
.add-form-title {
  color: #fff;
  font-size: 30px;
  font-family: "Nunito", sans-serif !important;
}
.add-form-subtitle {
  color: #a2b2bb;
  font-size: 20px;
  font-family: "Nunito", sans-serif !important;
}

/*==================End style for input==================*/
</style>
