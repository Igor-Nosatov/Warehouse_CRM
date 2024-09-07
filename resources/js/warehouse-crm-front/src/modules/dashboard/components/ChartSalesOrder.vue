<template>
  <v-card class="sales-order-summary pe-8 pb-2">
    <div class="d-flex flex-row justify-space-between">
      <p class="title-order-summary pt-6 pb-4 pl-8">
        Sales Order Summary
      </p>
      <select id="week" class="select-week">
        <option value="12/01/2024-19/01/2024" selected>
          Week 1: 12 Jan 2024-19 Jan 2024
        </option>
        <option value="12/02/2024-19/02/2024">
          Week 2: 12 Feb 2024-19 Feb 2024
        </option>
        <option value="12/03/2024-19/03/2024">
          Week 3: 12 Mar 2024-19 Mar 2024
        </option>
      </select>
    </div>
    <apexchart class="column-cart-style" type="bar" :options="chartOptions" :series="series"></apexchart>
  </v-card>
</template>

<script setup lang="ts">
import { defineProps, ref, computed } from 'vue';

const props = defineProps<{
  summary: Record<string, { salesOrder: number, salesReturn: number }>
}>();

const series = computed(() => {
  const months = Object.keys(props.summary);
  return [
    {
      name: 'Sales Order',
      data: months.map(month => props.summary[month].salesOrder),
      color: "#00CEF0",
    },
    {
      name: 'Sales Return',
      data: months.map(month => props.summary[month].salesReturn),
      color: "#9458F3",
    },
  ];
});

const chartOptions = ref({
  chart: {
    type: 'bar',
    height: 350,
    fontFamily: 'Nunito, sans-serif',
    foreColor: '#fff',
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded',
      borderRadius: 10,
    },
  },
  dataLabels: {
    enabled: false,
    style: {
      fontSize: '14px',
      fontFamily: 'Nunito, sans-serif',
      colors: ['#fff'],
    },
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent'],
  },
  xaxis: {
    categories: Object.keys(props.summary),
    labels: {
      style: {
        fontSize: '14px',
        fontFamily: 'Nunito, sans-serif',
        colors: ['#fff'],
      },
    },
  },
  yaxis: {
    title: {
      text: 'Sales (units)',
      style: {
        fontSize: '14px',
        fontFamily: 'Nunito, sans-serif',
        colors: ['#fff'],
      },
    },
    labels: {
      style: {
        fontSize: '14px',
        fontFamily: 'Nunito, sans-serif',
        colors: ['#fff'],
      },
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    enabled: true,
  },
  colors: ['#00CEF0', '#9458F3'],
});
</script>

<style scoped>
.sales-order-summary {
    border-radius: 25px;
    background: #17262e;
    color: #fff;
}
.title-order-summary {
    font: 25px "Nunito", sans-serif !important;
    color: #fff;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    font-weight: 800 !important;
}
.select-week {
    appearance: none;
    -webkit-appearance: none;
    font-size: 1.15rem;
    padding: 0px 5px 1px 5px;
    background-color: transparent;
    border-left: 1px solid #00df72;
    color: #fff;
    cursor: pointer;
    font: 16px "Nunito", sans-serif !important;
    font-weight: 500 !important;
    outline: none;
    margin: 30px 0px 15px 0px;
}
.select-week option {
    background: #17262e;
    color: #fff;
    font: 16px "Nunito", sans-serif !important;
}
.column-cart-style {
    font: 16px "Nunito", sans-serif !important;
    background: #17262e;
    color: #000;
    padding-bottom: 16.4px;
}
</style>
