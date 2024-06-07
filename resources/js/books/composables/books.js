import { computed, ref, watch } from 'vue';
import axios from 'axios';

export function useBooksList() {
  const books = ref([]);
  const loading = ref(false);
  const filters = ref({
    author_id: null,
    genre_id: null,
    search: null,
  });
  const hasFilters = computed(() => Object.values(filters.value).some((value) => value !== null));
  const resetFilters = () => {
    filters.value = {
      author_id: null,
      genre_id: null,
      search: null,
    };
  };

  const params = computed(() => ({
    ...filters.value,
    page: 1,
    count: 100,
    with: 'author,genre',
    order_by: 'title',
  }));

  const loadBooks = async () => {
    if (loading.value) {
      return false;
    }

    loading.value = true;

    try {
      books.value = (await axios.get('/api/v1/books', {
        params: { ...params.value },
      })).data.data;
    } catch (e) {
      alert(e?.response?.data?.error?.message || 'Something went wrong!');
      console.error(e);
    } finally {
      loading.value = false;
    }
  };

  let reloadTimeout;

  watch(filters, () => {
    clearTimeout(reloadTimeout);
    reloadTimeout = setTimeout(loadBooks, 500);
  }, { deep: true });

  return {
    books,
    loading,
    filters,
    hasFilters,
    loadBooks,
    resetFilters,
  };
}
