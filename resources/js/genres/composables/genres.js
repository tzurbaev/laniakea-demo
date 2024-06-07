import { ref } from 'vue';
import axios from 'axios';

export function useGenresList() {
  const genres = ref([]);
  const loading = ref(false);
  const loadGenres = async () => {
    if (loading.value) {
      return false;
    }

    loading.value = true;

    try {
      genres.value = (await axios.get('/api/v1/genres?count=100&order_by=name')).data.data;
    } catch (e) {
      alert(e?.response?.data?.error?.message || 'Something went wrong!');
      console.error(e);
    } finally {
      loading.value = false;
    }
  };

  return {
    genres,
    loading,
    loadGenres,
  };
}
