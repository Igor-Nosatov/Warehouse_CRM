<template>
  <v-card class="best-selling-products-card pr-3 pl-3 pb-4">
    <div class="d-flex flex-row justify-space-between">
      <p class="top-product-card-title pl-5 pt-5 pb-5">
        Top 5 best selling products
      </p>
      <RouterLink to="/products" class="top-product-card-link pr-5 pt-5 pb-5">
        View More
        <i class="las la-caret-right pl-1"></i>
      </RouterLink>
    </div>
    <v-col cols="12" v-for="product in products" :key="product.id" class="pb-3">
      <v-card class="item-card mr-2 ml-1">
        <v-row no-gutters>
          <v-col cols="7" class="d-flex flex-row pt-2 pl-2 pb-2">
            <img :src="product.image || defaultImage" alt="Product Image" class="card-img" />
            <div class="d-flex flex-column">
              <h5 class="card-product-title pl-3 pt-3">{{ product.title }}</h5>
              <div class="pl-3 pt-1 d-flex flex-row">
                <div class="card-product-category pr-1">
                  {{ product.category }}
                </div>
              </div>
            </div>
          </v-col>
          <v-col cols="5" class="price-product-block">
            <v-row no-gutters>
              <v-col cols="5" class="pt-6 d-flex flex-row">
                <div class="line-divider"></div>
                <div>
                  <p class="card-price-title text-left pb-2">Retail Price</p>
                  <p class="card-price text-left">
                    {{
                      product.retail_price
                        ? `${product.retail_price.toFixed(2)}`
                        : "N/A"
                    }}
                  </p>
                </div>
              </v-col>
              <v-col cols="7" class="pt-6">
                <p class="card-price-title text-left pb-2">Wholesale Price</p>
                <p class="card-price text-left">
                  {{
                    product.wholesale_price
                      ? `${product.wholesale_price.toFixed(2)}`
                      : "N/A"
                  }}
                </p>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-card>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import defaultImage from "@/assets/product1.jpg";

const props = defineProps<{
  products: Array<{
    id: number;
    title: string;
    image?: string;
    category: string;
    stock: number;
    stockLevel: string;
    retail_price: number | null;
    wholesale_price: number | null;
  }>;
}>();
</script>

<style scoped>
/*===================Best Selling product============*/

.top-product-card-title,
.column-chart-title {
    font: 24px "Nunito", sans-serif;
    color: #fff;
    font-weight: 700;
}

.top-product-card-link {
    font: 24px "Nunito", sans-serif;
    color: #00ce6c;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: none;
}

/*===============Total Score========================*/

.best-selling-products-card{
    background-color: #17262e;
    width: 100%;
    border-radius: 25px;
}
.total-score-card,
.top-product-card,
.column-chart {
    background-color: #17262e;
    width: 100%;
    height: auto;
    border-radius: 25px;
}

.title-score {
    color: #666;
    font: 18px "Nunito", sans-serif;
    font-weight: 700;
}

.total-score {
    color: #fff;
    font: 50px "Nunito", sans-serif;
    font-weight: 700;
}

.decorator-line {
    background-color: #00ce6c;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    width: 5px;
    height: 24px;
    position: relative;
    top: 45px;
}

.la-building,
.la-hands-helping,
.la-truck,
.la-archive {
    background-color: #1e313a;
    color: #fff;
    padding: 8px;
    border-radius: 5px;
    font-size: 40px;
}

.score-procent {
    font: 20px "Nunito", sans-serif;
    color: #fff;
    text-transform: capitalize;
    font-weight: 700;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
}

.la-leaf {
    background-color: #bbef20;
    padding: 3px 3px;
    border-radius: 35px;
}

/*===============ItemCard========================*/
.progress-container {
    width: 100%;
    height: 30px;
    background-color: #f3f3f3;
    border-radius: 5px;
    position: relative;
}

.progress-bar {
    height: 100%;
    width: 50%;
    background-color: #4caf50;
    position: absolute;
    top: 0;
    left: 0;
    background-image: linear-gradient( to right, rgba(0, 0, 0, 0.5) 50%, transparent 50%);
}

</style>
