<template>
  <fieldset>
    <legend v-if="field.label" class="sr-only">{{ field.label }}</legend>
    <div class="space-y-5">
      <div class="relative flex items-start">
        <div class="flex h-6 items-center">
          <input type="checkbox"
                 :id="field.id"
                 :name="field.name"
                 class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                 v-model="model"
          />
        </div>
        <div class="ml-3 text-sm leading-6">
          <label v-if="field.label" :for="field.id" class="font-medium text-gray-900">
            {{ field.label }}
          </label>
          <p v-if="field.hint" class="text-gray-500">
            {{ field.hint }}
          </p>
        </div>
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
