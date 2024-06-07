import { ref } from 'vue';
import axios from 'axios';

export function useAuthorsList() {
  const authors = ref([]);
  const loading = ref(false);
  const loadAuthors = async () => {
    if (loading.value) {
      return false;
    }

    loading.value = true;

    try {
      authors.value = (await axios.get('/api/v1/authors?count=100&order_by=name')).data.data;
    } catch (e) {
      alert(e?.response?.data?.error?.message || 'Something went wrong!');
      console.error(e);
    } finally {
      loading.value = false;
    }
  };

  return {
    authors,
    loading,
    loadAuthors,
  };
}
