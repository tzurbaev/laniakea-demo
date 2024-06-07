<template>
  <AbstractField :field>
    <select :name="field.name"
            :id="field.id"
            class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
            v-bind="field.settings?.attributes || {}"
            v-model="model"
    >
      <option v-for="option in settings.options" :key="`Option-${option.id}`">{{ option.name }}</option>
    </select>
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
