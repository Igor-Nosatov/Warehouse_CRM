import apiClient from '../../../config/apiService.ts';
import { NoteData } from '../store/type';

export default class ProductNoteService {
  static async getNotesByProductId(productId: number) {
    try {
      const response = await apiClient.get(`/v1/dashboard/inventory/notes/${productId}`);
      return response.data.data;
    } catch (error) {
      throw new Error(`Failed to fetch note: ${error.message}`);
    }
  }

  static async createNote(noteData: NoteData) {
    try {
      const response = await apiClient.post('/v1/dashboard/inventory/notes', noteData);
      return response.data.data;
    } catch (error) {
      throw new Error(`Failed to post note: ${error.message}`);
    }
  }
}
