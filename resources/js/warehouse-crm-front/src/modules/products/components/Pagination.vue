<template>
  <nav>
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: currentPage === 1 }">
        <button class="page-link" @click="changePage(currentPage - 1)">Previous</button>
      </li>
      <li v-if="startPage > 2" class="page-item disabled  btn-pagination-dots">
        <span class="page-link btn-pagination-dots">...</span>
      </li>
      <li
        v-for="page in pagesToShow"
        :key="page"
        class="page-item"
        :class="{ active: currentPage === page }"
      >
        <button class="page-link" @click="changePage(page)">{{ page }}</button>
      </li>
      <li v-if="endPage < lastPage - 1" class="page-item disabled btn-pagination-dots">
        <span class="page-link">...</span>
      </li>
      <li class="page-item" :class="{ disabled: currentPage === lastPage }">
        <button class="page-link" @click="changePage(currentPage + 1)">Next</button>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { computed, defineProps, defineEmits } from 'vue';


const props = defineProps({
  currentPage: {
    type: Number,
    required: true,
  },
  lastPage: {
    type: Number,
    required: true,
  },
});

const emits = defineEmits(['page-changed']);

const maxButtons = 6;

const startPage = computed(() => {
  return Math.max(1, props.currentPage - Math.floor(maxButtons / 2));
});

const endPage = computed(() => {
  return Math.min(props.lastPage, props.currentPage + Math.floor(maxButtons / 2));
});

const pagesToShow = computed(() => {
  const pages = [];
  let start = startPage.value;
  let end = endPage.value;

  if (end - start + 1 < maxButtons) {
    if (start === 1) {
      end = Math.min(props.lastPage, start + maxButtons - 1);
    } else {
      start = Math.max(1, end - maxButtons + 1);
    }
  }

  for (let i = start; i <= end; i++) {
    pages.push(i);
  }

  return pages;
});

const changePage = (page: number) => {
  if (page !== props.currentPage && page > 0 && page <= props.lastPage) {
    emits('page-changed', page);
  }
};
</script>

