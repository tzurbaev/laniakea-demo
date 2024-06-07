<template>
  <p v-if="loading" class="text-lg font-medium text-center">Authors are loading...</p>
  <p v-else-if="!authors.length" class="text-lg font-medium text-center">No authors were found.</p>
  <div v-else class="grid grid-cols-1 sm:grid-cols-4 gap-6">
    <div v-for="author in authors"
         :key="`Author-${author.id}`"
         class="overflow-hidden rounded-lg border border-gray-200 shadow hover:shadow-lg transition-shadow"
    >
      <img :src="author.photo_url" :alt="author.name" class="object-cover sm:object-top sm:h-96 w-full">
      <div class="p-4">
        <h2 class="mb-2 text-3xl font-extrabold">{{ author.name }}</h2>
        <p class="text-sm">{{ author.bio }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuthorsList } from '../composables/authors.js';

const { authors, loading, loadAuthors } = useAuthorsList();

loadAuthors();
</script>
