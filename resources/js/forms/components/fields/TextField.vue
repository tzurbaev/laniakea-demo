<template>
  <AbstractField :field>
    <input :name="field.name"
           :id="field.id"
           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
           v-bind="field.settings?.attributes || {}"
           v-model="model"
    />
  </AbstractField>
</template>

<script setup>
import AbstractField from './AbstractField.vue';

defineProps({
  field: {
    required: true,
    type: Object,
  },
});

const model = defineModel();
</script>
