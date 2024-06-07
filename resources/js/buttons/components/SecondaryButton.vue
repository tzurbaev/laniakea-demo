<template>
  <component :is="tag" v-bind="bindings" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
    <slot />
  </component>
</template>

<script setup>
import { useButton } from '../composables/buttons.js';

const props = defineProps({
  type: {
    required: false,
    type: String,
    default: 'button',
  },

  href: {
    required: false,
    type: String,
    default: null,
  },
});

const { tag, bindings } = useButton(props);
</script>
