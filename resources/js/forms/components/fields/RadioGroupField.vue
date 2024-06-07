<template>
  <fieldset>
    <legend v-if="field.label" class="text-sm font-semibold leading-6 text-gray-900">
      {{ field.label }}
    </legend>
    <p v-if="field.hint" class="mt-1 text-sm leading-6 text-gray-600">
      {{ field.hint }}
    </p>
    <div class="mt-6 space-y-6">
      <div v-for="option in settings.options" :key="`RadioOption-${option.id}`" class="flex items-center">
        <input :id="`${field.id}-${option.id}`"
               :name="field.name"
               type="radio"
               :checked="option.id === model"
               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
        />
        <label :for="`${field.id}-${option.id}`" class="ml-3 block text-sm font-medium leading-6 text-gray-900">
          {{ option.name }}
        </label>
      </div>
    </div>
  </fieldset>
</template>

<script setup>
defineProps({
  field: {
    required: true,
    type: Object,
  },
});

const model = defineModel();
</script>
