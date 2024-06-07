<template>
  <div>
    <label v-if="field.label" :for="field.id" class="block text-sm font-medium leading-6 text-gray-900 mb-2">
      {{ field.label }}
    </label>

    <div>
      <slot />
    </div>

    <p v-if="field.hint" class="mt-2 text-sm text-gray-500">
      {{ field.hint }}
    </p>
  </div>
</template>

<script setup>
defineProps({
  field: {
    required: true,
    type: Object,
  },
});
</script>
