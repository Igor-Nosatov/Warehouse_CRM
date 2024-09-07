<template>
  <v-card class="radial-chart">
    <v-row no-gutters>
      <v-col cols="12">
        <p class="top-product-card-title pl-5 pt-5 pb-5">Stock Level</p>
      </v-col>
      <v-col cols="5" class="pt-12">
        <apexchart
          type="donut"
          :options="chartOptionsDonutRadial"
          :series="seriesRadial"
        ></apexchart>
      </v-col>
      <v-col cols="7" class="pb-4 pe-8">
        <v-card class="stock-card mr-2 ml-1 mb-2">
          <div class="d-flex flex-row pb-1">
            <h6 class="order-title">Max Level Stock</h6>
          </div>
          <v-row>
            <v-col cols="11">
              <div class="progress-bar-layout pt-2 pb-2 ps-8">
                <div class="progress-bar-empty"></div>
                <div
                  class="progress-bar-fill"
                  :style="{
                    width: stockLevelsData.MaxLevelStock.percentage + '%',
                    backgroundColor: '#02cf6a',
                  }"
                ></div>
                <div class="progress-bar-dotted"
                :style="{
                    width: stockLevelsData.MaxLevelStock.percentage + '%',
                  }"
                ></div>
              </div>
            </v-col>
            <v-col cols="1" class="pa-4"> </v-col>
          </v-row>
          <div class="d-flex flex-row sub-data">
            <p class="stock-product-title">
              {{ stockLevelsData.MaxLevelStock.totalQty || 0 }} products
            </p>
          </div>
        </v-card>

        <v-card class="stock-card mr-2 ml-1 mb-2">
          <div class="d-flex flex-row pb-1">
            <h6 class="order-title">High Level Stock</h6>
          </div>
          <v-row>
            <v-col cols="11">
              <div class="progress-bar-layout pt-2 pb-2 ps-8">
                <div class="progress-bar-empty"></div>
                <div
                  class="progress-bar-fill"
                  :style="{
                    width: stockLevelsData.HighLevelStock.percentage  + '%',
                    backgroundColor: '#b7e619',
                  }"
                ></div>
                <div class="progress-bar-dotted"
                :style="{
                    width: stockLevelsData.HighLevelStock.percentage  + '%',
                  }"
                ></div>
              </div>
            </v-col>
            <v-col cols="1" class="pa-4"> </v-col>
          </v-row>
          <div class="d-flex flex-row sub-data">
            <p class="stock-product-title">
              {{ stockLevelsData.HighLevelStock.totalQty || 0 }} products
            </p>
          </div>
        </v-card>

        <v-card class="stock-card mr-2 ml-1 mb-2">
          <div class="d-flex flex-row pb-1">
            <h6 class="order-title">Average Level Stock</h6>
          </div>
          <v-row>
            <v-col cols="11">
              <div class="progress-bar-layout pt-2 pb-2 ps-8">
                <div class="progress-bar-empty"></div>
                <div
                  class="progress-bar-fill"
                  :style="{
                    width: stockLevelsData.AverageLevelStock.percentage + '%',
                    backgroundColor: '#ebdb00',
                  }"
                ></div>
                <div class="progress-bar-dotted"
                :style="{
                    width: stockLevelsData.AverageLevelStock.percentage + '%',
                  }"
                ></div>
              </div>
            </v-col>
            <v-col cols="1" class="pa-4"> </v-col>
          </v-row>
          <div class="d-flex flex-row sub-data">
            <p class="stock-product-title">
              {{ stockLevelsData.AverageLevelStock.totalQty || 0 }} products
            </p>
          </div>
        </v-card>

        <v-card class="stock-card mr-2 ml-1 mb-6">
          <div class="d-flex flex-row pb-1">
            <h6 class="order-title">Low Level Stock</h6>
          </div>
          <v-row>
            <v-col cols="11">
              <div class="progress-bar-layout pt-2 pb-2 ps-8">
                <div class="progress-bar-empty"></div>
                <div
                  class="progress-bar-fill"
                  :style="{
                    width: stockLevelsData.LowLevelStock.percentage + '%',
                    backgroundColor: '#e00b66',
                  }"
                ></div>
                <div class="progress-bar-dotted"
                :style="{
                    width: stockLevelsData.LowLevelStock.percentage + '%',
                  }"
                ></div>
              </div>
            </v-col>
            <v-col cols="1" class="pa-4"> </v-col>
          </v-row>
          <div class="d-flex flex-row sub-data">
            <p class="stock-product-title">
              {{ stockLevelsData.LowLevelStock.totalQty || 0 }} products
            </p>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup lang="ts">
import { ref, watch, defineProps } from "vue";

const props = defineProps<{
  stockLevels: Record<string, { totalQty: number; percentage: number }>;
}>();

const seriesRadial = ref<Number[]>([]);
const stockLevelsData = ref({
  MaxLevelStock: { totalQty: 0, percentage: 0 },
  HighLevelStock: { totalQty: 0, percentage: 0 },
  AverageLevelStock: { totalQty: 0, percentage: 0 },
  LowLevelStock: { totalQty: 0, percentage: 0 },
});

const percentageToWidth = (percentage: string) => {
  const num = parseFloat(percentage);
  return isNaN(num) ? 0 : num;
};

watch(
  () => props.stockLevels,
  (newStockLevels) => {
    if (newStockLevels) {
      stockLevelsData.value = {
        MaxLevelStock: newStockLevels["MaxLevelStock"] || {
          totalQty: 0,
          percentage: 0,
        },
        HighLevelStock: newStockLevels["HighLevelStock"] || {
          totalQty: 0,
          percentage: 0,
        },
        AverageLevelStock: newStockLevels["AverageLevelStock"] || {
          totalQty: 0,
          percentage: 0,
        },
        LowLevelStock: newStockLevels["LowLevelStock"] || {
          totalQty: 0,
          percentage: 0,
        },
      };

      seriesRadial.value = [
        percentageToWidth(stockLevelsData.value.LowLevelStock.percentage),
        percentageToWidth(stockLevelsData.value.AverageLevelStock.percentage),
        percentageToWidth(stockLevelsData.value.HighLevelStock.percentage),
        percentageToWidth(stockLevelsData.value.MaxLevelStock.percentage),
      ];
    }
  },
  { immediate: true }
);

const chartOptionsDonutRadial = {
  labels: [
    "Low Level Stock",
    "Average Level Stock",
    "High Level Stock",
    "Max Level Stock",
  ],
  colors: ["#e00b66", "#ebdb00", "#b7e619", "#02cf6a"],
  chart: {
    width: "100%",
    type: "donut",
  },
  plotOptions: {
    pie: {
      donut: {
        labels: {
          show: true,
          name: {
            show: false,
          },
          value: {
            show: true,
            fontSize: "18px",
            fontFamily: "Nunito, sans-serif",
            color: "#fff",
            offsetY: 0,
            formatter: () =>
              `${
                stockLevelsData.value.LowLevelStock.totalQty +
                stockLevelsData.value.AverageLevelStock.totalQty +
                stockLevelsData.value.HighLevelStock.totalQty +
                stockLevelsData.value.MaxLevelStock.totalQty
              } qty`,
          },
          total: {
            show: true,
            showAlways: true,
            label: "Total sum of products",
            fontSize: "18px",
            fontFamily: "Nunito, sans-serif",
            color: "#fff",
            formatter: () =>
              `${
                stockLevelsData.value.LowLevelStock.totalQty +
                stockLevelsData.value.AverageLevelStock.totalQty +
                stockLevelsData.value.HighLevelStock.totalQty +
                stockLevelsData.value.MaxLevelStock.totalQty
              } qty`,
          },
        },
      },
    },
  },
  legend: {
    show: false,
  },
  dataLabels: {
    style: {
      colors: ["#000"],
      fontSize: "18px",
      fontFamily: "Nunito, sans-serif",
      fontWeight: 600,
    },
  },
  tooltip: {
    enabled: false,
  },
};

</script>

<style scoped>
.progress-bar-dotted {
  position: relative;
  height: 1px;
  border-top: 1px solid dotted;
}
.top-product-card-title,
.column-chart-title {
    font: 24px "Nunito", sans-serif;
    color: #fff;
    font-weight: 700;
}

.radial-chart {
    background-color: #17262e !important;
    border-radius: 35px;
}

.stock-card {
    border-radius: 15px;
    background-color: #1c2e37!important;
    height: 125px;
    width: 100%;
}

.stock-product-title {
    padding-top: 25px;
    font: 16px 'Nunito', sans-serif;
    color: #fff;
}

/*==============Progress bars==================================*/

.sub-data {
    padding-left: 35px;
    font-size: 18px;
    position: relative;
    bottom: 25px;
}

.total-pcs {
    font: 14px "Nunito", sans-serif !important;
    font-weight: 800 !important;
    color: #fff;
    padding: 5px 15px 5px 15px;
}

.required-pcs {
    font: 14px "Nunito", sans-serif !important;
    font-weight: 800 !important;
    color: #fff;
    padding: 5px 15px 5px 15px;
}

.total-pcs-dash {
    font: 14px "Nunito", sans-serif !important;
    margin-top: 10px;
    padding: 5px 0px 5px 0px;
    color: #fff;
    height: 4px;
    width: 35px;
}

.progress-bar-layout {
    margin-right: 15px;
}

.progress-bar-empty {
    height: 10px;
    width: 105%;
    background: #243b46;
    border-radius: 2.5px;
}

.progress-bar-fill{
  height: 10px;
  border-radius: 2.5px;
  position: relative;
  bottom:10px;
}
.progress-bar-score {
    font: 12px "Nunito", sans-serif !important;
    font-weight: 800 !important;
    border: 1px solid #00ffd5;
    background: #17262e;
    color: #00ffd5;
    border-radius: 5px;
    padding: 2px 2px 2px 6px;
    width: 40px;
    position: relative;
    bottom: 28px;
    left: 48%;
}

</style>

