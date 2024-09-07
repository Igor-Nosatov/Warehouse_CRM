<!-- src/components/QuickActionDialog.vue -->
<template>
  <v-dialog v-model="localIsOpen" max-width="600px">
    <v-card class="modal-form">
      <v-card-title>
        <span class="text-h5">{{ title }}</span>
      </v-card-title>
      <v-card-text>
        <p>Content for {{ title }} action.</p>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn class="wr-primary-btn" @click="closeDialog">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { ref, defineEmits, defineProps, watch } from 'vue';

const props = defineProps<{
  isOpen: boolean;
  title: string;
}>();

const emit = defineEmits<{
  (event: 'update:isOpen', isOpen: boolean): void;
}>();

const localIsOpen = ref(props.isOpen);

watch(() => props.isOpen, (newVal) => {
  localIsOpen.value = newVal;
});

const closeDialog = () => {
  localIsOpen.value = false;
};

watch(localIsOpen, (newVal) => {
  emit('update:isOpen', newVal);
});
</script>

