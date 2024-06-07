<template>
  <div class="bg-slate-100 border border-gray-200 p-4 rounded-lg shadow">
    <h4 class="font-medium text-lg mb-2">Filters</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <TextField :field="{
                   id: 'search-filter',
                   name: 'search-filter',
                   label: 'Search',
                   settings: {
                     attributes: {
                       type: 'search',
                       placeholder: 'Search for books...',
                     },
                   },
                 }"
                 v-model="filters.search"
      />
      <SelectField :field="{
                     id: 'author-filter',
                     name: 'author-filter',
                     label: 'Author',
                     settings: { options: authors },
                   }"
                   v-model="filters.author_id"
      />
      <SelectField :field="{
                     id: 'genre-filter',
                     name: 'genre-filter',
                     label: 'Genre',
                     settings: { options: genres },
                   }"
                   v-model="filters.genre_id"
      />
    </div>
  </div>
</template>

<script setup>
import TextField from '../../forms/components/fields/TextField.vue';
import SelectField from '../../forms/components/fields/SelectField.vue';

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

const filters = defineModel();
</script>
