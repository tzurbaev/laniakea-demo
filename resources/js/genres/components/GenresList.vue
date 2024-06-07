<template>
  <p v-if="loading" class="text-lg font-medium text-center">Genres are loading...</p>
  <p v-else-if="!genres.length" class="text-lg font-medium text-center">No genres were found.</p>
  <div v-else class="grid grid-cols-1 sm:grid-cols-4 gap-6">
    <div v-for="genre in genres"
         :key="`Genre-${genre.id}`"
         class="overflow-hidden rounded-lg border border-gray-200 shadow hover:shadow-lg transition-shadow p-4"
    >
      <h2 class="font-medium">{{ genre.name }}</h2>
    </div>
  </div>
</template>

<script setup>
import { useGenresList } from '../composables/genres.js';

const { genres, loading, loadGenres } = useGenresList();

loadGenres();
</script>
