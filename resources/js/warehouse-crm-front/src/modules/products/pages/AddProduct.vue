<template>
  <v-row no-gutters>
    <v-col cols="12" class="breadcrumbs pt-5">
      <RouterLink
        to="/products"
        class="link-style-disabled"
        aria-label="Back to product list"
      >
        <div class="back-arrow" aria-hidden="true">&#10159;</div>
        <p class="title-back-link text-left ps-3">Back to product list</p>
      </RouterLink>
    </v-col>
    <v-col cols="9" class="main-content add-product-form pb-10" offset="3">
      <v-row no-gutters class="save-product-form">
        <v-col cols="12" class="ps-2 pe-2">
          <p
            class="add-form-subtitle text-center pt-6"
            aria-label="Add New Product"
          >
            Add New Product
          </p>
          <h3
            class="add-form-title text-center pb-5"
            aria-label="General Information"
          >
            General Information
          </h3>
        </v-col>
        <v-col cols="12" class="ps-12 pe-12 pt-1">
          <label for="productName" class="add-form-label ps-1"
            >Product name:</label
          ><br />
          <input
            v-model="productData.title"
            type="text"
            id="productName"
            name="productName"
            class="common-input-style mt-2"
            placeholder="Enter product name ..."
            required
            aria-label="Product Name"
          /><br />
        </v-col>

        <v-col cols="12" class="ms-11">
          <div class="d-flex flex-row pt-6">
            <div class="ps-2 pe-2">
              <label class="checkbox-container">
                Returnable product
                <input
                  v-model="productData.is_returnable"
                  type="checkbox"
                  aria-label="Returnable Product"
                />
                <span class="add-form-checkbox"></span>
              </label>
            </div>
            <div class="ps-2 pe-2">
              <label class="checkbox-container">
                Have variant
                <input
                  v-model="productData.is_have_variant"
                  type="checkbox"
                  aria-label="Have Variant"
                />
                <span class="add-form-checkbox"></span>
              </label>
            </div>
          </div>
        </v-col>

        <v-col cols="12" class="ps-11 pe-12 pt-1 pb-2">
          <v-row no-gutters>
            <v-col cols="6" class="ps-2 pe-2 mt-4">
              <label class="add-form-label ps-1" for="productType"
                >Product Type:</label
              ><br />
              <CustomSelectOption
                label="Product Status"
                :options="typeOptions"
                :selectedOption="currentTypeOption"
                @update:selectedOption="selectTypeOption"
                aria-label="Product Type Select"
              />
            </v-col>

            <v-col cols="6" class="ps-2 pe-2 mt-4">
              <label class="add-form-label ps-1" for="productStatus"
                >Product Status:</label
              ><br />
              <CustomSelectOption
                label="Product Status"
                :options="statusOptions"
                :selectedOption="currentStatusOption"
                @update:selectedOption="selectStatusOption"
                aria-label="Product Status Select"
              />
            </v-col>

            <v-col cols="6" class="ps-2 pe-2 mt-4">
              <label class="add-form-label ps-1" for="productBrand"
                >Product Brand:</label
              ><br />
              <CustomSelectOption
                label="Product Brand"
                :options="brandOptions"
                :selectedOption="currentBrandOption"
                @update:selectedOption="selectBrandOption"
                aria-label="Product Brand Select"
              />
            </v-col>

            <v-col cols="6" class="ps-2 pe-2 mt-4">
              <label class="add-form-label ps-1" for="productCategory"
                >Product Category:</label
              ><br />
              <CustomSelectOption
                label="Product Category"
                :options="categoryOptions"
                :selectedOption="currentCategoryOption"
                @update:selectedOption="selectCategoryOption"
                aria-label="Product Category Select"
              />
            </v-col>
          </v-row>
        </v-col>
        <v-row no-gutters class="ps-6 pe-6">
          <v-col cols="12" class="pb-6">
            <h3 class="add-form-title ps-2 pt-2">Measurement</h3>
          </v-col>
          <v-col cols="4" class="ps-1 pe-1 pb-3">
            <label for="width" class="add-form-label ps-1" aria-label="Width"
              >Width (cm):</label
            ><br />
            <input
              type="text"
              id="width"
              name="width"
              class="common-input-style mt-2"
              placeholder="Enter width ..."
              pattern="[0-9]+(\\.[0-9][0-9]?)?"
              v-model="productData.width"
              min="1"
              max="100000000"
              required
              aria-label="Width Input"
            /><br />
          </v-col>
          <v-col cols="4" class="ps-1 pe-1 pb-3">
            <label for="height" class="add-form-label ps-1" aria-label="Height"
              >Height (cm):</label
            ><br />
            <input
              type="text"
              id="height"
              name="height"
              class="common-input-style mt-2"
              placeholder="Enter height ..."
              pattern="[0-9]+(\\.[0-9][0-9]?)?"
              v-model="productData.height"
              min="1"
              max="100000000"
              aria-label="Height Input"
            /><br />
          </v-col>
          <v-col cols="4" class="ps-1 pe-1 pb-1">
            <label for="weight" class="add-form-label ps-1">Weight (kg):</label
            ><br />
            <input
              type="text"
              id="weight"
              name="weight"
              class="common-input-style mt-2"
              placeholder="Enter weight ..."
              pattern="[0-9]+(\\.[0-9][0-9]?)?"
              v-model="productData.weight"
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
        <v-col cols="12" class="ps-12 pe-12">
          <v-row no-gutters>
            <v-col cols="4" class="ps-2 pe-2 pt-6">
              <label for="costPrice" class="price-label">Cost Price:</label>
              <div class="mt-1">
                <input
                  v-model.number="productData.cost"
                  type="number"
                  id="costPrice"
                  placeholder="Cost price ..."
                  class="common-input-style price-input"
                  min="1"
                  max="1000000"
                  required
                  aria-label="Cost Price"
                />
                <i
                  class="las la-dollar-sign la-dollar-sign-position"
                  aria-hidden="true"
                ></i>
              </div>
            </v-col>
            <v-col cols="4" class="ps-2 pe-2 pt-6">
              <label for="retailSailPrice" class="price-label"
                >Retail Price:</label
              >
              <div class="mt-1">
                <input
                  v-model.number="productData.retail_price"
                  type="number"
                  id="retailSailPrice"
                  placeholder="Retail price ..."
                  class="common-input-style price-input"
                  min="1"
                  max="1000000"
                  required
                  aria-label="Retail Price"
                />
                <i
                  class="las la-dollar-sign la-dollar-sign-position"
                  aria-hidden="true"
                ></i>
              </div>
            </v-col>
            <v-col cols="4" class="ps-2 pe-2 pt-6">
              <label for="wholesaleSailPrice" class="price-label"
                >Wholesale Price:</label
              >
              <div class="mt-1">
                <input
                  v-model.number="productData.wholesale_price"
                  type="number"
                  id="wholesaleSailPrice"
                  placeholder="Wholesale price..."
                  class="common-input-style price-input"
                  min="1"
                  max="1000000"
                  required
                  aria-label="Wholesale Price"
                />
                <i
                  class="las la-dollar-sign la-dollar-sign-position"
                  aria-hidden="true"
                ></i>
              </div>
            </v-col>
          </v-row>
          <v-col cols="12" class="ps-2 pe-2 pt-1">
            <label for="productImage" class="add-form-label ps-1"
              >Product Image:</label
            ><br />
            <input
              type="file"
              id="productImage"
              name="productImage"
              class="common-input-style mt-2 input-image"
              @change="handleImageUpload"
              accept="image/*"
              aria-label="Product Image"
            />
            <div
              v-if="imagePreview"
              class="image-preview mt-2"
              aria-label="Product Image Preview"
            >
              <img :src="imagePreview" alt="Product Image Preview" />
            </div>
          </v-col>
        </v-col>

        <v-col
          cols="12"
          class="ps-3 pe-12 pt-8 pb-10 d-flex flex-row justify-end"
        >
          <v-btn
            class="wr-primary-btn me-2"
            @click="saveAsDraft"
            aria-label="Save as Draft"
          >
            Save as draft
          </v-btn>
          <v-btn
            class="wr-primary-btn"
            @click="saveProduct"
            aria-label="Save Product"
          >
            Save
          </v-btn>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>
<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from "vue";
import { useRouter } from 'vue-router';
import { useInventoryFiltersStore } from "@/modules/products/store/useInventoryFiltersStore";
import { useProductStore } from "@/modules/products/store/useProductStore";
import CustomSelectOption from "../../../components/common/CustomSelectOption.vue";
import SelectOptionFromArray from "../../../components/common/SelectOptionFromArray.vue";

const router = useRouter();
const productStore = useProductStore();
const inventoryFiltersStore = useInventoryFiltersStore();

const userId = localStorage.getItem("userId")
  ? Number(localStorage.getItem("userId"))
  : null;

onMounted(async () => {
  await inventoryFiltersStore.fetchInventoryFilters();
  if (userId) {
    productData.value.user_id = userId;
  }
});

interface ProductCreateData {
  is_returnable: boolean;
  is_have_variant: boolean;
  core_product_id: number | null;
  title: string;
  retail_price: number | null;
  wholesale_price: number | null;
  cost: number | null;
  id_draft: boolean;
  product_type_id: number | null;
  product_status_id: number | null;
  category_id: number | null;
  brand_id: number | null;
  user_id: number | null;
  size: string;
  width: number | null;
  height: number | null;
  weight: number | null;
  color: string;
  material: string;
  image: File | null;
}

const productData = ref<ProductCreateData>({
  is_returnable: false,
  is_have_variant: false,
  core_product_id: null,
  title: "",
  retail_price: null,
  wholesale_price: null,
  cost: null,
  id_draft: false,
  product_type_id: null,
  product_status_id: null,
  category_id: null,
  brand_id: null,
  user_id: null,
  size: "",
  width: null,
  height: null,
  weight: null,
  color: "",
  material: "",
  image: null,
});

const selectedType = ref(null);
const selectedStatus = ref(null);
const selectedCategory = ref(null);
const selectedBrand = ref(null);
const selectedSize = ref(null);
const selectedColor = ref(null);
const selectedMaterial = ref(null);

const typeOptions = computed(() => inventoryFiltersStore.productTypes);
const statusOptions = computed(() => inventoryFiltersStore.productStatuses);
const categoryOptions = computed(() => inventoryFiltersStore.categories);
const brandOptions = computed(() => inventoryFiltersStore.brands);
const sizeOptions = ["S", "L", "XL", "XXL"];
const colorOptions = ["Red", "Blue", "Green"];
const materialOptions = ["Cotton", "Wool", "Synthetic"];

watch(selectedType, (newType) => {
  productData.value.product_type_id = newType;
});
watch(selectedStatus, (newStatus) => {
  productData.value.product_status_id = newStatus;
});
watch(selectedCategory, (newCategory) => {
  productData.value.category_id = newCategory;
});
watch(selectedBrand, (newBrand) => {
  productData.value.brand_id = newBrand;
});
watch(selectedSize, (newSize) => {
  productData.value.size = newSize;
});
watch(selectedColor, (newColor) => {
  productData.value.color = newColor;
});
watch(selectedMaterial, (newMaterial) => {
  productData.value.material = newMaterial;
});

const showTypeOptions = ref(false);
const showStatusOptions = ref(false);
const showCategoryOptions = ref(false);
const showBrandOptions = ref(false);
const showSizeOptions = ref(false);
const showColorOptions = ref(false);
const showMaterialOptions = ref(false);

const selectTypeOptionOutClick = ref(null);
const handleTypeClickOutside = (event) => {
  if (
    selectTypeOptionOutClick.value &&
    !selectTypeOptionOutClick.value.contains(event.target)
  ) {
    showTypeOptions.value = false;
  }
};
const selectTypeOption = (option) => {
  selectedType.value = option.id;
  showTypeOptions.value = false;
};
const currentTypeOption = computed(() => {
  return typeOptions.value.find((type) => type.id === selectedType.value) || {};
});

const currentStatusOption = computed(() => {
  return (
    statusOptions.value.find((status) => status.id === selectedStatus.value) ||
    {}
  );
});
const selectStatusOptionOutClick = ref(null);
const selectStatusOption = (option) => {
  selectedStatus.value = option.id;
  showStatusOptions.value = false;
};
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
const selectCategoryOption = (option) => {
  selectedCategory.value = option.id;
  showCategoryOptions.value = false;
};
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
const selectBrandOption = (option) => {
  selectedBrand.value = option.id;
  showBrandOptions.value = false;
};
const handleBrandClickOutside = (event) => {
  if (
    selectBrandOptionOutClick.value &&
    !selectBrandOptionOutClick.value.contains(event.target)
  ) {
    showBrandOptions.value = false;
  }
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

const handleImageUpload = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    productData.value.image = target.files[0];
    console.log("Image uploaded:", productData.value.image);
  }
};

const logFormData = (formData: FormData) => {
  console.log("Logging FormData:");
  formData.forEach((value, key) => {
    console.log(`${key}: ${value}`);
  });
};

const createFormData = (isDraft: boolean = false) => {
  const formData = new FormData();
  formData.append("title", productData.value.title);
  formData.append("cost", productData.value.cost?.toString());
  formData.append(
    "retail_price",
    productData.value.retail_price?.toString() || ""
  );
  formData.append(
    "wholesale_price",
    productData.value.wholesale_price?.toString() || ""
  );
  formData.append("is_returnable", productData.value.is_returnable ? "1" : "0");
  formData.append(
    "is_have_variant",
    productData.value.is_have_variant ? "1" : "0"
  );
  formData.append("user_id", productData.value.user_id?.toString() || "");
  formData.append(
    "product_type_id",
    productData.value.product_type_id?.toString() || ""
  );
  formData.append(
    "product_status_id",
    productData.value.product_status_id?.toString() || ""
  );
  formData.append(
    "category_id",
    productData.value.category_id?.toString() || ""
  );
  formData.append("brand_id", productData.value.brand_id?.toString() || "");
  formData.append("size", productData.value.size);
  formData.append("width", productData.value.width?.toString() || "");
  formData.append("height", productData.value.height?.toString() || "");
  formData.append("weight", productData.value.weight?.toString() || "");
  formData.append("color", productData.value.color);
  formData.append("material", productData.value.material);

  if (productData.value.image) {
    formData.append("image", productData.value.image);
  }
  if (isDraft) {
    formData.append("is_draft", "true");
  }
  logFormData(formData);
  return formData;
};

const saveProduct = async () => {
  const formData = createFormData();
  console.log("Saving product with formData:", formData);
  logFormData(formData);
  await productStore.createProduct(formData);
  router.push({ name: 'ProductList' });
};

const saveAsDraft = async () => {
  const formData = createFormData(true);
  console.log("Saving product with formData:", formData);
  logFormData(formData);
  await productStore.createProduct(formData);
  router.push({ name: 'ProductList' });
};
</script>

<style scoped>
.link-style-disabled {
  text-decoration: none;
  color: inherit;
}
.save-product-form {
  width: 1000px;
  height: auto;
  border: 1px solid #384149;
  border-radius: 15px;
}
/*=====================Back Link==============================*/
.back-arrow {
  transform: rotate(180deg);
  font-size: 28px;
  margin-left: 22px;
  color: #a2b2bb;
  position: absolute;
  left: 15px;
}

.title-back-link {
  color: #a2b2bb;
  font-size: 18px;
  margin-left: 50px;
  padding-top: 7px;
  text-decoration: none;
}

.input-image {
  padding-bottom: 12px;
}
</style>
