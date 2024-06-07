<template>
  <div>
    <BooksListFilters class="mb-6" :genres :authors v-model="filters" />

    <p v-if="loading" class="text-lg font-medium text-center">Books are loading...</p>
    <p v-else-if="!books.length" class="text-lg font-medium text-center">
      No books were found.
      <template v-if="hasFilters">
        <a href="javascript:;" class="underline text-indigo-600 hover:text-indigo-500" @click="resetFilters">Reset filters</a>.
      </template>
    </p>
    <div v-else class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div v-for="book in books"
           :key="`Book-${book.id}`"
           class="flex flex-col overflow-hidden rounded-lg border border-gray-200 shadow hover:shadow-lg transition-shadow"
      >
        <img class="object-cover sm:object-top sm:h-96 w-full" :src="book.cover_url" :alt="book.title">
        <div class="p-4 flex flex-col flex-1">
          <span class="mb-2">
            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
              {{ book.genre.name }}
            </span>
          </span>
          <p class="text-sm"><strong>{{ book.author.name }}</strong></p>
          <h2 class="mb-2 text-3xl font-extrabold">
            <a :href="`/books/${book.isbn}/edit`" class="underline">
              {{ book.title }}
            </a>
          </h2>
          <p class="text-sm">{{ book.synopsis }}</p>
          <div class="mt-6 text-xs flex flex-1 flex-col justify-end gap-y-2">
            <p>ISBN: <strong>{{ book.isbn }}</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useBooksList } from '../composables/books.js';
import BooksListFilters from './BooksListFilters.vue';

defineProps({
  authors: {
    required: true,
    type: Array,
  },

  genres: {
    required: true,
    type: Object,
  },
});

const { books, loading, filters, hasFilters, resetFilters, loadBooks } = useBooksList();

loadBooks();
</script>
