<template>
  <div class="mt-2" ref="selectOptionOutClick">
    <div class="sort-select">
      <div
        class="selected-option text-capitalize"
        @click="toggleOptions"
      >
        {{ currentOption || `Select ${label}` }}
        <i class="las la-chevron-down ml-2"></i>
      </div>
      <div class="sort-options" v-if="showOptions">
        <div
          v-for="(option, index) in options"
          :key="index"
          class="sort-option"
          @click="selectOption(option)"
        >
          {{ option }}
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
  selectedOption: [String, Number],
  emitUpdate: Function,
});

const emit = defineEmits(['update:selectedOption']);

const showOptions = ref(false);
const selectOptionOutClick = ref(null);

const toggleOptions = () => {
  showOptions.value = !showOptions.value;
};

const selectOption = (option) => {
  console.log('Emitting option:', option);
  emit('update:selectedOption', option);
  showOptions.value = false;
};

const currentOption = computed(() => props.selectedOption || '');

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
