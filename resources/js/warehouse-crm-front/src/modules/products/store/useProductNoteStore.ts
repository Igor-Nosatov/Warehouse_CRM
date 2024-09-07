import { defineStore } from 'pinia';
import ProductNoteService from '@/modules/products/services/ProductNoteService'; // Adjust the import path

export const useProductNoteStore = defineStore('productNote', {
  state: () => ({
    notes: [],
  }),
  actions: {
    async fetchNotes(productId) {
      try {
        const response = await ProductNoteService.getNotesByProductId(productId);
        this.notes = response;
      } catch (error) {
        console.error('Failed to fetch notes:', error);
      }
    },
    async createNote(noteData) {
      try {
        await ProductNoteService.createNote(noteData);
      } catch (error) {
        console.error('Failed to add note:', error);
      }
    },
  },
});
