<template>
  <div @click="toggleOptions" ref="selectRef" class="custom-select">
    <button class="common-input-style ms-10">
      <div class="d-flex flex-row justify-space-between">
        <div class="option-title ps-2 pt-1">{{ selectedOption.name || 'Select an option' }}</div>
        <div class="option-title pt-1"><i class="las la-caret-down"></i></div>
      </div>
    </button>
    <ul v-if="isOpen" class="common-input-style options">
      <li v-for="option in options" :key="option.id" @click="selectOption(option.id)">
        <span class="option-title">{{ option.name }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';

const props = defineProps({
  options: {
    type: Array,
    required: true,
    validator: (options) => options.length > 0 && options.every(option => 'id' in option && 'name' in option)
  },
  modelValue: {
    type: Object,
    default: () => ({ id: null, name: '' })
  }
});

const emit = defineEmits(['update:modelValue']);

const isOpen = ref(false);
const selectedOption = ref(props.modelValue);

const toggleOptions = () => {
  isOpen.value = !isOpen.value;
};

const selectOption = (option) => {
  selectedOption.value = option;
  emit('update:modelValue', option); // Emit selected option object
  isOpen.value = false;
};

// Watch for changes in props.modelValue and update selectedOption
watch(() => props.modelValue, (newVal) => {
  selectedOption.value = newVal;
}, { deep: true });
</script>

<style scoped>
/*==*/
.custom-select {
  position: relative;
}
.option-title {
  font-family: "Nunito", sans-serif !important;
  font-size: 16px;
  font-weight: 400;
}

.options {
  position: absolute;
  top: 101%;
  left: 10%;
  display: none;
  list-style-type: none;
  padding: 0;
  margin: 0;
  z-index: 999;
  font-family: "Nunito", sans-serif !important;
  font-size: 16px;
}

.options li:first-child {
  padding-top: 20px;
}
.options li {
  padding: 0px 0px 20px 25px;
}

.options li:hover {
  color: #39db7d;
}

.custom-select:hover .options {
  display: block;
}

.la-caret-down {
  position: relative;
  top: 2px;
  font-size: 18px;
}
</style>
