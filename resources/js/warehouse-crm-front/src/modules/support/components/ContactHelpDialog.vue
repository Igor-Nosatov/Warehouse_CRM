<template>
  <v-dialog v-model="localIsOpen" max-width="600px">
    <v-card class="modal-form pb-4">
      <v-card-title>
        <v-row no-gutters>
          <v-col cols="10">
            <h3 class="contact-help-dialog-title pt-4 pb-3 ps-3">
              Contact Help
            </h3>
          </v-col>
          <v-col cols="2" class="ps-8">
            <v-btn class="close-btn mt-2" @click="emitClose">
              <i class="las la-times fs-2"></i>
            </v-btn>
          </v-col>
        </v-row>
      </v-card-title>
      <v-card-text>
        <div class="contact-help-dialog-field">
          <label for="title" class="wr-form-label ps-2 pb-3">Title</label><br />
          <input
            type="text"
            id="title"
            v-model="formData.title"
            class="wr-form-input wr-form-input-contact-help"
            placeholder="Enter issue title ..."
            required
          />
        </div>
        <v-row no-gutters>
          <v-col cols="4">
            <h4 class="contact-help-dialog-title pt-6 ps-2">Select Status</h4>
            <div class="mt-4 ps-1">
              <div class="sort-select">
                <div class="selected-option" @click="toggleStatusOptions">
                  {{ currentStatusOption }}
                  <i class="las la-chevron-down ml-2"></i>
                </div>
                <div class="sort-options" v-if="showStatusOptions">
                  <div
                    v-for="(option, index) in statusOptions"
                    :key="index"
                    class="sort-option"
                    @click="selectStatusOption(option)"
                  >
                    {{ option }}
                  </div>
                </div>
              </div>
            </div>
          </v-col>
          <v-col cols="4">
            <h4 class="contact-help-dialog-title pt-6 ps-2">Select Priority</h4>
            <div class="mt-4 ps-2 pe-1">
              <div class="sort-select">
                <div class="selected-option" @click="togglePriorityOptions">
                  {{ currentPriorityOption }}
                  <i class="las la-chevron-down ml-2"></i>
                </div>
                <div class="sort-options" v-if="showPriorityOptions">
                  <div
                    v-for="(option, index) in priorityOptions"
                    :key="index"
                    class="sort-option"
                    @click="selectPriorityOption(option)"
                  >
                    {{ option }}
                  </div>
                </div>
              </div>
            </div>
          </v-col>
          <v-col cols="4">
            <h4 class="contact-help-dialog-title pt-6 ps-2">Select Category</h4>
            <div class="mt-4 ps-1 pe-1">
              <div class="sort-select">
                <div class="selected-option" @click="toggleCategoryOptions">
                  {{ currentCategoryOption }}
                  <i class="las la-chevron-down ml-2"></i>
                </div>
                <div class="sort-options" v-if="showCategoryOptions">
                  <div
                    v-for="(option, index) in categoryOptions"
                    :key="index"
                    class="sort-option"
                    @click="selectCategoryOption(option)"
                  >
                    {{ option }}
                  </div>
                </div>
              </div>
            </div>
          </v-col>
        </v-row>
        <div class="contact-help-dialog-field mt-5">
          <label for="description" class="wr-form-label ps-2 pb-3">Description</label>
          <textarea
            id="description"
            rows="8"
            v-model="formData.description"
            class="wr-form-textarea"
            placeholder="Enter issue description ..."
          ></textarea>
        </div>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn class="wr-primary-btn ps-2 pe-2" @click="sendHelpRequest">Send</v-btn>
        <v-btn class="wr-primary-btn ps-2 pe-2" @click="closeDialog">Cancel</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { ref, computed, defineEmits, defineProps, watch } from "vue";
import { useSupportTicketStore } from "@/modules/support/store/SupportStore.ts";
import { SupportTicketCategory, SupportTicketPriority, SupportTicketStatus } from "../store/type";

const props = defineProps<{
  isOpen: boolean;
}>();

const emit = defineEmits<{
  (event: "update:isOpen", isOpen: boolean): void;
}>();

const localIsOpen = ref(props.isOpen);

const formData = ref({
  title: "",
  description: "",
  status: "open" as SupportTicketStatus,
  priority: "low" as SupportTicketPriority,
  category: "general" as SupportTicketCategory,
  user_id: localStorage.getItem("userId") ? Number(localStorage.getItem("userId")) : null,
  closed_at: null as string | null,
});


const statusOptions: SupportTicketStatus[] = ["open", "closed"];
const priorityOptions: SupportTicketPriority[] = ["low", "medium", "high"];
const categoryOptions: SupportTicketCategory[] = ["bug", "general"];

function capitalize(value: string): string {
  return value.charAt(0).toUpperCase() + value.slice(1).replace(/_/g, " ");
}

const showStatusOptions = ref(false);
const showPriorityOptions = ref(false);
const showCategoryOptions = ref(false);

const toggleStatusOptions = () => {
  showStatusOptions.value = !showStatusOptions.value;
};

const togglePriorityOptions = () => {
  showPriorityOptions.value = !showPriorityOptions.value;
};

const toggleCategoryOptions = () => {
  showCategoryOptions.value = !showCategoryOptions.value;
};

const currentStatusOption = computed(() => capitalize(formData.value.status));
const currentPriorityOption = computed(() => capitalize(formData.value.priority));
const currentCategoryOption = computed(() => formData.value.category ? capitalize(formData.value.category) : "Select Category");

const selectStatusOption = (option: string) => {
  formData.value.status = option.toLowerCase().replace(/ /g, "_") as SupportTicketStatus;
  showStatusOptions.value = false;
};

const selectPriorityOption = (option: string) => {
  formData.value.priority = option.toLowerCase().replace(/ /g, "_") as SupportTicketPriority;
  showPriorityOptions.value = false;
};

const selectCategoryOption = (option: string) => {
  formData.value.category = option.toLowerCase().replace(/ /g, "_") as SupportTicketCategory;
  showCategoryOptions.value = false;
};

watch(
  () => props.isOpen,
  (newVal) => {
    localIsOpen.value = newVal;
  }
);

const supportTicketStore = useSupportTicketStore();

const closeDialog = () => {
  emit("update:isOpen", false);
};

const sendHelpRequest = async () => {
  const payload = {
    ...formData.value,
    user_id: formData.value.user_id,
  };
  try {
    await supportTicketStore.createSupportTicket(payload);
    resetForm();
    closeDialog();
  } catch (error) {
    console.error("Error sending help request:", error);
  }
};

const resetForm = () => {
  formData.value = {
    title: "",
    description: "",
    status: "open" as SupportTicketStatus,
    priority: "low" as SupportTicketPriority,
    category: "general" as SupportTicketCategory,
    user_id: localStorage.getItem("userId") ? Number(localStorage.getItem("userId")) : null,
    closed_at: null,
  };
};

const emitClose = () => {
  emit("update:isOpen", false);
};
</script>
