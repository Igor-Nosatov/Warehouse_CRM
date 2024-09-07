<template>
  <div class="mt-4 ps-1" ref="selectOptionOutClick">
    <div class="sort-select">
      <div class="selected-option" @click="toggleOptions">
        {{ currentOption.name || `Select ${label}` }}
        <i class="las la-chevron-down ml-2"></i>
      </div>
      <div class="sort-options" v-if="showOptions">
        <div
          v-for="option in options"
          :key="option.id"
          class="sort-option"
          @click="selectOption(option)"
        >
          {{ option.name }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
  label: String,
  options: Array,
  selectedOption: Object,
  updateSelectedOption: Function,
});

const emit = defineEmits(['update:selectedOption']);

const showOptions = ref(false);
const selectOptionOutClick = ref(null);

const toggleOptions = () => {
  showOptions.value = !showOptions.value;
};

const selectOption = (option) => {
  emit('update:selectedOption', option);
  showOptions.value = false;
};

const currentOption = computed(() => {
  return props.options.find(option => option.id === props.selectedOption.id) || {};
});

const handleClickOutside = (event) => {
  if (
    selectOptionOutClick.value &&
    !selectOptionOutClick.value.contains(event.target)
  ) {
    showOptions.value = false;
  }
};

onMounted(() => {
  document.addEventListener('mousedown', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('mousedown', handleClickOutside);
});
</script>

